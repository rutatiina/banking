<?php

namespace Rutatiina\Banking\Models\Transaction;

use Rutatiina\Tenant\Scopes\TenantIdScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImportQue extends Model
{

    use SoftDeletes;

    protected $connection = 'tenant';

    protected $table = 'rg_banking_transaction_import_que';

    protected $primaryKey = 'id';

    protected $dates = ['deleted_at'];

    protected $guarded = []; //make all columns fillable

    protected $casts = [
        'debit' => 'double',
        'credit' => 'double',
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

    public function scopeImported($query)
    {
        return $query->where(function($q){
            $q->whereNotNull('banking_transaction_id');
            $q->Where('banking_transaction_id', '>', 0);
        });
    }

    public function scopePending($query)
    {
        return $query->where(function($q){
            $q->whereNull('banking_transaction_id');
            $q->orWhere('banking_transaction_id', 0);
        });
    }


}
