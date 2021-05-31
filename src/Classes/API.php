<?php

namespace Rutatiina\Banking\Classes;

use PragmaRX\Countries\Package\Countries;
use Rutatiina\Banking\Models\Bank;
use Maatwebsite\Excel\Concerns\ToModel;
use Rutatiina\Invoice\Classes\Store as InvoiceStore;
use Rutatiina\PaymentsMade\Classes\Store as PaymentsMadeStore;
use Rutatiina\JournalEntry\Classes\Store as JournalEntryStore;

class API
{
    public function store($bank_txn)
    {
        $amount = (isset($bank_txn->debit) && is_numeric($bank_txn->debit)) ? $bank_txn->debit : $bank_txn->credit;

        $txn = [
            'external_key' => null,
            'document_name' => null,
            //'number_prefix' => null,
            //'number' => 002,
            //'number_length' => null,
            //'number_postfix' => null,
            //'internal_ref_document' => null,
            //'internal_ref_id' => null,
            //'document_id' => null,
            'date' => $bank_txn->date,
            //'time' => null,
            'debit_financial_account_code' => $bank_txn->debit_financial_account_code,
            'credit_financial_account_code' => $bank_txn->credit_financial_account_code,
            'contact_name' => optional($bank_txn->contact)->name,
            'contact_address' => optional($bank_txn->contact)->address,
            'reference' => $bank_txn->reference,
            'base_currency' => $bank_txn->currency,
            'quote_currency' => $bank_txn->currency,
            'exchange_rate' => 1,
            'taxable_amount' => $bank_txn->currency,
            'total' => $amount,
            'balance' => null,
            'branch_id' => null,
            'store_id' => null,
            'due_date' => null,
            'expiry_date' => null,
            'status' => 'approved',
            'sent' => null,
            'salesperson_id' => null,
            'payment_mode' => null,
            'payment_terms' => null,
            'contact_notes' => null,
            'external_ref' => null,
            'terms_and_conditions' => null,
            'items' => [
                [
                    'displayTotal' => $amount,
                    'name' => $bank_txn->name,
                    'description' => $bank_txn->description,
                    'rate' => $amount,
                    'quantity' => 1,
                    'total' => $amount,
                    'type' => null,
                    'type_id' => null,
                    'contact_id' => null,
                    'tax_id' => null,
                    'units' => null,
                    'batch' => null,
                    'expiry' => null,
                ]

            ],

            //'recurring' => [
            //    'day_of_month' => '*',
            //    'month' => '*',
            //    'day_of_week' => '*',
            //    'start_date' => 'undefined',
            //    'end_date' => 'undefined',
            //],

            //'contact' => [
            //    'id' => 32,
            //    'tenant_id' => 2,
            //    'display_name' => 'Bubbles Spa',
            //    'currencies' => [
            //        '0' => [
            //            'code' => 'UGX',
            //            'exchangeRate' => 1,
            //        ],
            //    ],
            //
            //    'currency' => [
            //        'code' => 'UGX',
            //        'exchangeRate' => 1
            //    ]
            //
            //],

            'isRecurring' => false,
            'contact_notes' => null,
            'contact_id' => $bank_txn->contact_id,
            'ajax' => true
        ];

        $journal_entry = [
            'date' => $bank_txn->date,
            //'time' => null,
            'reference' => $bank_txn->reference,
            'currency' => $bank_txn->currency,
            'total' => $amount,
            'branch_id' => null,
            'store_id' => null,
            'status' => 'approved',

            //'recurring' => [
            //    'day_of_month' => null,
            //    'month' => null,
            //    'day_of_week' => null,
            //    'start_date' => null,
            //    'end_date' => null,
            //],

            //'isRecurring' => false,

            'notes' => null,

            'recordings' => [
                [
                    'description' => $bank_txn->description,
                    'debit' => $amount,
                    'credit' => 0,
                    'contact_id' => $bank_txn->contact_id,
                    'financial_account_code' => $bank_txn->debit_financial_account_code,
                ],

                [
                    'financial_account_code' => $bank_txn->credit_financial_account_code,
                    'contact_id' => $bank_txn->contact_id,
                    'description' => $bank_txn->description,
                    'debit' => 0,
                    'credit' => $amount,
                ],

            ],

        ];


        switch ($bank_txn->name)
        {

            ####### money in   #########################################################
            case 'customer-advance':

                //customer-advance
                $TxnStore = new PaymentsMadeStore();
                $TxnStore->txnInsertData = $txn;
                return $TxnStore->run();

            case 'customer-payment':

                //customer-payment
                $TxnStore = new PaymentsMadeStore();
                $TxnStore->txnInsertData = $txn;
                return $TxnStore->run();

            case 'expense-refund':

                //expense-refund
                $TxnStore = new JournalEntryStore();
                $TxnStore->txnInsertData = $journal_entry;
                return $TxnStore->run();

            case 'interest-income':

                //interest-income
                $TxnStore = new InvoiceStore();
                $TxnStore->txnInsertData = $txn;
                return $TxnStore->run();


            case 'other-deposit':

                //other-deposit
                $TxnStore = new InvoiceStore();
                $TxnStore->txnInsertData = $txn;
                return $TxnStore->run();

            case 'other-income':

                //other-income
                $TxnStore = new InvoiceStore();
                $TxnStore->txnInsertData = $txn;
                return $TxnStore->run();

            case 'owners-contribution':

                //owners-contribution
                $TxnStore = new InvoiceStore();
                $TxnStore->txnInsertData = $txn;
                return $TxnStore->run();

            case 'retainer-payment':

                //retainer-payment
                $TxnStore = new InvoiceStore();
                $TxnStore->txnInsertData = $txn;
                return $TxnStore->run();

            case 'sales-without-invoice':

                //sales-without-invoice
                $TxnStore = new InvoiceStore();
                $TxnStore->txnInsertData = $txn;
                return $TxnStore->run();

            case 'supplier-credit-refund':

                //supplier-credit-refund
                $TxnStore = new InvoiceStore();
                $TxnStore->txnInsertData = $txn;
                return $TxnStore->run();

            case 'supplier-payment-refund':

                //supplier-payment-refund
                $TxnStore = new InvoiceStore();
                $TxnStore->txnInsertData = $txn;
                return $TxnStore->run();

            case 'transfer-in':

                //transfer-in
                $TxnStore = new InvoiceStore();
                $TxnStore->txnInsertData = $txn;
                return $TxnStore->run();


            ####### money out  #########################################################
            case 'card-payment':

                //card-payment
                $TxnStore = new InvoiceStore();
                $TxnStore->txnInsertData = $txn;
                return $TxnStore->run();

            case 'credit-note-refund':

                //credit-note-refund
                $TxnStore = new InvoiceStore();
                $TxnStore->txnInsertData = $txn;
                return $TxnStore->run();

            case 'expense':

                //expense
                $TxnStore = new InvoiceStore();
                $TxnStore->txnInsertData = $txn;
                return $TxnStore->run();

            case 'owner-drawings':

                //owner-drawings
                $TxnStore = new InvoiceStore();
                $TxnStore->txnInsertData = $txn;
                return $TxnStore->run();

            case 'payment-refund':

                //payment-refund
                $TxnStore = new InvoiceStore();
                $TxnStore->txnInsertData = $txn;
                return $TxnStore->run();

            case 'sales-return':

                //sales-return
                $TxnStore = new InvoiceStore();
                $TxnStore->txnInsertData = $txn;
                return $TxnStore->run();

            case 'supplier-advance':

                //supplier-advance
                $TxnStore = new InvoiceStore();
                $TxnStore->txnInsertData = $txn;
                return $TxnStore->run();

            case 'supplier-payment':

                //supplier-payment
                $TxnStore = new InvoiceStore();
                $TxnStore->txnInsertData = $txn;
                return $TxnStore->run();

            case 'transfer-out':

                //transfer-out
                $TxnStore = new InvoiceStore();
                $TxnStore->txnInsertData = $txn;
                return $TxnStore->run();
        }


    }
}
