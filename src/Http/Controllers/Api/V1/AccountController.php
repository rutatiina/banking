<?php

namespace Rutatiina\Banking\Http\Controllers\Api\V1;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Rutatiina\FinancialAccounting\Models\Account;
use Rutatiina\Banking\Models\Account as BankAccount;


class AccountController extends Controller
{
    public function __construct()
    {}

    /*
     * 1st priority is to check id
     * 2nd priority is to check external_key
     * so 1st id then external_key
     */
    private function bankAccount($id)
	{
		if(is_numeric($id)) {
			$bankAccount = BankAccount::find($id);
			if ($bankAccount) {
				return $bankAccount;
			}
		}

		$query = BankAccount::where('external_key', $id);
        $count = $query->count();

		if (!$count) {
			response()->json([
				'status' => 'error',
				'data' => [],
				'messages' => ['Record not found'],
			])->send();
			exit;
		}

		if ($count > 1) {
			response()->json([
				'status' => 'error',
				'data' => [],
				'messages' => ['Multiple records found'],
			])->send();
			exit;
		}

		return $query->first();
	}

    public function index()
    {
        return [
			'status' => 'success',
			'data' => BankAccount::all(),
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
    {
    	$validator = Validator::make($request->all(), [
    		'external_key' => ['max:100', 'unique:rg_banking_accounts'],
            'name' => ['required', 'string', 'max:255'],
            'currency' => ['required', 'string', 'max:255'],
            'number' => ['required', 'string', 'max:255'],
            'bank' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            $response = ['status' => 'error', 'data' => [], 'messages' => []];
            foreach ($validator->errors()->all() as $field => $message) {
                $response['messages'][] = $message;
            }
            return $response;
        }

        DB::beginTransaction();

        try {

        	$Account = new Account;
			$Account->tenant_id = Auth::user()->tenant->id;
			$Account->name = $request->name . ' ' . $request->number;
			$Account->code = $request->code;
			$Account->type = 'asset';
			$Account->sub_type = 'bank_account';
			$Account->payment = '1';
			$Account->save();

            $BankAccount = new BankAccount;
            $BankAccount->tenant_id = Auth::user()->tenant->id;
			$BankAccount->financial_account_code = $Account->code;
			$BankAccount->external_key = $request->external_key;
			$BankAccount->bank = $request->bank;
			$BankAccount->name = $request->name;
			$BankAccount->number = $request->number;
			$BankAccount->code = $request->code;
			$BankAccount->currency = $request->currency;
			$BankAccount->swift_code = $request->swift_code;
			$BankAccount->description = $request->description;
			$BankAccount->primary = $request->primary;
			$BankAccount->save();

			DB::commit();

            return [
				'status' => 'success',
				'data' => [
					'id' => $BankAccount->id,
				],
				'messages' => ['Bank account successfully saved']
			];

        } catch (\Exception $e) {
            DB::rollBack();

            return [
				'status' => 'error',
				'data' => [],
				'messages' => ['System error: Please try again.']
			];
        }
    }

    public function show($id)
    {
    	$bankAccount = $this->bankAccount($id);
    	return [
			'status' => 'success',
			'data' => $bankAccount,
			'messages' => []
		];
	}

    public function edit($id)
    {
        return [
			'status' => 'error',
			'data' => [],
			'messages' => ['Unknown request (edit)'],
		];
    }

    public function update($id, Request $request)
    {
    	$validator = Validator::make($request->all(), [
    		'external_key' => ['max:100', Rule::unique('rg_banking_accounts')->ignore($id)],
            'name' => ['required', 'string', 'max:255'],
            'currency' => ['required', 'string', 'max:255'],
            'number' => ['required', 'string', 'max:255'],
            'bank' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
        	$response = ['status' => 'error', 'data' => [], 'messages' => []];
            foreach ($validator->errors()->all() as $field => $message) {
                $response['messages'][] = $message;
            }
            return $response;
        }

        $BankAccount = $this->bankAccount($id);

        $Account = Account::find($BankAccount->financial_account_code);

        DB::beginTransaction();

        try {

			$Account->name = $request->name . ' ' . $request->number;
			$Account->code = $request->code;
			$Account->type = 'asset';
			$Account->payment = '1';
			$Account->save();


			if ( $request->external_key) {
				$BankAccount->external_key  = $request->external_key;
			}
			$BankAccount->type = $request->type;
			$BankAccount->bank = $request->bank;
			$BankAccount->name = $request->name;
			$BankAccount->number = $request->number;
			$BankAccount->code = $request->code;
			$BankAccount->currency = $request->currency;
			$BankAccount->swift_code = $request->swift_code;
			$BankAccount->description = $request->description;
			$BankAccount->primary = $request->primary;
			$BankAccount->save();

			DB::commit();

            return [
				'status' => 'success',
				'data' => [
					'id' => $id,
				],
				'messages' => ['Bank account successfully updated']
			];

        } catch (\Exception $e) {
            DB::rollBack();

            return [
				'status' => 'error',
				'data' => [],
				'messages' => ['System error: Please try again.']
			];
        }
    }

    public function destroy($id)
	{
		$BankAccount = BankAccount::destroy($id);

		if (empty($BankAccount)) {
			return [
				'status' => 'error',
				'data' => [],
				'messages' => ['Bank Account ('.$id.') not found'],
			];
		}

		return [
			'status' => 'success',
			'data' => [],
			'messages' => ['Bank Account successfully deleted'],
		];
	}
}
