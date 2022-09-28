<?php

namespace Rutatiina\Banking\Models;

use Rutatiina\Tenant\Scopes\TenantIdScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Rutatiina\FinancialAccounting\Models\Account;

class Transaction extends Model
{

    use SoftDeletes;

    protected $connection = 'tenant';

    protected $table = 'rg_banking_transactions';

    protected $primaryKey = 'id';

    protected $dates = ['deleted_at'];

    protected $guarded = []; //make all columns fillable

    protected $appends = ['account'];

	/**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new TenantIdScope);
    }

    public function rgGetAttributes()
    {
        $attributes = [];
        $describeTable =  DB::connection('tenant')->select('describe ' . $this->getTable());

        foreach ($describeTable  as $row) {

            if (in_array($row->Field, ['id', 'created_at', 'updated_at', 'deleted_at', 'tenant_id', 'user_id'])) continue;

            if (in_array($row->Field, ['currencies', 'taxes'])) {
                $attributes[$row->Field] = [];
                continue;
            }

            if ($row->Default == '[]') {
                $attributes[$row->Field] = [];
            } else {
                $attributes[$row->Field] = ''; //$row->Default; //null affects laravel validation
            }
        }

        //add the relationships
        $attributes['type'] = [];
        $attributes['debit_account'] = [];
        $attributes['credit_account'] = [];
        $attributes['items'] = [];
        $attributes['ledgers'] = [];
        $attributes['comments'] = [];
        $attributes['debit_contact'] = [];
        $attributes['credit_contact'] = [];
        $attributes['recurring'] = [];

        return $attributes;
    }

    public function bank_account()
    {
        return $this->belongsTo('Rutatiina\Banking\Models\Account', 'bank_account_id');
    }

    public function getAccountAttribute()
    {
        if ($this->bank_account_financial_account_code == $this->debit_financial_account_code)
        {
            return Account::findCode($this->credit_financial_account_code);
        }
        else
        {
            return Account::findCode($this->debit_financial_account_code);
        }
    }

}
