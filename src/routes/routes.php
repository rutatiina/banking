<?php

use Illuminate\Support\Facades\Route;

$prefixes = [
    'banking',
];

Route::group(['middleware' => ['web', 'auth', 'tenant']], function() use ($prefixes) {

    foreach ($prefixes as $prefix) {

        Route::prefix($prefix)->group(function () {

            //Route::any( '(.*)', function(){ return view('accounting::coming_soon'); });

            Route::get('accounts/{id}/overview', 'Rutatiina\Banking\Http\Controllers\Account\AccountController@overview');
            Route::get('accounts/{id}/transfer-recipients', 'Rutatiina\Banking\Http\Controllers\Account\AccountController@transferRecipients');
            Route::get('accounts/{financial_account_code}/transactions/upload', 'Rutatiina\Banking\Http\Controllers\Account\TransactionController@upload');
            Route::post('accounts/transactions/import', 'Rutatiina\Banking\Http\Controllers\Account\TransactionController@import');
            Route::post('accounts/transactions/map-fields', 'Rutatiina\Banking\Http\Controllers\Account\TransactionController@mapFields');
            Route::get('accounts/{financial_account_code}/transactions/rules/datatables', 'Rutatiina\Banking\Http\Controllers\Account\TransactionRuleController@datatables');
            Route::post('accounts/{financial_account_code}/transactions/exclude', 'Rutatiina\Banking\Http\Controllers\Account\TransactionController@exclude')->name('banking.account.transactions.exclude');
            Route::patch('accounts/{financial_account_code}/import-que/{id}/cancel', 'Rutatiina\Banking\Http\Controllers\Account\ImportQueController@cancel')->name('banking.account.import-que.cancel');

            Route::get('accounts/{financial_account_code}/transactions/datatables/{category}', 'Rutatiina\Banking\Http\Controllers\Account\TransactionController@datatables');
            Route::post('banks/search', 'Rutatiina\Banking\Http\Controllers\BankController@search');

            #import the banks
            Route::get('banks/import', 'Rutatiina\Banking\Http\Controllers\BankController@import');

            #resources
            Route::resource('banks', 'Rutatiina\Banking\Http\Controllers\BankController', ['as' => 'banking']);
            Route::resource('transactions', 'Rutatiina\Banking\Http\Controllers\Account\TransactionController', ['as' => 'banking']);
            Route::resource('accounts/{financial_account_code}/transactions/rules', 'Rutatiina\Banking\Http\Controllers\Account\TransactionRuleController', ['as' => 'banking.account.transactions']);
            Route::resource('accounts/{financial_account_code}/transactions', 'Rutatiina\Banking\Http\Controllers\Account\TransactionController', ['as' => 'banking.account']);
            Route::resource('accounts/{financial_account_code}/import-que', 'Rutatiina\Banking\Http\Controllers\Account\ImportQueController', ['as' => 'banking.account']);
            Route::resource('accounts', 'Rutatiina\Banking\Http\Controllers\Account\AccountController', ['as' => 'banking']);

            Route::resource('', 'Rutatiina\Banking\Http\Controllers\BankingController');

        });

    }

});
