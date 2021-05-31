<?php

namespace Rutatiina\Banking\Http\Controllers\Account;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Rutatiina\Banking\Traits\BankAccountTrait;
use Rutatiina\FinancialAccounting\Models\Account;
use Rutatiina\FinancialAccounting\Models\PaymentMode;
use Rutatiina\FinancialAccounting\Traits\FinancialAccountingTrait;
use Rutatiina\Banking\Models\Bank;
use Rutatiina\Banking\Models\Account as BankAccount;
use Rutatiina\Banking\Models\Statement;
use Rutatiina\FinancialAccounting\Classes\Account as AccountClass;
use Rutatiina\Contact\Models\Contact;
use Rutatiina\Contact\Traits\ContactTrait;
use Yajra\DataTables\Facades\DataTables;
use Rutatiina\Classes\Countries;
use Rutatiina\Classes\Currencies;

class AccountController extends Controller
{
    use FinancialAccountingTrait;
    use ContactTrait;
    use BankAccountTrait;

    public function __construct()
    {
    	$this->middleware('permission:banking.accounts.view');
		$this->middleware('permission:banking.accounts.create', ['only' => ['create','store']]);
		$this->middleware('permission:banking.accounts.update', ['only' => ['edit','update']]);
		$this->middleware('permission:banking.accounts.delete', ['only' => ['destroy']]);
	}

    public function index(Request $request)
    {
        //Get all the bank accounts
        $per_page = ($request->per_page) ? $request->per_page : 20;

        if (!FacadesRequest::wantsJson()) {
            return view('l-limitless-bs4.layout_2-ltr-default.appVue');
        }

        $BankAccount = BankAccount::with(['bank','account'])->paginate($per_page);

        return [
            'tableData' => $BankAccount
        ];
    }

    public function create()
    {
        //load the vue version of the app
        if (!FacadesRequest::wantsJson()) {
            return view('l-limitless-bs4.layout_2-ltr-default.appVue');
        }

        $BankAccount = new BankAccount;

        if (FacadesRequest::wantsJson()) {
            return [
                'urlPost' => '/banking/accounts',
                'attributes' => $BankAccount->rgGetAttributes()
            ];
        }
    }

    public function store(Request $request)
    {
    	$rules = [
            'name' => ['required', 'string', 'max:100'],
            'currency' => ['required', 'string', 'max:100'],
            'number' => ['required', 'string', 'max:100'],
            'bank_id' => ['required', 'max:100'],
            'code' => ['required', 'numeric', 'unique:'.(new Account)->validatorGetTable()],
        ];

        $request->validate($rules);

        $request->request->add(['tenant_id' => Auth::user()->tenant->id]); //add request

        return $this->save($request);

    }

    public function show($id)
    {
        if (!FacadesRequest::wantsJson()) {
            return view('l-limitless-bs4.layout_2-ltr-default.appVue');
        }

        return BankAccount::find($id);
    }

    public function edit($id)
    {
        if (!FacadesRequest::wantsJson()) {
            return view('l-limitless-bs4.layout_2-ltr-default.appVue');
        }

        $BankAccount = BankAccount::findOrFail($id);

        $BankAccount->_method = 'PATCH';
        $BankAccount->bank_id_original = $BankAccount->bank_id;

        return [
            'urlPost' => '/banking/accounts/'.$id,
            'attributes' => $BankAccount
        ];
    }

    public function update($id, Request $request)
    {
        $rules = [
            'name' => ['required', 'string', 'max:100'],
            'currency' => ['required', 'string', 'max:100'],
            'number' => ['required', 'string', 'max:100'],
            'bank_id' => ['required', 'max:100'],
        ];

        $request->validate($rules);

        $request->request->add(['tenant_id' => Auth::user()->tenant->id]); //add request

        return $this->modify($request->id, $request);

    }

    public function destroy($id)
    {
        $bankAccount = BankAccount::findOrFail($id);

        if ( $bankAccount->transactions->isNotEmpty() || $bankAccount->transaction_import_que->isNotEmpty() )
        {
            return [
                'status' => false,
                'messages' => ['Bank cannot be deleted because the account already has some transactions or the import que has some records'],
                'callback' => null
            ];
        }

        //delete all imported statements
        $bankAccount->statements()->delete();

        //delete all transactions
        $bankAccount->transactions()->delete();

        //delete the automatically created account
        $bankAccount->account()->delete();

        //delete the records in que
        $bankAccount->transaction_import_que()->delete();

        //delete the model
        $bankAccount->delete();

        return [
            'status'    => true,
            'messages'   => ['Bank Account deleted'],
            'callback' => '/banking/accounts'
        ];

    }

    //list bank accounts to which account can transfer funds to
    public function transferRecipients($id)
    {
        return BankAccount::select('id', 'financial_account_code', 'name', 'number', 'code')->where('id', '!=', $id)->get();
    }

    public function datatables()
    {
    }

    public function overview($id)
    {
		$financial_account_code = $id;
		$viewData = [];

		$bankAccount = BankAccount::where('financial_account_code', $financial_account_code)->firstOrFail();

		if (empty($bankAccount)) {

			$viewData['is_bank_account'] = false;

			$bankAccount = Account::findOrfail($financial_account_code);

			$bankAccount->financial_account_code = $bankAccount->id;
			$bankAccount->currency = Auth::user()->tenant->base_currency;
			$bankAccount->number = null;

		} else {
			$viewData['is_bank_account'] = true;
		}

		$bank = Bank::findOrfail($bankAccount->bank_id);
		$viewData['bank'] = $bank;

		$dates = [];
		$dates_template = [];
		$opening_date = date('Y-m-d', strtotime("-29 days", strtotime('now')));
		$viewData['opening_strtotime'] = strtotime($opening_date);

		$date_period = new \DatePeriod(
			new \DateTime($opening_date),
			new \DateInterval('P1D'),
			new \DateTime(date('Y-m-d', strtotime("+1 day", strtotime('now'))))
		);

		foreach($date_period as $date) {
			$dates[] = $date->format("Y-m-d");
			$dates_template[$date->format("Y-m-d")] = 0;
		}

		$account['balances'] = $dates_template;

		foreach ($account['balances'] as $date => $balance) {
			$value = AccountClass::date($date)->accountCode($financial_account_code)->currency($bankAccount->currenc)->balance()->returnObject();
			if (is_null($value)) {
				$account['balances'][$date] = 0;
			} else {
				$account['balances'][$date] = ($value->debit - $value->credit);
			}
		}

		$graph_data = [];
		$graph_data[] = [
			'showInLegend' => false,
			'name' => $bankAccount->name.' ('.$bankAccount->code.')',
			'data' => array_values($account['balances'])
		];

		$viewData['graph_data'] = $graph_data;
		$viewData['bank_account'] = $bankAccount;

		$viewData['payment_modes'] = PaymentMode::all();

		$viewData['uncategorized_transactions_count'] = null;
		$viewData['taxes'] = Tax::all();
		$viewData['accounts'] = Account::all()->groupBy('type');

		$contacts = static::contactsByTypes(['supplier','customer']);
		$viewData['contacts'] = [
			'supplier' => [], //$contacts['supplier'],
			'customer' => [], //$contacts['customer'],
		];

		return view('banking::bank-account.overview')->with($viewData);
    }
}
