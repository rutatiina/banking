<?php

namespace Rutatiina\Banking\Models\Transaction;

use Rutatiina\Tenant\Scopes\TenantIdScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rule extends Model
{

    use SoftDeletes;

    protected $connection = 'tenant';

    protected $table = 'rg_banking_transaction_rules';

    protected $primaryKey = 'id';

    protected $dates = ['deleted_at'];

    protected $casts = [
        'criteria' => 'array',
        'options' => 'array',
    ];

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

    public function getCriteriaAttribute($value)
    {
        $valueArray = json_decode($value, true);

        if (is_array($valueArray))
        {
            return $valueArray;
        }
        else
        {
            return [];
        }
    }

    public function getOptionsAttribute($value)
    {
        $valueArray = json_decode($value, true);

        if (is_array($valueArray))
        {
            return $valueArray;
        }
        else
        {
            //the defaults were set because javascript was considering the options array empty even when options are dynamically added
            //solution was to make sure the array contains the values
            return [
                'financial_account_code' => null,
                'contact_id' => null,
                'tax_id' => null,
                'payment_mode' => null,
            ];
        }
    }

}
