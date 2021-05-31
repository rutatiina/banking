<?php

namespace Rutatiina\Banking\Http\Controllers\Api\V1;

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

class BankController extends Controller
{
    use FinancialAccountingTrait;

    public function __construct()
    {}

    public function index()
    {
        return [
			'status' => 'success',
			'data' => Bank::all(),
			'messages' => []
		];
    }

    public function create()
    {
        return [
			'status' => 'error',
			'data' => [],
			'messages' => ['Unknown request (create)'],
		];
    }

    public function store(Request $request)
    {}

    public function show()
    {}

    public function edit($id)
    {}

    public function update($id, Request $request)
    {}

    public function destroy($id)
	{
		$Bank = Bank::destroy($id);

		if (empty($Bank)) {
			return [
				'status' => 'error',
				'data' => [],
				'messages' => ['Bank ('.$id.') not found'],
			];
		}

		return [
			'status' => 'success',
			'data' => [],
			'messages' => ['Bank successfully deleted'],
		];
	}
}
