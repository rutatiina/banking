<?php

namespace Rutatiina\Banking\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Rutatiina\FinancialAccounting\Traits\FinancialAccountingTrait;
use Rutatiina\Banking\Models\Bank;
use Rutatiina\Banking\Models\Account;
use Rutatiina\Banking\Models\Statement;
use Rutatiina\FinancialAccounting\Classes\Account as AccountClass;
use Yajra\DataTables\Facades\DataTables;

class ___BankingController extends Controller
{
    use FinancialAccountingTrait;

    public function __construct()
    {
        $this->middleware('permission:banking.bank.view');
		$this->middleware('permission:banking.bank.create', ['only' => ['create','store']]);
		$this->middleware('permission:banking.bank.update', ['only' => ['edit','update']]);
		$this->middleware('permission:banking.bank.delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $accounts = [
            67 => [
                'id'        => 67,
                'name'      => 'Petty cash',
                'code'      => null,
                'balances'  => [],
                'currency'  => Auth::user()->tenant->base_currency,
            ],
            3 => [
                'id'        => 3,
                'name'      => 'Cash',
                'code'      => null,
                'balances'  => [],
                'currency'  => Auth::user()->tenant->base_currency,
            ]
        ];

        //Get all the bank accounts
        $bank_accounts = Account::where('tenant_id', Auth::user()->tenant->id)->get();

        foreach ($bank_accounts as &$bank_account) {
            $accounts[$bank_account->financial_account_code] = [
                'id'        => $bank_account->financial_account_code,
                'name'      => $bank_account->name,
                'code'      => $bank_account->code,
                'balances'  => array(),
                'currency'  => $bank_account->currency,
            ];
        }


        //values for the graph *********************

        //get list of date for last 30 dates
        $dates = [];
        $dates_template = [];
        $opening_date = date('Y-m-d', strtotime("-29 days", strtotime('now')));

        $date_period = new \DatePeriod(
            new \DateTime($opening_date),
            new \DateInterval('P1D'),
            new \DateTime(date('Y-m-d', strtotime("+1 day", strtotime('now'))))
        );

        foreach($date_period as $date) {
            $dates[] = $date->format("Y-m-d");
            $dates_template[$date->format("Y-m-d")] = 0;
        }

        foreach ($accounts as $key => $account) {
            $accounts[$key]['balances'] = $dates_template;
        }

        foreach ($accounts as $key => $account) {
            foreach ($account['balances'] as $date => $balance) {
                $value = AccountClass::accountCode($account['id'])->date($date)->currency($account['currency'])->balance()->returnArray();
                if (empty($value)) {
                    $accounts[$key]['balances'][$date] = 0;
                } else {
                    $accounts[$key]['balances'][$date] = ($value['debit'] - $value['credit']);
                }

            }
        }

        $graph_data = [];
        foreach ($accounts as $key => $account) {
            $account_name = (empty($account['code'])) ? $account['name'] : $account['name'].' ('.$account['code'].')';
            $graph_data[] = [
                'name' => $account_name,
                'data' => array_values($account['balances'])
            ];
        }

        //print_r($accounts); exit;


        return view('banking::index')->with([
            'bank_accounts' => $bank_accounts,
            'opening_strtotime' => strtotime($opening_date),
            'graph_data' => $graph_data,
            'accounts' => $accounts
        ]);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show()
    {
    }

    public function edit($id)
    {
    }

    public function update($id, Request $request)
    {
    }

    public function destroy()
    {
    }

    public function datatables()
    {
    }
}
