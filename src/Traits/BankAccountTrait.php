<?php

namespace Rutatiina\Banking\Traits;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Rutatiina\Banking\Models\Account as BankAccount;
use Rutatiina\Banking\Models\Bank;
use Rutatiina\Contact\Models\Contact;
use Rutatiina\FinancialAccounting\Models\Account;
use Rutatiina\FinancialAccounting\Models\ContactBalance;

trait BankAccountTrait
{
    public function save($data)
    {
        if (is_numeric($data->bank_id))
        {
            $Bank = Bank::find($data->bank_id);
        }
        else
        {
            //$Bank = null;
            //currentlly the feature to create an account withou a bank is disabled
            //todo the above menthioned feature id to be added
            return ['status' => false, 'messages' => ['Error: Unknown Bank. Please contact support']];
        }

        DB::connection('tenant')->beginTransaction();

        try {

            if (empty($Bank))
            {
                //create the bank
                $Bank = new Bank;
                $Bank->tenant_id = $data->tenant_id;
                $Bank->name = $data->bank_id;
                $Bank->save();
            }

            //create the account
            $Account = new Account;
            $Account->tenant_id = $data->tenant_id;
            $Account->slug = Str::slug($data->name);
            $Account->name = $data->name;
            $Account->code = $data->code;
            $Account->type = 'asset';
            $Account->sub_type = 'bank_account';
            $Account->payment = '1';
            $Account->save();

            //assign the account a code

            //save the bank account
            $BankAccount = new BankAccount;
            $BankAccount->tenant_id = $data->tenant_id;
            $BankAccount->financial_account_code = $Account->code;
            $BankAccount->bank_id = $Bank->id;
            $BankAccount->name = $data->name;
            $BankAccount->number = $data->number;
            $BankAccount->code = $data->code;
            $BankAccount->country_code = $data->country_code;
            $BankAccount->currency = $data->currency;
            $BankAccount->description = $data->description;
            $BankAccount->primary = $data->primary;
            $BankAccount->save();

            //update the account details
            $Account->code = ($data->code)? $data->code : $Account->code.'-'.$BankAccount->id;
            $Account->bank_account_id = $BankAccount->id;
            $Account->save();

            $contactLocate = [
                'tenant_id' => $data->tenant_id,
                'banking_bank_id' => $Bank->id
            ];
            $contactCreate = [
                'system_created' => true,
                'types' => ['customer', 'supplier'],
                'status' => 'active',
                'name' => $Bank->name,
                'display_name' => $Bank->name,
                'currency' => $BankAccount->currency,
                'currencies' => [$BankAccount->currency],
                'country' => $data->country_code,
            ];

            Contact::firstOrCreate($contactLocate, $contactCreate);

            DB::connection('tenant')->commit();

            return [
                'status' => true,
                'messages' => ['Bank account successfully saved'],
                'callback' => '/banking/accounts'
            ];

        }
        catch (\Exception $e)
        {
            DB::connection('tenant')->rollBack();

            $messages = [];

            if (App::environment('local'))
            {
                $messages[] = 'Error: Failed to save transaction to database.';
                $messages[] = 'File: '. $e->getFile();
                $messages[] = 'Line: '. $e->getLine();
                $messages[] = 'Message: ' . $e->getMessage();
            }
            else
            {
                $messages[] = 'System error: Please contact Admin';
            }

            return ['status' => false, 'messages' => $messages];
        }
    }

    public function modify($id, $data)
    {
        if (is_numeric($data->bank_id))
        {
            $Bank = Bank::find($data->bank_id);
        }
        else
        {
            //$Bank = null;
            //currentlly the feature to create an account without a bank is disabled
            //todo the above menthioned feature id to be added
            return ['status' => false, 'messages' => ['Error: Unknown Bank. Please contact support']];
        }

        DB::connection('tenant')->beginTransaction();

        try {

            //modify the bank account
            $bankAccount = BankAccount::find($id);
            $contact = Contact::where('banking_bank_id', $data->bank_id_original)->first();

            $bankIsDifferent = ($Bank->id == $bankAccount->bank_id) ? false : true;

            //bank_id cannot be changed if any txns / qued_txns exist
            if ($bankAccount->transactions->isNotEmpty() || $bankAccount->transaction_import_que->isNotEmpty() )
            {
                DB::connection('tenant')->rollBack();

                $messages = ['Error: Bank cannot be changed because the account already has some transactions or the import que has some records'];

                return ['status' => false, 'messages' => $messages];
            }

            //delete the old contact if it has NO records against it
            if ($bankIsDifferent)
            {
                $accountContactBalance = ContactBalance::where('contact_id', $contact->id)->first();

                if (!$accountContactBalance)
                {
                    $contact->delete();
                    $contact = false; //variable has to be set to false so that a new contact is created
                }
            }

            if (empty($Bank))
            {
                //create the bank
                $Bank = new Bank;
                $Bank->tenant_id = $data->tenant_id;
                $Bank->name = $data->bank_id;
                $Bank->save();
            }

            $bankAccount->bank_id = $Bank->id;
            $bankAccount->name = $data->name;
            $bankAccount->number = $data->number;
            $bankAccount->code = $data->code;
            $bankAccount->country_code = $data->country_code;
            $bankAccount->currency = $data->currency;
            $bankAccount->description = $data->description;
            $bankAccount->primary = $data->primary;
            $bankAccount->save();

            //modify the account
            $Account = Account::findCode($bankAccount->financial_account_code);
            $Account->slug = Str::slug($data->name);
            $Account->name = $data->name;
            //$Account->payment = '1';
            $Account->code = ($data->code)? $data->code : $Account->code.'-'.$bankAccount->id;
            $Account->save();

            //note
            //if the bank is the same, then there is no need to create a contact, only update the details
            //if the bank is new them create a contact

            if ($contact)
            {
                $currencies = $contact->currencies;
                $currencies[] = $bankAccount->currency;
                $currencies = array_unique($currencies);

                $contact->name          = $Bank->name;
                $contact->display_name  = $Bank->name;
                $contact->currencies    = $currencies;
                $contact->country       = $data->country_code;
                $contact->save();
            }
            else
            {
                $contact = new Contact;
                $contact->tenant_id         = $data->tenant_id;
                $contact->banking_bank_id   = $Bank->id;
                $contact->system_created    = true;
                $contact->types             = ['customer', 'supplier'];
                $contact->status            = 'active';
                $contact->name              = $Bank->name;
                $contact->display_name      = $Bank->name;
                $contact->currency          = $bankAccount->currency;
                $contact->currencies        = [$bankAccount->currency];
                $contact->country           = $data->country_code;
                $contact->save();
            }

            DB::connection('tenant')->commit();

            return [
                'status' => true,
                'messages' => ['Bank account successfully modified'],
                'callback' => '/banking/accounts'
            ];

        }
        catch (\Exception $e)
        {
            DB::connection('tenant')->rollBack();

            $messages = [];

            if (App::environment('local')) {
                $messages[] = 'Error: Failed to modify bank account to database.';
                $messages[] = 'File: '. $e->getFile();
                $messages[] = 'Line: '. $e->getLine();
                $messages[] = 'Message: ' . $e->getMessage();
            } else {
                $messages[] = 'System error: Please contact Admin';
            }

            return ['status' => false, 'messages' => $messages];
        }
    }
}
