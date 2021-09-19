<?php

namespace Rutatiina\Banking\Models\Transaction;

use Rutatiina\Tenant\Scopes\TenantIdScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attachment extends Model
{

    use SoftDeletes;

    protected $connection = 'tenant';

    protected $table = 'banking_transaction_attachments';

    protected $primaryKey = 'id';

    protected $dates = ['deleted_at'];

    protected $guarded = []; //make all columns fillable

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

}
