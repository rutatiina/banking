<?php

namespace Rutatiina\Banking\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Rutatiina\Banking\Classes\BanksImport;
use Rutatiina\Banking\Models\Bank;
use PragmaRX\Countries\Package\Countries;

class BankController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        //Get all the bank accounts
        $per_page = ($request->per_page) ? $request->per_page : 20;

        if (!FacadesRequest::wantsJson())
        {
            return view('ui.limitless::layout_2-ltr-default.appVue');
        }

        $Banks = Bank::paginate($per_page);

        return [
            'tableData' => $Banks
        ];
    }

    public function create()
    {
        //load the vue version of the app
        if (!FacadesRequest::wantsJson())
        {
            return view('ui.limitless::layout_2-ltr-default.appVue');
        }

        $Bank = new Bank;

        if (FacadesRequest::wantsJson())
        {
            return [
                'attributes' => $Bank->rgGetAttributes()
            ];
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:100'],
            'country' => ['required', 'string', 'max:10']
        ]);

        if ($validator->fails())
        {
            return ['status' => false, 'messages' => $validator->errors()->all()];
        }

        $user = Auth::user();

        $Bank = new Bank;
        $Bank->tenant_id = $user->tenant->id;
        $Bank->user_id = $user->id;
        $Bank->country = $request->country;
        $Bank->name = $request->name;
        $Bank->login_url = $request->login_url;
        $Bank->swift_code = $request->swift_code;
        $Bank->description = $request->description;
        $Bank->save();

        return ['status' => true, 'messages' => ['Bank successfully saved']];
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
    }

    public function update(Request $request)
    {
    }

    public function destroy($id)
    {
    }

    public function search(Request $request)
    {
        $query = Bank::query();
        foreach ($request->search as $search)
        {
            if (empty($search['value'])) continue;

            if ($search['column'] == 'country_code')
            {
                $query->where($search['column'], $search['value']);
            }
            else
            {
                $query->where($search['column'], 'like', '%' . $search['value'] . '%');
            }
        }

        $paginate = $query->orderBy('name', 'asc')->paginate(100);

        //print_r($paginate); exit;
        //print_r($paginate->toArray()); exit;

        return $paginate;

    }

    public function import()
    {
        return 'Feature de-commissioned.';

        //$countries = new Countries();
        //$country = $countries->where('name.common', 'Ugandas')->first();
        //return optional($country)->iso_3166_1_alpha2;
        //return $countries->all();

        //Bank::truncate();
        //Excel::import(new BanksImport, 'list-of-banks-in-the-world.xls');
        //return 'Import completed.';

        $banks = Bank::all();

        $countries = new Countries();

        //foreach ($banks as $bank) {
        //
        //    $b = Bank::find($bank->id);
        //
        //    $country = $countries->where('name.common', $bank->country)->first();
        //
        //    $b->country_code = optional($country)->iso_3166_1_alpha2;
        //    $b->save();
        //
        //    unset($b);
        //}
        //
        //return 'Country codes updated';

        //foreach ($banks as $bank) {
        //
        //    $b = Bank::find($bank->id);
        //
        //    $country = $countries->where('iso_3166_1_alpha2', $bank->country_code)->first();
        //
        //    $b->country = optional($country)->name->common;
        //    $b->save();
        //
        //    unset($b);
        //}

        //return 'Country names updated';
    }
}
