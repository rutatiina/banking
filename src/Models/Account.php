<?php

namespace Rutatiina\Banking\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\TenantIdScope;

class Account extends Model
{

    use SoftDeletes;

    protected $connection = 'tenant';

    protected $table = 'rg_banking_accounts';

    protected $primaryKey = 'id';

    protected $dates = ['deleted_at'];

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
        $describeTable =  \DB::connection('tenant')->select('describe ' . $this->getTable());

        foreach ($describeTable  as $row) {

            if (in_array($row->Field, ['id', 'created_at', 'updated_at', 'deleted_at', 'tenant_id', 'user_id'])) continue;

            if (in_array($row->Field, ['currencies', 'taxes'])) {
                $attributes[$row->Field] = [];
                continue;
            }

            if ($row->Default == '[]') {
                $attributes[$row->Field] = [];
            } else {
                $attributes[$row->Field] = '';
            }
        }

        //add the relationships
        //$attributes['comments'] = [];

        return $attributes;
    }

    public function bank()
    {
        return $this->belongsTo('Rutatiina\Banking\Models\Bank', 'bank_id');
    }

    public function account()
    {
        return $this->hasOne('Rutatiina\FinancialAccounting\Models\Account', 'code', 'financial_account_code');
    }

    public function statements()
    {
        return $this->hasMany('Rutatiina\Banking\Models\Statement', 'bank_account_id', 'id');
    }

    public function transactions()
    {
        return $this->hasMany('Rutatiina\Banking\Models\Transaction', 'bank_account_id', 'id');
    }

    public function transaction_import_que()
    {
        return $this->hasMany('Rutatiina\Banking\Models\Transaction\ImportQue', 'bank_account_id', 'id');
    }

}
