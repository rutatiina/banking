<?php

namespace Rutatiina\Banking\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use Rutatiina\Banking\Classes\API;
use Rutatiina\Banking\Models\Transaction;

use Rutatiina\Banking\Models\Transaction\ImportQue;
use Rutatiina\FinancialAccounting\Models\Account;
use Rutatiina\FinancialAccounting\Traits\FinancialAccountingTrait;

use Rutatiina\Banking\Models\Statement;
use Rutatiina\Banking\Models\Account as BankAccount;
use Rutatiina\Banking\Traits\AccountBalanceUpdate;
use Rutatiina\Banking\Traits\ContactBalanceUpdate;
use Rutatiina\Contact\Models\Contact;
use Rutatiina\Item\Models\Item;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class TransactionController extends Controller
{
    use FinancialAccountingTrait;
    use AccountBalanceUpdate;
    use ContactBalanceUpdate;

    public function __construct()
    {}

    public function index(Request $request)
    {
        //Get all the bank accounts
        $per_page = ($request->per_page) ? $request->per_page : 20;

        if (!FacadesRequest::wantsJson()) {
            return view('ui.limitless::layout_2-ltr-default.appVue');
        }

        $BankTransaction = Transaction::latest()->paginate($per_page);

        return [
            'tableData' => $BankTransaction
        ];
    }

    public function create(Request $request)
	{
        $tenant = Auth::user()->tenant;

        $Txn = new Transaction;
        $attributes = $Txn->rgGetAttributes();

        $attributes['status'] = 'approved';
        $attributes['contact_id'] = '';
        $attributes['contact'] = json_decode('{"currencies":[]}'); #required
        $attributes['date'] = date('Y-m-d');
        $attributes['currency'] = $tenant->base_currency;
        $attributes['taxes'] = json_decode('{}');
        $attributes['name'] = $request->name;

        $BankAccount = BankAccount::find($request->financial_account_code);

        $attributes['bank_account_id'] = $BankAccount->id;

        switch ($request->name)
        {
            ####### money in   #########################################################
            case 'customer-advance':

                //customer-advance
                $attributes['debit'] = 0;
                $attributes['debit_financial_account_code'] = $BankAccount->financial_account_code;

                //get the receivables account
                $attributes['credit_financial_account_code'] = Account::findCode(120100)->code;
                break;

            case 'customer-payment':

                //customer-payment
                $attributes['debit'] = 0;
                $attributes['debit_financial_account_code'] = $BankAccount->financial_account_code;

                //get the receivables account
                $attributes['credit_financial_account_code'] = Account::findCode(120100)->code;
                break;

            case 'retainer-payment':

                //retainer-payment
                $attributes['debit'] = 0;
                $attributes['debit_financial_account_code'] = $BankAccount->financial_account_code;

                //get the receivables account
                $attributes['credit_financial_account_code'] = Account::findCode(120100)->code;
                break;

            case 'sales-without-invoice':

                //sales-without-invoice
                $attributes['debit'] = 0;
                $attributes['debit_financial_account_code'] = $BankAccount->financial_account_code;
                break;

            case 'transfer-in':

                //transfer-in
                $attributes['debit'] = 0;
                $attributes['debit_financial_account_code'] = $BankAccount->financial_account_code;
                break;

            case 'interest-income':

                //interest-income
                $attributes['debit'] = 0;
                $attributes['debit_financial_account_code'] = $BankAccount->financial_account_code;

                //get the interest-income account
                $attributes['credit_financial_account_code'] = Account::findCode(410300)->code;
                break;

            case 'other-income':

                //other-income
                $attributes['debit'] = 0;
                $attributes['debit_financial_account_code'] = $BankAccount->financial_account_code;
                break;

            case 'expense-refund':

                //expense-refund
                $attributes['debit'] = 0;
                $attributes['debit_financial_account_code'] = $BankAccount->financial_account_code;
                break;

            case 'other-deposit':

                //other-deposit
                $attributes['debit'] = 0;
                $attributes['debit_financial_account_code'] = $BankAccount->financial_account_code;
                break;

            case 'owners-contribution':

                //owners-contribution
                $attributes['debit'] = 0;
                $attributes['debit_financial_account_code'] = $BankAccount->financial_account_code;
                break;

            case 'supplier-credit-refund':

                //supplier-credit-refund
                $attributes['debit'] = 0;
                $attributes['debit_financial_account_code'] = $BankAccount->financial_account_code;

                //get the Payables account
                $attributes['credit_financial_account_code'] = Account::findCode(210100)->code;
                break;

            case 'supplier-payment-refund':

                //supplier-payment-refund
                $attributes['debit'] = 0;
                $attributes['debit_financial_account_code'] = $BankAccount->financial_account_code;

                //get the Payables account
                $attributes['credit_financial_account_code'] = Account::findCode(210100)->code;
                break;


            ####### money out  #########################################################
            case 'expense':

                //expense
                $attributes['credit'] = 0;
                $attributes['credit_financial_account_code'] = $BankAccount->financial_account_code;
                break;

            case 'supplier-advance':

                //supplier-advance
                $attributes['credit'] = 0;
                $attributes['credit_financial_account_code'] = $BankAccount->financial_account_code;

                //get the Payables account
                $attributes['debit_financial_account_code'] = Account::findCode(210100)->code;
                break;

            case 'supplier-payment':

                //supplier-payment
                $attributes['credit'] = 0;
                $attributes['credit_financial_account_code'] = $BankAccount->financial_account_code;

                //get the Payables account
                $attributes['debit_financial_account_code'] = Account::findCode(210100)->code;
                break;

            case 'transfer-out':

                //transfer-out
                $attributes['credit'] = 0;
                $attributes['credit_financial_account_code'] = $BankAccount->financial_account_code;
                break;

            case 'sales-return':

                //sales-return
                $attributes['credit'] = 0;
                $attributes['credit_financial_account_code'] = $BankAccount->financial_account_code;
                break;

            case 'card-payment':

                //card-payment
                $attributes['credit'] = 0;
                $attributes['credit_financial_account_code'] = $BankAccount->financial_account_code;
                break;

            case 'owner-drawings':

                //owner-drawings
                $attributes['credit'] = 0;
                $attributes['credit_financial_account_code'] = $BankAccount->financial_account_code;
                break;

            case 'credit-note-refund':

                //credit-note-refund
                $attributes['credit'] = 0;
                $attributes['credit_financial_account_code'] = $BankAccount->financial_account_code;
                break;

            case 'payment-refund':

                //payment-refund
                $attributes['credit'] = 0;
                $attributes['credit_financial_account_code'] = $BankAccount->financial_account_code;
                break;

        }

        $attributes['banking'] = [
            'charge' => 0,
            'charge_ref' => '',
            'tax_id' => 0,
            'tax_amount' => 0,
            'tax_ref' => '',
        ];

        return $attributes;
    }

    public function store(Request $request)
	{
	    //return $request;

        $rules = [
            'debit_financial_account_code' => ['required_without:credit_financial_account_code', 'numeric', 'nullable'],
            'credit_financial_account_code' => ['required_without:debit_financial_account_code', 'numeric', 'nullable'],

            'date' => ['required', 'date'],
            'contact_id' => ['numeric', 'nullable'],

            'debit' => ['required_without:credit', 'numeric', 'nullable'],
            'credit' => ['required_without:debit', 'numeric', 'nullable'],

            'currency' => ['required', 'string'],
            'reference' => ['string', 'nullable'],
            'description' => ['string', 'nullable'],
            'name' => ['required', 'string'],
        ];

        $request->validate($rules);

        $contact = Contact::find($request->contact_id);

        //update financial account balances
        $ledger_total = (is_numeric($request->debit)) ? $request->debit : $request->credit;
        $this->ledgers = [
            'debit' => [
                'tenant_id'        => Auth::user()->tenant->id,
                'date'             => $request->date,
                'base_currency'    => $request->currency,
                'quote_currency'   => $request->currency,
                'exchange_rate'    => 1,

                'financial_account_code'    => $request->debit_financial_account_code,
                'effect'        => 'debit',
                'total'         => floatval($ledger_total),
                'contact_id'    => $request->contact_id
            ],
            'credit' => [
                'tenant_id'        => Auth::user()->tenant->id,
                'date'             => $request->date,
                'base_currency'    => $request->currency,
                'quote_currency'   => $request->currency,
                'exchange_rate'    => 1,

                'financial_account_code'   => $request->credit_financial_account_code,
                'effect'       => 'credit',
                'total'        => floatval($ledger_total),
                'contact_id'   => $request->contact_id
            ]
        ];
        //Log::info('#1');
        //Log::info($this->ledgers);

        //start database transaction
        DB::connection('tenant')->beginTransaction();

        try
        {
            $Txn = new Transaction;
            $Txn->tenant_id = Auth::user()->tenant->id;
            $Txn->bank_account_id = $request->bank_account_id;
            $Txn->name = $request->name;
            $Txn->debit_financial_account_code = (is_numeric($request->debit_financial_account_code)) ? $request->debit_financial_account_code : 0;
            $Txn->credit_financial_account_code = (is_numeric($request->credit_financial_account_code)) ? $request->credit_financial_account_code : 0;
            $Txn->date = $request->date;
            $Txn->contact_id = (is_numeric($request->contact_id)) ? $request->contact_id : 0;
            $Txn->contact_name = optional($contact)->name;
            $Txn->debit_financial_account_code = (is_numeric($request->debit_financial_account_code)) ? $request->debit_financial_account_code : 0;
            $Txn->credit_financial_account_code = (is_numeric($request->credit_financial_account_code)) ? $request->credit_financial_account_code : 0;
            $Txn->currency = $request->currency;
            //$Txn->method = $request->method;
            $Txn->reference = $request->reference;
            $Txn->description = $request->description;
            $save = $Txn->save();

            $bank_txn = $request;
            $bank_txn->contact = $contact;

            $this->accountBalanceUpdate(); //update the financial account balances
            $this->contactBalanceUpdate(); //update the contact balances

            //NOTE:: internal api and record creation has been paused for the moment
            //users will have to manually enable the feature when creating a bank transaction
            if ($request->link_to_transaction)
            {
                //$api = new API;
                //$api_store = $api->store($bank_txn);
            }

            DB::connection('tenant')->commit();

            if ($save == false) {
                return [
                    'status'    => false,
                    'messages'  => []
                ];
            }

            return [
                'status'    => true,
                'messages'  => ['Transaction saved'],
                'number'    => 0,
                //'callback'  => URL::route('accounting.sales.estimates.show', [$insert->id], false)
            ];

        } catch (\Exception $e) {

            DB::connection('tenant')->rollBack();

            Log::critical('Fatal Internal Error: Failed to save bank transaction to database');
            Log::critical($e);

            //print_r($e); exit;
            if (App::environment('local'))
            {
                $this->errors[] = 'Error: Failed to save bank transaction to database.';
                $this->errors[] = 'File: '. $e->getFile();
                $this->errors[] = 'Line: '. $e->getLine();
                $this->errors[] = 'Message: ' . $e->getMessage();
            }
            else
            {
                $this->errors[] = 'Fatal Internal Error: Failed to save bank transaction to database. Please contact Admin';
            }

            return false;
        }
	}

    public function show($id)
	{}

    public function edit($id)
	{}

    public function update(Request $request)
	{}

    public function destroy($financial_account_code, Request $request)
	{
        //return $request->all();

        $validator = Validator::make($request->all(), [
            'financial_account_code' => ['required', 'numeric', 'in:'.$financial_account_code],
            'ids' => ['required', 'array'],
        ]);

        if ($validator->fails()) {
            $response = [
                'status'    => false,
                'message'   => $validator->errors()->all(),
            ];
            return $response;
        }


        $query = Transaction::query();
        $query->where('financial_account_code', $financial_account_code);
        $query->whereIn('id', $request->ids);
        $forceDelete = $query->forceDelete();

        $response = [
            'status'    => ($forceDelete) ? true : false,
            'message'   => ($forceDelete) ? 'Transaction(s) deleted.' : 'An error occurred, please try again leta.',
        ];
        return $response;
    }

    public function exclude($financial_account_code, Request $request)
    {
        //return $request->all();

        $validator = Validator::make($request->all(), [
            'financial_account_code' => ['required', 'numeric', 'in:'.$financial_account_code],
            'ids' => ['required', 'array'],
            'columns' => ['required', 'array'],
        ]);

        if ($validator->fails()) {
            $response = [
                'status'    => false,
                'message'   => $validator->errors()->all(),
            ];
            return $response;
        }


        $updateData = [];

        $query = Transaction::query();
        $query->where('financial_account_code', $financial_account_code);
        $query->whereNull('status'); //only exclude txns where status is null
        $query->whereIn('id', $request->ids);

        foreach ($request->columns as $column => $value) {
            $updateData[$column] = $value;
        }

        //return $updateData;

        $update = $query->update($updateData);

        $response = [
            'status'    => ($update) ? true : false,
            'message'   => ($update) ? 'Transaction(s) updated.' : 'An error occurred, please try again leta.',
        ];
        return $response;
    }

    public function datatables($financial_account_code, $category)
	{
		/*
			Uncategorized - no rule_id is null and txn_id
			Recognized - has a rule_id
			Excluded - rule_id is 0 / zero or status is Excluded

		** status **
			All
			Matched - has a txn_id
			Manually added - status is 'Manually added'
			Categorized - When a txn from the statement is entered into the system manually
			Reconciled
		 */

		//list the rows in the `banking_transaction` table

		$status = $category;

		$query = Transaction::query();
		$query->where('financial_account_code', $financial_account_code);

		if ($status == 'all') {
			//do nothing
		} elseif ($status == 'uncategorized') {
			$query->whereNull('status');
		} else {
			$query->where('status', $status);
		}

		$data = Datatables::of($query)->toArray();

		//print_r($data['data']); exit;

		foreach ($data['data'] as $index => $value) {
			$data['data'][$index]['debit_amount']   = ($value['debit'] > 0) ? floatval($value['debit']) : 0;
			$data['data'][$index]['credit_amount']  = ($value['credit'] > 0) ? floatval($value['credit']) : 0;
		}

		echo json_encode( $data );
    }

    public function upload($financial_account_code)
	{
        if (!FacadesRequest::wantsJson()) {
            return view('ui.limitless::layout_2-ltr-default.appVue');
        }
	}

    public function import(Request $request)
    {
        //return $request;

        //csv is not allowed
        $allowedMimeTypes = array(
            //For excel files
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', //xlsx
            'application/vnd.ms-excel',

            //Others
        );

        $mimeTypes = implode(',', $allowedMimeTypes);

        $rules = [
            //'file' => 'required|mimes:xlsx,xls,ods,odt,odp|max:5048', //|mimetypes:'.$mimeTypes.'
            'encoding' => ['required'],
        ];

        $request->validate($rules);


        //get the details of the bank account
        $bankAccount = BankAccount::find($request->id);

        if (empty($bankAccount)) {
            return response()->json([
                'message' => 'Unknown account',
                'errors' => ['Unknown Bank account.']
            ], 422);
        }

        $file = Storage::disk('public_storage')->putFile('/', $request->file('file'));

        //Copy imported file into array
        //$params = ['io_factory' => true];
        //$this->load->library('third_party_phpexcel', $params);

        //$data = Excel::toCollection($request->file('file'), 'storage/'.$importFile);
        $excelToArray = Excel::toArray($request->file('file'), 'storage/'.$file);
        //dd($excelToArray);
        //return $excelToArray[0];

        $data = $excelToArray[0];

        //return $data[0];
        //print_r(json_encode($data[0])); exit;

        $fileColumns = [];
        foreach ($data[0] as $key => $colunm) {
            $fileColumns[] = [
                'value' => $key,
                'text' => $colunm,
            ];
        }

        $Statement = Statement::firstOrCreate(
            [
                'hash' => md5(Auth::user()->tenant->id.$request->file->getClientOriginalName().time())
            ],
            [
                'tenant_id' => Auth::user()->tenant->id,
                'bank_account_id' => $bankAccount->id,
                'file_name' => $request->file('file')->getClientOriginalName(),
                'file_size' => $request->file('file')->getSize(),
                'saved_as' => 'storage/'.$file,
                'file_rows' => count($data),  //Set the number of rows in the file
                'file_columns' => json_encode($data[0])
            ]
        );

        if ($Statement->wasRecentlyCreated) {
            return response()->json([
                'status' => true,
                'messages' => ['File successfully imported.'],
                'file_columns' => $fileColumns,
                'statement' => $Statement->toArray()
            ]);
        } else {
            return response()->json([
                'message' => 'Duplicate import',
                'errors' => ['Import file already processed']
            ], 422);
        }

    }

    public function mapFields(Request $request)
	{
		//get the details of the bank account
		$banking_statement = $Statement = Statement::find($request->statement_id);

		if (empty($banking_statement)) {
			return redirect()->back()->withErrors(['message' => 'ERROR: Unknown Bank statement.']);
		}

		$banking_account = BankAccount::find($banking_statement->bank_account_id);

		if (empty($banking_account)) {
			return redirect()->back()->withErrors(['message' => 'ERROR: Unknown Bank account.']);
		}

		$mapping = $request->mapping;

		//update the statement mapping info
		$banking_statement->date_format = $request->input('mapping.date_format');
		$banking_statement->debit_format = $request->input('mapping.debit_format');
		$banking_statement->credit_format = $request->input('mapping.credit_format');
		$banking_statement->field_mapping = json_encode($request->mapping);
		$banking_statement->save();


		$excelToArray = Excel::toArray(new Statement, $banking_statement->saved_as);
		//dd($excelToArray);
		//print_r($excelToArray[0]); exit;

		$rows = $excelToArray[0];

		unset($rows[0]); //delete the 1st line of titles
		$dates = [];

        $tenant_id = Auth::user()->tenant->id;

		foreach ($rows as $index => $row) {

            //use selected Deposit / Debit format to edit the value
            switch ($banking_statement->debit_format) {
                case '':
                    break;

                default:
                    break;
            }

            $transaction = [
                'tenant_id'     => $tenant_id,
                'statement_id'  => $banking_statement->id,
                'bank_account_id'    => $banking_statement->bank_account_id,
                'date'          => null,
                'value_date'    => null,
                'description'   => null, //Description
                'contact'       => null, //contact
                'reference'     => null, //Reference Number
                'debit'         => 0, //(preg_match('/(dr|debit)/i', $row['E'])) ? $row['F'] : 0,
                'credit'        => 0, //(preg_match('/(cr|credit)/i', $row['E'])) ? $row['F'] : 0,
                'currency'      => $banking_account->currency,
                //'balance'     => $row[$mapping['xxx']],
            ];


		    //use selected Withdraws / Credit format to edit the value
            $debitValue = 0;
            $creditValue = 0;


            if (isset($row[$mapping['debit_column']])) {
                //Log::info('preg_replace(): issue: '.$row[$mapping['debit_column']].' <-- ||| -->> '.$request->input('mapping.debit_format'));
                $debitValue = $this->formatValue($row[$mapping['debit_column']], $request->input('mapping.debit_format'));
            }

            if (isset($row[$mapping['credit_column']])) {
                $creditValue = $this->formatValue($row[$mapping['credit_column']], $request->input('mapping.credit_format'));
            }

            /*/ no effect column --- commented code to be deleted
            if (!$request->input('mapping.effect_column') && isset($row[$mapping['debit_column']])) {
                $transaction['debit'] = $debitValue;
            }

            if (!$request->input('mapping.effect_column') && isset($row[$mapping['credit_column']])) {
                $transaction['credit'] = $creditValue;
            }
            // no effect column */

            //file has txn effect column i.e. single column to show if txn is debit or credit
            if ($request->input('mapping.effect_column')) {
                $debitValue = (preg_match('/(dr|debit)/i', $row[$mapping['effect_column']])) ? $debitValue : 0;
            }

            if ($request->input('mapping.effect_column') ) {
                $creditValue = (preg_match('/(cr|credit)/i', $row[$mapping['effect_column']])) ? $creditValue : 0;
            }

            if (isset($row[$mapping['date_column']])) {
                $transaction['date'] = $this->formatDate($row[$mapping['date_column']], $request->input('mapping.date_format')); //PhpSpreadsheetDate::excelToDateTimeObject($row[$mapping['date_column']]), //date
            }

            /*
            if (isset($row[$mapping['value_date_column']])) {
                $transaction['value_date'] = $this->formatDate($row[$mapping['value_date_column']], $request->input('mapping.value_date_format')); //PhpSpreadsheetDate::excelToDateTimeObject($row[$mapping['date_column']]), //date
            }
            */

            $transaction['debit'] = $debitValue;
            $transaction['credit'] = $creditValue;

            if (isset($row[$mapping['description_column']])) {
                $transaction['description'] = $row[$mapping['description_column']];
            }

            if (isset($row[$mapping['contact_column']])) {
                $transaction['contact'] = $row[$mapping['contact_column']];
            }

            if (isset($row[$mapping['reference_column']])) {
                $transaction['reference'] = $row[$mapping['reference_column']];
            }


            $validator = Validator::make($transaction, [
                'date' => ['required', 'date'],
                'description' => ['required', 'string'],
                'debit' => ['required'],
                'credit' => ['required'],
            ]);

            if ($validator->fails()) {

                if (App::environment('local')) {
                    $errors = $validator->errors()->all();
                    Log::info($mapping);
                    //Log::info($transaction);
                    Log::info($row);
                    Log::info($errors);
                }

                continue;
            }

            $row_string = json_encode($row);

            ImportQue::firstOrCreate(
				[
					'hash' => md5($banking_statement->id.$row_string)
				],
                $transaction
			);

			$dates[$row[0]] = $row[0];
		}

		//echo '<pre>'; print_r($dates); exit;

		/*
		//call the the txn processing page tho have the txns imported
		$curl = curl_init($_SERVER['SERVER_NAME'] . '/banking/transactions/' . $banking_statement->financial_account_code . '/import/' . $banking_statement->id);
		//curl_setopt($curl, CURLOPT_USERAGENT, 'api');
		//curl_setopt($curl, CURLOPT_TIMEOUT, 1);
		curl_setopt($curl, CURLOPT_TIMEOUT_MS, 200);
		curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, false);
		curl_setopt($curl, CURLOPT_FORBID_REUSE, true);
		//curl_setopt($Curl, CURLOPT_CONNECTTIMEOUT, 1);
		curl_setopt($curl, CURLOPT_DNS_CACHE_TIMEOUT, 10);
		curl_setopt($curl, CURLOPT_FRESH_CONNECT, true);

		curl_setopt($curl, CURLOPT_FAILONERROR, true);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_exec($curl);
		*/

        return response()->json([
            'status' => true,
            'messages' => ['File mapping saved']
        ]);
	}

    private function formatValue($value, $format)
    {
        /*
         * breakdown of regex:
         *
         * // on both sides are regex delimiter - everything that is inside is regex
         * [] means that this is character class. Rules change in character class
         * ^ inside character class stands for "not".
         * \d is short for [0-9], only difference is that it can be used both inside and outside of character class
         * - will match minus sign
         * + in the end is the quantifier, it means that this should match one or more characters
         *
         */

        /*
         * https://stackoverflow.com/questions/24764212/preg-match-compilation-failed-invalid-range-in-character-class-at-offset
         * preg_match('/[\w-.]+/', ''); // this will not work in PHP7.3
         * preg_match('/[\w\-.]+/', ''); // the hyphen need to be escaped
         * thats why all the - are now \-
         */

        if ($format == '.|' ) {
            $pregReplace = preg_replace('/[^\d\-.]()+/', '', $value);
            return ($pregReplace > 0) ? $pregReplace : 0;
        }

        if ($format == '.|-' || $format == '.|()' ) {
            $pregReplace = preg_replace('/[^\d\-.]()+/', '', $value);
            return ($pregReplace < 0) ? abs($pregReplace) : 0;
        }

        if ($format == ',|' ) {
            $pregReplace = preg_replace('/[^\d\-.]()+/', '', $value);
            return ($pregReplace > 0) ? $pregReplace : 0;
        }

        if ($format == ',|-' || $format == ',|()' ) {
            $pregReplace = preg_replace('/[^\d\-,]()+/', '', $value);
            return ($pregReplace < 0) ? abs($pregReplace) : 0;
        }

    }

    private function formatDate($date, $format)
    {
        switch ($format)
        {
            case 'yyyy/MM/dd':

                $explode = explode('/', $date );

                if(strpos($date, '/') === false || count($explode) < 3) return null;

                $year = $explode[0];
                $month = $explode[1];
                $day = $explode[2];
                break;

            case 'dd.MM.yy':

                $explode = explode('.', $date);

                if(strpos($date, '.') === false || count($explode) < 3) return null;

                $year = $explode[2];
                $month = $explode[1];
                $day = $explode[0];
                break;

            case 'MM/dd/yyyy':

                $explode = explode('/', $date);

                if(strpos($date, '/') === false || count($explode) < 3) return null;

                $year = $explode[2];
                $month = $explode[0];
                $day = $explode[1];
                break;

            case 'dd.MM.yyyy':

                $explode = explode('.', $date);

                if(strpos($date, '.') === false || count($explode) < 3) return null;

                $year = $explode[2];
                $month = $explode[1];
                $day = $explode[0];
                break;

            case 'MM.dd.yy':

                $explode = explode('.', $date);

                if(strpos($date, '.') === false || count($explode) < 3) return null;

                $year = $explode[2];
                $month = $explode[0];
                $day = $explode[1];
                break;

            case 'MM-dd-yyyy':

                $explode = explode('-', $date);

                if(strpos($date, '-') === false || count($explode) < 3) return null;

                $year = $explode[2];
                $month = $explode[0];
                $day = $explode[1];
                break;

            case 'yyyy.MM.dd':

                $explode = explode('.', $date);

                if(strpos($date, '.') === false || count($explode) < 3) return null;

                $year = $explode[0];
                $month = $explode[1];
                $day = $explode[2];
                break;

            case 'dd/MM/yyyy':

                $explode = explode('/', $date);

                if(strpos($date, '/') === false || count($explode) < 3) return null;

                $year = $explode[2];
                $month = $explode[1];
                $day = $explode[0];
                break;

            case 'MM.dd.yyyy':

                $explode = explode('.', $date);

                if(strpos($date, '.') === false || count($explode) < 3) return null;

                $year = $explode[2];
                $month = $explode[0];
                $day = $explode[1];
                break;

            case 'dd-MM-yyyy':

                $explode = explode('-', $date);

                if(strpos($date, '-') === false || count($explode) < 3) return null;

                $year = $explode[2];
                $month = $explode[1];
                $day = $explode[0];
                break;

            case 'dd/MM/yy':

                $explode = explode('/', $date);

                if(strpos($date, '/') === false || count($explode) < 3) return null;

                $year = $explode[2];
                $month = $explode[1];
                $day = $explode[0];
                break;

            case 'yyyy-MM-dd':

                $explode = explode('-', $date);

                if(strpos($date, '-') === false || count($explode) < 3) return null;

                $year = $explode[0];
                $month = $explode[1];
                $day = $explode[2];
                break;

            case 'MM/dd/yy':

                $explode = explode('/', $date);

                if(strpos($date, '/') === false || count($explode) < 3) return null;

                $year = $explode[2];
                $month = $explode[0];
                $day = $explode[1];
                break;

            case 'yy.MM.dd':

                $explode = explode('.', $date);

                if(strpos($date, '.') === false || count($explode) < 3) return null;

                $year = $explode[0];
                $month = $explode[1];
                $day = $explode[2];
                break;

            default:
                return null;
                break;
        }

        if (strlen($year) == 2) {

            $dt = \DateTime::createFromFormat('y', $year); //y: A two digit representation of a year (which is assumed to be in the range 1970-2069, inclusive)
            $year = $dt->format('Y');
        }

        $day = str_pad($day, 2, "0", STR_PAD_LEFT);
        $month = str_pad($month, 2, "0", STR_PAD_LEFT);

        return $year.'-'.$month.'-'.$day;

    }

}
