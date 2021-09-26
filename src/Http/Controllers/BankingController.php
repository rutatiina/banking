<?php

namespace Rutatiina\Banking\Http\Controllers;

use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Rutatiina\FinancialAccounting\Traits\FinancialAccountingTrait;
use Rutatiina\Banking\Models\Bank;
use Rutatiina\Banking\Models\Account as BankAccount;

class BankingController extends Controller
{
    use FinancialAccountingTrait;

    public function __construct()
    {
        $this->middleware('permission:banking.bank.view');
		$this->middleware('permission:banking.bank.create', ['only' => ['create','store']]);
		$this->middleware('permission:banking.bank.update', ['only' => ['edit','update']]);
		$this->middleware('permission:banking.bank.delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        //Get all the bank accounts
        $per_page = ($request->per_page) ? $request->per_page : 20;

        if (!FacadesRequest::wantsJson()) {
            return view('ui.limitless::layout_2-ltr-default.appVue');
        }

        $BankAccount = BankAccount::paginate($per_page);

        return [
            'otherAccounts' => $otherAccounts,
            'tableData' => $BankAccount
        ];
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
