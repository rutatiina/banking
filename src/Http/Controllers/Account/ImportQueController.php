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

class ImportQueController extends Controller
{
    use FinancialAccountingTrait;
    use AccountBalanceUpdate;
    use ContactBalanceUpdate;

    public function __construct()
    {}

    public function index(Request $request)
    {
        // return $request;
        //Get all the bank accounts
        $per_page = ($request->per_page) ? $request->per_page : 20;

        if (!FacadesRequest::wantsJson())
        {
            return view('ui.limitless::layout_2-ltr-default.appVue');
        }

        $query = ImportQue::query();

        if ($request->status == 'imported') $query->imported();
        if ($request->status == 'pending') $query->pending();
        if ($request->status == 'canceled') $query->canceled();

        $query->orderBy('id', 'asc');
        // return $query->toSql();
        $importQue = $query->paginate($per_page);

        return [
            'tableData' => $importQue
        ];
    }

    public function create(Request $request)
	{
        //
    }

    public function store(Request $request)
	{
        //
	}

    public function show($id)
	{}

    public function edit($id)
	{}

    public function update(Request $request)
	{}

    public function destroy($financial_account_code, Request $request)
	{
        //
    }

    public function cancel($financial_account_code, $id)
	{
        $record = ImportQue::find($id);
        $record->canceled = 1;
        $record->save();

        return [
            'status' => true,
            'messages' => ['Cue transaction canceled.']
        ];
    }

}
