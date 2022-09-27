<?php

namespace Rutatiina\Banking\Http\Controllers\Account;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Rutatiina\Contact\Models\Contact;
use Rutatiina\FinancialAccounting\Models\Account;
use Rutatiina\FinancialAccounting\Models\PaymentMode;
use Rutatiina\Banking\Models\Account as BankAccount;
use Rutatiina\Banking\Models\Transaction\Rule;
use Rutatiina\Contact\Traits\ContactTrait;
use Rutatiina\FinancialAccounting\Traits\FinancialAccountingTrait;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use Rutatiina\Tax\Models\Tax;

class TransactionRuleController extends Controller
{
    //use TenantTrait;
    use ContactTrait;
    use FinancialAccountingTrait;

    public function __construct()
    {}

    public function index($bank_account_id, Request $request)
	{
        if (!FacadesRequest::wantsJson()) {
            return view('ui.limitless::layout_2-ltr-default.appVue');
        }

        //Get all the bank accounts
        $per_page = ($request->per_page) ? $request->per_page : 20;

        $bankAccount = BankAccount::where('id', $bank_account_id)->firstOrFail();

        $rules = Rule::where('bank_account_id', $bankAccount->id)->paginate($per_page);

        return [
            'tableData' => $rules
        ];

		//$bankAccount = BankAccount::where('id', $bank_account_id)->firstOrFail();
        //return view('banking::transactions.rules.index')->with([
		//	'bank_account' => $bankAccount,
		//	'accounts' => Account::all()->groupBy('type'),
		//	'payment_modes' => PaymentMode::all(),
		//	'contacts' => [
		//		'supplier' => [],
		//		'customer' => []
		//	],
        //]);
	}

    public function create($bank_account_id, Request $request)
	{
        if (!FacadesRequest::wantsJson())
        {
            return view('ui.limitless::layout_2-ltr-default.appVue');
        }

        $bankAccount = BankAccount::where('id', $bank_account_id)->firstOrFail();

        $attributes = (new Rule())->rgGetAttributes();
        $attributes['_method'] = 'POST';
        $attributes['bank_account'] = $bankAccount;
        $attributes['criteria'] = [];
        $attributes['options'] = [];

        return [
            'urlPost' => '/banking/accounts/'.$bank_account_id.'/transactions/rules',
        	'bankAccount' => $bankAccount,
        	'financialAccountsByType' => Account::all()->groupBy('type'),
        	'bankAccounts' => BankAccount::all(),
        	'paymentModes' => PaymentMode::all(),
        	'contactsByType' => [
        		'suppliers' => Contact::whereJsonContains('types', 'supplier')->get(),
        		'customers' => Contact::whereJsonContains('types', 'customer')->get()
        	],
            'attributes' => $attributes
        ];

    }

    public function store($bank_account_id, Request $request)
	{
		//print_r($request->name); exit;

        $rules = [
            'bank_account' => ['required', 'array'],
            'name' => ['required', 'string', 'max:255'],
            'apply_to' => ['required', 'in:deposit,withdraw'],
            'categorize_when' => ['required', 'string'],
            'criteria' => ['required', 'array'],
            'process_as' => ['required', 'string'],
            //'options' => ['required', 'array'],
        ];

        $request->validate($rules);

		$Rule = new Rule;
		$Rule->tenant_id = Auth::user()->tenant->id;
		$Rule->bank_account_id = $request->bank_account['id'];
		$Rule->name = $request->name;
		$Rule->apply_to = $request->apply_to;
		$Rule->categorize_when = $request->categorize_when;
		$Rule->process_as = $request->process_as;
		$Rule->criteria = $request->criteria;
		//$Rule->options = $request->options; //the options has been commented out because i dont remember why it was created in the 1st place
		$Rule->save();

        return [
			'status'    => true,
			'messages'   => ['Bank account transaction Rule saved.'],
		];

	}

    public function show($bank_account_id, $id)
	{}

    public function edit($bank_account_id, $id)
	{
        if (!FacadesRequest::wantsJson())
        {
            return view('ui.limitless::layout_2-ltr-default.appVue');
        }

        $bankAccount = BankAccount::where('id', $bank_account_id)->firstOrFail();

        $attributes = Rule::find($id);
        $attributes['_method'] = 'PATCH';
        $attributes['bank_account'] = $bankAccount;

        return [
            'pageTitle' => 'Update transaction rule.',
            'urlPost' => '/banking/accounts/'.$bank_account_id.'/transactions/rules/'.$id,
            'bankAccount' => $bankAccount,
            'financialAccountsByType' => Account::all()->groupBy('type'),
            'bankAccounts' => BankAccount::all(),
            'paymentModes' => PaymentMode::all(),
            'contactsByType' => [
                'suppliers' => Contact::whereJsonContains('types', 'supplier')->get(),
                'customers' => Contact::whereJsonContains('types', 'customer')->get()
            ],
            'taxes' => Tax::get(),
            'attributes' => $attributes
        ];

    }

    public function update($bank_account_id, $id, Request $request)
	{
        //print_r($request->name); exit;

        $rules = [
            'bank_account' => ['required', 'array'],
            'name' => ['required', 'string', 'max:255'],
            'apply_to' => ['required', 'in:deposit,withdraw'],
            'categorize_when' => ['required', 'string'],
            'criteria' => ['required', 'array'],
            'process_as' => ['required', 'string'],
            'options' => ['required', 'array'],
        ];

        $request->validate($rules);

        $Rule = Rule::findOrFail($id);
        //$Rule->bank_account_id = $request->bank_account['id'];
        $Rule->name = $request->name;
        $Rule->apply_to = $request->apply_to;
        $Rule->categorize_when = $request->categorize_when;
        $Rule->process_as = $request->process_as;
        $Rule->criteria = $request->criteria;
        $Rule->options = $request->options;
        $Rule->save();

        return [
            'status'    => true,
            'messages'   => ['Bank account transaction Rule updated.'],
            'callback' => '/banking/accounts/'.$bank_account_id.'/transactions/rules',
        ];

    }

    public function destroy($bank_account_id, $id)
	{}

    public function datatables($bank_account_id)
	{
        return Datatables::of(Rule::where('bank_account_id', $bank_account_id))->make(true);
    }

    public function exportToExcel()
	{
        $export = Txn::all()->downloadExcel(
            'invoices.xlsx',
            null,
            false
        );

        //$books->load('author', 'publisher'); //of no use

        return $export;
    }
}
