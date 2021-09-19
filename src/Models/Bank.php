<?php

namespace Rutatiina\Banking\Models;

use Rutatiina\Tenant\Scopes\TenantIdScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bank extends Model
{

    use SoftDeletes;

    protected $connection = 'tenant';

    protected $table = 'rg_banking_banks';

    protected $primaryKey = 'id';

    protected $dates = ['deleted_at'];

    protected $guarded = [
        'created_at',
        'deleted_at'
    ];

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

    public function contact()
    {
        return $this->hasOne('Rutatiina\Contact\Models\Contact', 'bank_id');
    }


}
