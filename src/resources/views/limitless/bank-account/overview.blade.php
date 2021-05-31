@extends('accounting::layouts.layout_2.LTR.layout_navbar_sidebar_fixed')

@section('title', 'Banking :: Bank Account :: Overview')

@section('bodyClass', 'sidebar-xs sidebar-opposite-visible')

@section('head')
    <script src="{{ mix('/template/limitless/layout_2/LTR/default/assets/mix/banking.js') }}"></script>
@endsection

@section('content')
    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Page header -->
        <div class="page-header" style="border-bottom: 1px solid #ddd;">
            <div class="page-header-content">
                <div class="page-title clearfix">
                    <div class="pull-left">
                        <h1 class="text-light">
                            {{$bank_account->name}}
                            {!! (empty($bank_account->number)) ? '' : '<small>'.$bank_account->number.'</small>' !!}
                        </h1>
                        <div class="text-size-large">
                            <span class="text-muted">Amount in the system</span>
                            <span class="pl-10 text-semibold account_balance" data-financial_account_code="{{$bank_account->financial_account_code}}">{{number_format($bank_account->balance) . ' ' . $bank_account->currency}}</span>
                        </div>
                    </div>

                    <div class="pull-right">

                        <div class="btn-group btn-xs">
                            <button type="button" class="btn btn-danger btn-labeled dropdown-toggle" data-toggle="dropdown" class="label bg-blue-400">
                                <b><i class="icon-plus22"></i></b>
                                Add transactions
                                <span class="caret pl-10"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right dropdown-menu-xs scrollable-menu no-border-radius bank_transaction">

                                <li class="dropdown-header">MONEY OUT</li>
                                <li><a href="{{url()->current()}}#banking_expense" data-panel="#banking_expense">Expense</a></li>
                                <li><a href="{{url()->current()}}#banking_supplier_advance" data-panel="#banking_supplier_advance">Supplier Advance</a></li>
                                <li><a href="{{url()->current()}}#banking_supplier_payment" data-panel="#banking_supplier_payment">Supplier payment</a></li>
                                <li><a href="{{url()->current()}}#banking_transfer_to_another_account" data-panel="#banking_transfer_to_another_account">Transfer To Another Account</a></li>
                                <li><a href="{{url()->current()}}#banking_sales_return" data-panel="#banking_sales_return">Sales Return</a></li>
                                <li><a href="{{url()->current()}}#banking_card_payment" data-panel="#banking_card_payment">Card Payment</a></li>
                                <li><a href="{{url()->current()}}#banking_owner_drawings" data-panel="#banking_owner_drawings">Owner Drawings</a></li>
                                <li><a href="{{url()->current()}}#banking_credit_note_refund" data-panel="#banking_credit_note_refund">Credit Note Refund</a></li>
                                <li><a href="{{url()->current()}}#banking_payment_refund" data-panel="#banking_payment_refund">Payment Refund</a></li>

                                <li class="divider"></li>
                                <li class="dropdown-header">MONEY IN</li>

                                <li><a href="{{url()->current()}}#banking_customer_advance" data-panel="#banking_customer_advance">Customer Advance</a></li>
                                <li><a href="{{url()->current()}}#banking_customer_payment" data-panel="#banking_customer_payment">Customer Payment</a></li>
                                <li><a href="{{url()->current()}}#banking_retainer_payment" data-panel="#banking_retainer_payment">Retainer Payment</a></li>
                                <li><a href="{{url()->current()}}#banking_sales_without_invoice" data-panel="#banking_sales_without_invoice">Sales Without Invoices</a></li>
                                <li><a href="{{url()->current()}}#banking_transfer_from_another_account" data-panel="#banking_transfer_from_another_account">Transfer From Another Account</a></li>
                                <li><a href="{{url()->current()}}#banking_interest_income" data-panel="#banking_interest_income">Interest Income</a></li>
                                <li><a href="{{url()->current()}}#banking_other_income" data-panel="#banking_other_income">Other Income</a></li>
                                <li><a href="{{url()->current()}}#banking_expense_refund" data-panel="#banking_expense_refund">Expense Refund</a></li>
                                <li><a href="{{url()->current()}}#banking_other_deposit" data-panel="#banking_other_deposit">Other Deposit</a></li>
                                <li><a href="{{url()->current()}}#banking_owners_contribution" data-panel="#banking_owners_contribution">Owner's Contribution</a></li>
                                <li><a href="{{url()->current()}}#banking_supplier_credit_refund" data-panel="#banking_supplier_credit_refund">Supplier Credit Refund</a></li>
                                <li><a href="{{url()->current()}}#banking_supplier_payment_refund" data-panel="#banking_supplier_payment_refund">Supplier Payment Refund</a></li>

                            </ul>
                        </div>

                        @if ($is_bank_account === true)

                            <button type="button" class="btn btn-danger" data-href="{{url('banking/accounts/'.$bank_account->financial_account_code.'/transactions/upload')}}"> Import statement </button>

                            <div class="btn-group ml-5">
                                <button type="button" class="btn btn-default btn-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <i class="icon-cog4"></i> &nbsp;<span class="caret"></span>
                                </button>

                                <ul class="dropdown-menu dropdown-menu-right dropdown-menu-xs no-border-radius" style="min-width: 220px;">
                                    <li><a href="{{url('banking/accounts/'.$bank_account->id.'/edit')}}">Edit Bank Account</a></li>
                                    <?php /*<li><a href="#">Automatic Import</a></li>*/ ?>
                                    <li><a href="{{url('banking/accounts/'.$bank_account->financial_account_code.'/transaction-rules')}}">Manage Transaction Rules</a></li>
                                    <?php /*<li><a href="#">Reconciliation History</a></li>*/ ?>
                                    <li class="divider"></li>
                                    <li><a href="#">Undo Last Import</a></li>
                                    <li><a href="{{url('banking/accounts/'.$bank_account->id.'/inactive')}}" class="rg_ajax_call">Mark as Inactive</a></li>
                                    <li class="divider"></li>
                                    <li><a href="{{route('banking.accounts.destroy', $bank_account->id)}}" class="rg_ajax_bank_account_destroy text-danger" data-_method="DELETE">Delete Bank Account</a></li>
                                </ul>

                            </div>

                        @endif

                    </div>

                </div>
            </div>

        </div>
        <!-- /page header -->

        <!-- Content area -->
        <div class="content no-padding">

            <?php //echo Template::message(); ?>

            <div class="panel panel-flat no-shadow no-border-radius no-border">

                <div class="panel-body no-padding">
                    <div class="tabbable">

                        <ul id="transactions_nav_exclude" class="nav nav-tabs nav-tabs-solid p-10 hidden">
                            <li class="">
                                <button id="transactions-btn-exclude"
                                        type="button" class="btn btn-warning btn-xs btn-sm"
                                        data-financial-account-code="{{$bank_account->financial_account_code}}"
                                        data-url="{{route('banking.account.transactions.exclude', $bank_account->financial_account_code)}}">
                                    <i class="icon-minus-circle2 position-left"></i>
                                    Exclude from Que
                                </button>
                                <button id="transactions-btn-delete"
                                        type="button" class="btn btn-danger btn-xs btn-sm"
                                        data-financial-account-code="{{$bank_account->financial_account_code}}"
                                        data-url="{{route('banking.account.transactions.destroy', [$bank_account->financial_account_code, '0'])}}">
                                    <i class="icon-cancel-circle2 position-left"></i>
                                    Delete from Que
                                </button>
                            </li>
                            <li class="">
                                <button type="button" class="btn btn-link pl-20">
                                    <span id="number_of_selected_transactions">0</span> transactions selected
                                </button>
                            </li>
                        </ul>

                        <ul id="transactions_nav" class="nav nav-tabs nav-tabs-solid p-10">
                            <li class="active">
                                <a href="#icon-only-tab1" data-toggle="tab" class="pull-left">
                                    Overview
                                    <!--<span class="visible-xs-inline-block position-right">Active</span>-->
                                </a>
                            </li>

                            @if ($is_bank_account === false)
                            <li class="">
                                <a class="dropdown-title banking_txn_sorting pull-left" href="#icon-only-tab2" data-toggle="tab" data-ajax="{{url('financial-accounts/account/'.$bank_account->financial_account_code.'/transactions')}}">All Transactions</a>
                            </li>
                            @endif

                            @if ($is_bank_account === true)
                                <li class="dropdown border-left ml-5" style="border-color: #eee;">
                                    <a class="dropdown-title banking_txn_sorting pull-left pr-5" href="#icon-only-tab2" data-toggle="tab" data-ajax="{{url('accounts/'.$bank_account->financial_account_code.'/transactions')}}">All Transactions</a>
                                    <a href="#" class="dropdown-toggle pull-left no-padding-left" data-toggle="dropdown">
                                        <!--<span class="visible-xs-inline-block position-right">Dropdown</span>-->
                                        <span class="caret pl-5"></span>
                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-xs dropdown-menu-right">
                                        <li>
                                            <a class="banking_txn_sorting" href="#icon-only-tab2" data-toggle="tab" data-ajax="{{url('banking/accounts/'.$bank_account->financial_account_code.'/transactions/datatables/all')}}">
                                                All Transactions
                                            </a>
                                        </li>
                                        <li>
                                            <a class="banking_txn_sorting" href="#icon-only-tab2" data-toggle="tab" data-ajax="{{url('banking/accounts/'.$bank_account->financial_account_code.'/transactions/datatables/matched')}}">
                                                Matched Transactions</a>
                                        </li>
                                        <li>
                                            <a class="banking_txn_sorting" href="#icon-only-tab2" data-toggle="tab" data-ajax="{{url('banking/accounts/'.$bank_account->financial_account_code.'/transactions/datatables/manually_added')}}">
                                                Manually added Transactions</a>
                                        </li>
                                        <li>
                                            <a class="banking_txn_sorting" href="#icon-only-tab2" data-toggle="tab" data-ajax="{{url('banking/accounts/'.$bank_account->financial_account_code.'/transactions/datatables/categorized')}}">
                                                Categorized Transactions</a>
                                        </li>
                                        <li>
                                            <a class="banking_txn_sorting" href="#icon-only-tab2" data-toggle="tab" data-ajax="{{url('banking/accounts/'.$bank_account->financial_account_code.'/transactions/datatables/reconciled')}}">
                                                Reconciled Transactions</a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="dropdown border-left ml-5" style="border-color: #eee; white-space: nowrap !important;">

                                    <a class="dropdown-title banking_txn_sorting pull-left border-right border-grey-300 pr-5"
                                       href="#icon-only-tab2"
                                       data-toggle="tab"
                                       data-ajax="{{url('banking/accounts/'.$bank_account->financial_account_code.'/transactions/datatables/uncategorized')}}">
                                        <span class="text-danger text-bold">{{optional($uncategorized_transactions_count)->rows}}</span>
                                        Import Que
                                    </a>
                                    <a href="#"  class="dropdown-toggle pull-left no-padding-left no-padding-left" data-toggle="dropdown">
                                        <!--<span class="visible-xs-inline-block position-right">Dropdown</span>-->
                                        <span class="caret pl-5"></span>
                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-xs dropdown-menu-right">
                                        <li>
                                            <a class="banking_txn_sorting" href="#icon-only-tab2" data-toggle="tab" data-ajax="{{url('banking/accounts/'.$bank_account->financial_account_code.'/transactions/datatables/all')}}">
                                                <span class="text-danger text-bold">{{optional($uncategorized_transactions_count)->rows}}</span>
                                                All Que Transactions
                                            </a>
                                        </li>
                                        <li>
                                            <a class="banking_txn_sorting" href="#icon-only-tab2" data-toggle="tab" data-ajax="{{url('banking/accounts/'.$bank_account->financial_account_code.'/transactions/datatables/uncategorized')}}">
                                                <span class="text-danger text-bold">{{optional($uncategorized_transactions_count)->rows}}</span>
                                                Un-categorized Transactions
                                            </a>
                                        </li>
                                        <li>
                                            <a class="banking_txn_sorting" href="#icon-only-tab2" data-toggle="tab"
                                               data-ajax="{{url('banking/accounts/'.$bank_account->financial_account_code.'/transactions/datatables/recognized')}}">
                                                Recognized Transactions
                                            </a>
                                        </li>
                                        <li>
                                            <a class="banking_txn_sorting" href="#icon-only-tab2" data-toggle="tab"
                                               data-ajax="{{url('banking/accounts/'.$bank_account->financial_account_code.'/transactions/datatables/excluded')}}">
                                                Excluded Transactions
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                            @endif

                        </ul>

                        <div class="tab-content">

                            <div class="tab-pane p-10 active" id="icon-only-tab1">

                                <div class="">

                                    @if (!empty(optional($uncategorized_transactions_count)->rows))
                                    <div class="panel panel-default no-shadow no-border-radius">
                                        <div class="panel-heading">
                                            <span class="text-danger text-bold">{{optional($uncategorized_transactions_count)->rows}}</span> Uncategorized Transactions
                                            <a href="#" class="ml-20">Categorize now</a>
                                        </div>
                                    </div>
                                    @endif

                                    <div class="panel panel-flat no-shadow no-border-radius no-border">
                                        <div class="panel-heading">
                                            <h6 class="panel-title">
                                                {{$bank_account->name}}

                                                @if (!empty($bank_account->number))
                                                    {{$bank_account->number}}
                                                @endif

                                            </h6>
                                            <div class="heading-elements">
                                                <ul class="list-inline text-size-small pt-10">
                                                    <li><span class="text-size-small">For Last 30 days</span></li>
                                                    {{--
                                                    <li>|</li>
                                                    <li><a href="#" class="text-size-small">For Last 12 months</a></li>
                                                    --}}
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="panel-body no-padding">
                                            <div class="chart-container">
                                                <div class="chart" id="highcharts_container" style="height: 420px;"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>
                                    <div class="m-20"></div>
                                    <div class="clearfix"></div>


                                </div>

                            </div>

                            <div class="tab-pane " id="icon-only-tab2">

                                <table class="rg_datatable_transactions table datatable-pagination table-hover" data-ajax="{{route('datatables.empty')}}">
                                    <thead>
                                    <tr>
                                        <th class="hide_sort_icon" width="12"></th>
                                        <th width="130" class="text-semibold">DATE</th>
                                        <th class="text-semibold">DETAILS</th>
                                        <th class="text-uppercase">reference</th>
                                        <th class="text-semibold text-uppercase" width="180">status</th>
                                        <th class="text-right text-semibold" width="200">DEPOSIT / DEBIT</th>
                                        <th class="text-right text-semibold" width="200">WITHDRAWAL / CREDIT</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>

                            </div>

                            <div class="tab-pane" id="icon-only-tab3">
                                <!-- another tab pane -->
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /content area -->

    </div>
    <!-- /main content -->

    <style>
        .panel-body .datatable-footer, .panel-body .datatable-header {
            padding-left: 20px;
            padding-right: 20px;
        }
        .nav-tabs.nav-tabs-solid>.active>a, .nav-tabs.nav-tabs-solid>.active>a:focus, .nav-tabs.nav-tabs-solid>.active>a:hover {
            background-color: #eee;
            border-color: #eee;
            color: #333;
            font-weight: bold;
        }
        .border-grey-300 {
            border-color: #ccc;
        }
        .dropdown-header {
            padding: 0px 15px;
            margin-top: 5px;
        }
        .dropdown-menu-xs>li>a {
            padding-top: 3px;
            padding-bottom: 3px;
        }
        .scrollable-menu {
            height: auto;
            max-height: 400px;
            overflow-x: hidden;
        }
        .categorize_manually {
            background-color: #fff2f0;
        }
        .banking_item_rate {
            font-size: 16px;
        }

        /* css for the tabs menu */
        .nav-tabs.nav-tabs-solid>.active>a:focus, .nav-tabs.nav-tabs-solid>.active>a:hover {
            background-color: transparent !important;
        }
        @media (min-width: 769px) {
            .nav-tabs.nav-tabs-solid > li > a:hover, .nav-tabs.nav-tabs-solid > li > a:focus {
                background-color: transparent !important;
            }
        }
        .nav-tabs.nav-tabs-solid>.active>a:focus, .nav-tabs.nav-tabs-solid>.active>a:hover {
            background-color: #eee !important;
        }
        @media (min-width: 769px) {
            .nav-tabs.nav-tabs-solid > .open:not(.active) > a {
                background-color: transparent !important;
            }
        }
    </style>
@endsection

@section('sidebar_opposite')
    <!-- Opposite sidebar -->
    <div class="sidebar sidebar-opposite sidebar-default hidden" style="width:650px;">
        <div class="sidebar-content">

            <div class="panel panel-flat no-border no-shadow">
                <div class="panel-body">
                    <div class="tabbable">
                        <ul id="tabs_add_transaction" class="nav nav-tabs nav-tabs-bottom hidden">
                            <li class="active"><a href="#bottom-tab1" data-toggle="tab" style="background: none;">Add Transaction</a></li>
                        </ul>

                        <ul id="tabs_selected_transaction" class="nav nav-tabs nav-tabs-bottom hidden">
                            <li class="active"><a href="#bottom-tab1" data-toggle="tab" style="background: none;">Categorize Manually</a></li>
                            <li><a href="#bottom-tab2" data-toggle="tab" style="background: none;">Match Transaction</a></li>

                            <li class="pull-right">
                                <a class="hide-sidebar-opposite text-danger"  style="background: transparent;">
                                    <i class="icon-cross2"></i> <span class="small pl-5">Close</span>
                                </a>
                            </li>

                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="bottom-tab1">

                                <!-- CETEGORY -->
                                <div id="banking_category_money_out" class="txn_form_panel txn_category_panel panel panel-flat no-border no-shadow hidden">

                                    <div class="panel-body">

                                        <form action="#" method="post" class="form-horizontal">

                                            <fieldset class="">

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Category:</label>
                                                    <div class="col-lg-9">
                                                        <select name="banking_category_money_out" data-placeholder="Category" class="select-search">
                                                            <option value=""></option>
                                                            <optgroup label="MONEY OUT">
                                                                <option value="#banking_expense">Expense</option>
                                                                <option value="#banking_supplier_advance">Supplier Advance</option>
                                                                <option value="#banking_supplier_payment">Supplier payment</option>
                                                                <option value="#banking_transfer_to_another_account">Transfer To Another Account</option>
                                                                <option value="#banking_sales_return">Sales Return</option>
                                                                <option value="#banking_card_payment">Card Payment</option>
                                                                <option value="#banking_owner_drawings">Owner Drawings</option>
                                                                <option value="#banking_credit_note_refund">Credit Note Refund</option>
                                                                <option value="#banking_payment_refund">Payment Refund</option>
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                    {{--
                                                    <div class="col-lg-1 control-label">
                                                        <div class="pull-right">
                                                            <ul class="icons-list">
                                                                <li><a class="hide-sidebar-opposite"><i class="icon-cross2 text-muted text-size-large"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    --}}
                                                </div>

                                            </fieldset>

                                        </form>

                                    </div>
                                </div>

                                <div id="banking_category_money_in" class="txn_form_panel txn_category_panel panel panel-flat no-border no-shadow hidden">

                                    <div class="panel-body">

                                        <form action="#" method="post" class="form-horizontal">

                                            <fieldset class="">

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Category:</label>
                                                    <div class="col-lg-9">
                                                        <select name="banking_category_money_in" data-placeholder="Category" class="select-search">
                                                            <option value=""></option>
                                                            <optgroup label="MONEY IN">
                                                                <option value="#banking_customer_advance">Customer Advance</option>
                                                                <option value="#banking_customer_payment">Customer Payment</option>
                                                                <option value="#banking_retainer_payment">Retainer Payment</option>
                                                                <option value="#banking_sales_without_invoice">Sales Without Invoices</option>
                                                                <option value="#banking_transfer_from_another_account">Transfer From Another Account</option>
                                                                <option value="#banking_interest_income">Interest Income</option>
                                                                <option value="#banking_other_income">Other Income</option>
                                                                <option value="#banking_expense_refund">Expense Refund</option>
                                                                <option value="#banking_other_deposit">Other Deposit</option>
                                                                <option value="#banking_owners_contribution">Owner's Contribution</option>
                                                                <option value="#banking_supplier_credit_refund">Supplier Credit Refund</option>
                                                                <option value="#banking_supplier_payment_refund">Supplier Payment Refund</option>
                                                            </optgroup>

                                                        </select>
                                                    </div>
                                                    {{--
                                                    <div class="col-lg-1 control-label">
                                                        <div class="pull-right">
                                                            <ul class="icons-list">
                                                                <li><a class="hide-sidebar-opposite"><i class="icon-cross2 text-muted text-size-large"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    --}}
                                                </div>

                                            </fieldset>

                                        </form>

                                    </div>
                                </div>

                                <!-- MONEY OUT -->
                                <div id="banking_expense" class="txn_form_panel panel panel-flat no-border no-shadow hidden">

                                    <div class="panel-heading no-padding-top">
                                        <h4 class="panel-title">Expense</h4>
                                        <div class="heading-elements">
                                            <ul class="icons-list">
                                                <li><a class="hide-sidebar-opposite"><i class="icon-cross2 text-muted text-size-large"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="panel-body">

                                        <form action="{{url('banking/transactions')}}" method="post" class="form-horizontal" autocomplete="off">
                                            @csrf
                                            @method('POST')

                                            <input type="hidden" name="submit" value="1" />

                                            <input type="hidden" name="_transaction_id" value="">
                                            <input type="hidden" name="_transaction_status" value="">
                                            <input type="hidden" name="_financial_account_code" value="{{$bank_account->financial_account_code}}">
                                            <input type="hidden" name="bank_account_id" value="{{$bank_account->id}}">
                                            <input type="hidden" name="txn_entree_name" value="expense">
                                            <input type="hidden" name="credit" value="{{$bank_account->financial_account_code}}">
                                            <input type="hidden" name="number" value="NULL">
                                            <input type="hidden" name="base_currency" value="{{$bank_account->currency}}">
                                            <input type="hidden" name="quote_currency" value="{{$bank_account->currency}}">
                                            <input type="hidden" name="exchange_rate" value="1">
                                            <input type="hidden" name="items[0][type]" value="account">
                                            <input type="hidden" name="items[0][quantity]" value="1">

                                            <fieldset class="">

                                                <div class="form-group" title="Choose Expense Account">
                                                    <label class="col-lg-3 control-label">Expense Account:</label>
                                                    <div class="col-lg-9">
                                                        <select name="_debit_type_id" data-placeholder="Account" class="select-search">
                                                            <option value=""></option>
                                                            <optgroup label="Expense Accounts">
                                                                @foreach ($accounts['expense'] as $account)
                                                                    <option value="{{$account->code}}" {{( $account->code == 180 ) ? 'selected' : ''}}>{{$account->name}}</option>
                                                                @endforeach
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Supplier:</label>
                                                    <div class="col-lg-9">
                                                        <select name="contact_id" data-placeholder="Select Supplier" class="select-search">
                                                            <option value=""></option>
                                                            @foreach ($contacts['supplier'] as $contact)
                                                                <option value="{{$contact->id}}">{{$contact->display_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Date:</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="date" value="" class="form-control input-roundless daterange-single" placeholder="Choose date" autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Amount:</label>
                                                    <div class="col-lg-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon label-roundless text-semibold">{{$bank_account->currency}}</span>
                                                            <input type="text" name="items[0][rate]" value="" class="form-control input-roundless banking_item_rate text-semibold" placeholder="0.00">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Reference:</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="reference" value="" class="form-control input-roundless" placeholder="Reference">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Description:</label>
                                                    <div class="col-lg-9">
                                                        <textarea name="items[0][description]" class="form-control input-roundless banking_item_description" placeholder="Description"></textarea>
                                                    </div>
                                                </div>

                                                <?php /*
                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Customer:</label>
                                                    <div class="col-lg-9">
                                                        <select name="country_code" data-placeholder="Select Customer" class="select-search">
                                                            <option value=""></option>
                                                            @foreach ($contacts['customer'] as $contact)
                                                            <option value="<?php echo $contact->id; ?>"><?php echo $contact->name; ?></option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                */ ?>

                                                @include('banking::tax_form_fields')

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label"> </label>
                                                    <div class="col-lg-9">
                                                        <button type="button" onclick="rg_banking.form_ajax_submit('#banking_expense form', true);" class="btn btn-danger"><i class="icon-check"></i> Save</button>
                                                    </div>
                                                </div>

                                            </fieldset>

                                        </form>

                                    </div>
                                </div>

                                <div id="banking_supplier_advance" class="txn_form_panel panel panel-flat no-border no-shadow hidden">

                                    <div class="panel-heading no-padding-top">
                                        <h4 class="panel-title">Supplier Advance</h4>
                                        <div class="heading-elements">
                                            <ul class="icons-list">
                                                <li><a class="hide-sidebar-opposite"><i class="icon-cross2 text-muted text-size-large"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="panel-body">

                                        <form action="{{url('banking/transactions')}}" method="post" class="form-horizontal" autocomplete="off">
                                            @csrf
                                            @method('POST')

                                            <input type="hidden" name="submit" value="1" />

                                            <input type="hidden" name="_transaction_id" value="">
                                            <input type="hidden" name="_transaction_status" value="">
                                            <input type="hidden" name="_financial_account_code" value="{{$bank_account->financial_account_code}}">
                                            <input type="hidden" name="bank_account_id" value="{{$bank_account->id}}">
                                            <input type="hidden" name="txn_entree_name" value="payment">
                                            <input type="hidden" name="credit" value="{{$bank_account->financial_account_code}}">
                                            <input type="hidden" name="number" value="NULL">
                                            <input type="hidden" name="base_currency" value="{{$bank_account->currency}}">
                                            <input type="hidden" name="quote_currency" value="{{$bank_account->currency}}">
                                            <input type="hidden" name="exchange_rate" value="1">
                                            <input type="hidden" name="items[0][type]" value="">
                                            <input type="hidden" name="items[0][quantity]" value="1">

                                            <fieldset class="">

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Supplier:</label>
                                                    <div class="col-lg-9">
                                                        <select name="contact_id" data-placeholder="Select Supplier" class="select-search">
                                                            <option value=""></option>
                                                            @foreach ($contacts['supplier'] as $contact)
                                                                <option value="{{$contact->id}}">{{$contact->display_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Date:</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="date" value="" class="form-control input-roundless daterange-single" placeholder="Choose date" autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Amount:</label>
                                                    <div class="col-lg-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon label-roundless text-semibold">{{$tenant->base_currency}}</span>
                                                            <input type="text" name="items[0][rate]" value="" class="form-control input-roundless  banking_item_rate text-semibold" placeholder="0.00">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Paid Via:</label>
                                                    <div class="col-lg-9">
                                                        <select name="payment_mode" data-placeholder="Paid Via" class="select-search">
                                                            <option value=""></option>
                                                            @foreach ($payment_modes as $payment_mode)
                                                                <option value="{{$payment_mode->name}}">{{$payment_mode->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Reference:</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="reference" value="" class="form-control input-roundless" placeholder="Reference">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Description:</label>
                                                    <div class="col-lg-9">
                                                        <textarea name="items[0][description]" class="form-control input-roundless banking_item_description" placeholder="Description"></textarea>
                                                    </div>
                                                </div>

                                                @include('banking::tax_form_fields')

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label"> </label>
                                                    <div class="col-lg-9">
                                                        <button type="button" onclick="rg_banking.form_ajax_submit('#banking_supplier_advance form', false);" class="btn btn-danger"><i class="icon-check"></i> Save</button>
                                                    </div>
                                                </div>

                                            </fieldset>

                                        </form>

                                    </div>
                                </div>

                                <div id="banking_supplier_payment" class="txn_form_panel panel panel-flat no-border no-shadow hidden">

                                    <div class="panel-heading no-padding-top">
                                        <h4 class="panel-title">Supplier Payment</h4>
                                        <div class="heading-elements">
                                            <ul class="icons-list">
                                                <li><a class="hide-sidebar-opposite"><i class="icon-cross2 text-muted text-size-large"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="panel-body">

                                        <form action="{{url('banking/transactions')}}" method="post" class="form-horizontal" autocomplete="off">
                                            @csrf
                                            @method('POST')

                                            <input type="hidden" name="submit" value="1" />

                                            <input type="hidden" name="_transaction_id" value="">
                                            <input type="hidden" name="_transaction_status" value="">
                                            <input type="hidden" name="_financial_account_code" value="{{$bank_account->financial_account_code}}">
                                            <input type="hidden" name="bank_account_id" value="{{$bank_account->id}}">
                                            <input type="hidden" name="txn_entree_name" value="payment">
                                            <input type="hidden" name="credit" value="{{$bank_account->financial_account_code}}">
                                            <input type="hidden" name="number" value="NULL">
                                            <input type="hidden" name="base_currency" value="{{$bank_account->currency}}">
                                            <input type="hidden" name="quote_currency" value="{{$bank_account->currency}}">
                                            <input type="hidden" name="exchange_rate" value="1">
                                            <input type="hidden" name="items[0][type]" value="">
                                            <input type="hidden" name="items[0][quantity]" value="1">

                                            <fieldset class="">

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Supplier:</label>
                                                    <div class="col-lg-9">
                                                        <select name="contact_id" data-placeholder="Select Supplier" class="select-search">
                                                            <option value=""></option>
                                                            @foreach ($contacts['supplier'] as $contact)
                                                                <option value="{{$contact->id}}">{{$contact->display_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Date:</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="date" value="" class="form-control input-roundless daterange-single" placeholder="Choose date" autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Amount:</label>
                                                    <div class="col-lg-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon label-roundless text-semibold">{{$tenant->base_currency}}</span>
                                                            <input type="text" name="items[0][rate]" value="" class="form-control input-roundless banking_item_rate text-semibold" placeholder="0.00">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Paid Via:</label>
                                                    <div class="col-lg-9">
                                                        <select name="payment_mode" data-placeholder="Paid Via" class="select-search">
                                                            <option value=""></option>
                                                            @foreach ($payment_modes as $payment_mode)
                                                                <option value="{{$payment_mode->name}}">{{$payment_mode->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Reference:</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="reference" value="" class="form-control input-roundless" placeholder="Reference">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Description:</label>
                                                    <div class="col-lg-9">
                                                        <textarea name="items[0][description]" class="form-control input-roundless banking_item_description" placeholder="Description"></textarea>
                                                    </div>
                                                </div>

                                                @include('banking::tax_form_fields')

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label"> </label>
                                                    <div class="col-lg-9">
                                                        <button type="button" onclick="rg_banking.form_ajax_submit('#banking_supplier_payment form', false);" class="btn btn-danger"><i class="icon-check"></i> Save</button>
                                                    </div>
                                                </div>

                                            </fieldset>

                                        </form>

                                    </div>
                                </div>

                                <div id="banking_transfer_to_another_account" class="txn_form_panel panel panel-flat no-border no-shadow hidden">

                                    <div class="panel-heading no-padding-top">
                                        <h4 class="panel-title">Transfer To Another Account</h4>
                                        <div class="heading-elements">
                                            <ul class="icons-list">
                                                <li><a class="hide-sidebar-opposite"><i class="icon-cross2 text-muted text-size-large"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="panel-body">

                                        <form action="{{url('banking/transactions')}}" method="post" class="form-horizontal" autocomplete="off">
                                            @csrf
                                            @method('POST')

                                            <input type="hidden" name="submit" value="1" />

                                            <input type="hidden" name="_transaction_id" value="">
                                            <input type="hidden" name="_transaction_status" value="">
                                            <input type="hidden" name="_financial_account_code" value="{{$bank_account->financial_account_code}}">
                                            <input type="hidden" name="bank_account_id" value="{{$bank_account->id}}">
                                            <input type="hidden" name="txn_entree_id" value="0">
                                            <input type="hidden" name="txn_type_id" value="0">
                                            <input type="hidden" name="credit" value="{{$bank_account->financial_account_code}}">
                                            <input type="hidden" name="number" value="NULL">
                                            <input type="hidden" name="base_currency" value="{{$bank_account->currency}}">
                                            <input type="hidden" name="quote_currency" value="{{$bank_account->currency}}">
                                            <input type="hidden" name="exchange_rate" value="1">
                                            <input type="hidden" name="items[0][type]" value="">
                                            <input type="hidden" name="items[0][quantity]" value="1">

                                            <fieldset class="">

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">To Account:</label>
                                                    <div class="col-lg-9">
                                                        <select name="_debit_type_id" data-placeholder="Select Account" class="select-search">
                                                            <option value=""></option>
                                                            <optgroup label="Asset Accounts">
                                                                @foreach ($accounts['asset'] as $account)
                                                                    <option value="{{$account->code}}">{{$account->name}}</option>
                                                                @endforeach
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Date: </label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="date" value="" class="form-control input-roundless daterange-single" placeholder="Choose date" autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Amount: </label>
                                                    <div class="col-lg-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon label-roundless text-semibold">{{$tenant->base_currency}}</span>
                                                            <input type="text" name="items[0][rate]" value="" class="form-control input-roundless banking_item_rate text-semibold" placeholder="0.00">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Reference:</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="reference" value="" class="form-control input-roundless" placeholder="Reference">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Description:</label>
                                                    <div class="col-lg-9">
                                                        <textarea name="items[0][description]" class="form-control input-roundless banking_item_description" placeholder="Description"></textarea>
                                                    </div>
                                                </div>

                                                @include('banking::tax_form_fields')

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label"> </label>
                                                    <div class="col-lg-9">
                                                        <button type="button" onclick="rg_banking.form_ajax_submit('#banking_transfer_to_another_account form', false);" class="btn btn-danger"><i class="icon-check"></i> Save</button>
                                                    </div>
                                                </div>

                                            </fieldset>

                                        </form>

                                    </div>
                                </div>

                                <div id="banking_sales_return" class="txn_form_panel panel panel-flat no-border no-shadow hidden">

                                    <div class="panel-heading no-padding-top">
                                        <h4 class="panel-title">Sales Return</h4>
                                        <div class="heading-elements">
                                            <ul class="icons-list">
                                                <li><a class="hide-sidebar-opposite"><i class="icon-cross2 text-muted text-size-large"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="panel-body">

                                        <form action="{{url('banking/transactions')}}" method="post" class="form-horizontal" autocomplete="off">
                                            @csrf
                                            @method('POST')

                                            <input type="hidden" name="submit" value="1" />

                                            <input type="hidden" name="_transaction_id" value="">
                                            <input type="hidden" name="_transaction_status" value="">
                                            <input type="hidden" name="_financial_account_code" value="{{$bank_account->financial_account_code}}">
                                            <input type="hidden" name="bank_account_id" value="{{$bank_account->id}}">
                                            <input type="hidden" name="txn_entree_id" value="0">
                                            <input type="hidden" name="txn_type_id" value="0">
                                            <input type="hidden" name="credit" value="{{$bank_account->financial_account_code}}">
                                            <input type="hidden" name="number" value="NULL">
                                            <input type="hidden" name="base_currency" value="{{$bank_account->currency}}">
                                            <input type="hidden" name="quote_currency" value="{{$bank_account->currency}}">
                                            <input type="hidden" name="exchange_rate" value="1">
                                            <input type="hidden" name="items[0][type]" value="account">
                                            <input type="hidden" name="items[0][quantity]" value="1">

                                            <fieldset class="">

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Revenue Account:</label>
                                                    <div class="col-lg-9">
                                                        <select name="_debit_type_id" data-placeholder="Account" class="select-search">
                                                            <option value=""></option>
                                                            <optgroup label="Revenue / Income Accounts">
                                                                @foreach ($accounts['income'] as $account)
                                                                    <option value="{{$account->code}}">{{$account->name}}</option>
                                                                @endforeach
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Customer:</label>
                                                    <div class="col-lg-9">
                                                        <select name="contact_id" data-placeholder="Select Customer" class="select-search">
                                                            <option value=""></option>
                                                            @foreach ($contacts['customer'] as $contact)
                                                                <option value="{{$contact->id}}">{{$contact->display_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Date:</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="date" value="" class="form-control input-roundless daterange-single" placeholder="Choose date" autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Amount: </label>
                                                    <div class="col-lg-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon label-roundless text-semibold">{{$tenant->base_currency}}</span>
                                                            <input type="text" name="items[0][rate]" value="" class="form-control input-roundless banking_item_rate text-semibold" placeholder="0.00">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Paid via:</label>
                                                    <div class="col-lg-9">
                                                        <select name="payment_mode" data-placeholder="Paid Via" class="select-search">
                                                            <option value=""></option>
                                                            @foreach ($payment_modes as $payment_mode)
                                                                <option value="{{$payment_mode->name}}">{{$payment_mode->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Reference:</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="reference" value="" class="form-control input-roundless" placeholder="Reference">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Description:</label>
                                                    <div class="col-lg-9">
                                                        <textarea name="items[0][description]" class="form-control input-roundless banking_item_description" placeholder="Description"></textarea>
                                                    </div>
                                                </div>

                                                @include('banking::tax_form_fields')

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label"> </label>
                                                    <div class="col-lg-9">
                                                        <button type="button" onclick="rg_banking.form_ajax_submit('#banking_sales_return form', false);" class="btn btn-danger"><i class="icon-check"></i> Save</button>
                                                    </div>
                                                </div>

                                            </fieldset>

                                        </form>

                                    </div>
                                </div>

                                <div id="banking_card_payment" class="txn_form_panel panel panel-flat no-border no-shadow hidden">

                                    <div class="panel-heading no-padding-top">
                                        <h4 class="panel-title">Card Payment</h4>
                                        <div class="heading-elements">
                                            <ul class="icons-list">
                                                <li><a class="hide-sidebar-opposite"><i class="icon-cross2 text-muted text-size-large"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="panel-body">

                                        <form action="{{url('banking/transactions')}}" method="post" class="form-horizontal" autocomplete="off">
                                            @csrf
                                            @method('POST')

                                            <input type="hidden" name="submit" value="1" />

                                            <input type="hidden" name="_transaction_id" value="">
                                            <input type="hidden" name="_transaction_status" value="">
                                            <input type="hidden" name="_financial_account_code" value="{{$bank_account->financial_account_code}}">
                                            <input type="hidden" name="bank_account_id" value="{{$bank_account->id}}">
                                            <input type="hidden" name="txn_entree_id" value="payment">
                                            <input type="hidden" name="credit" value="{{$bank_account->financial_account_code}}">
                                            <input type="hidden" name="number" value="NULL">
                                            <input type="hidden" name="base_currency" value="{{$bank_account->currency}}">
                                            <input type="hidden" name="quote_currency" value="{{$bank_account->currency}}">
                                            <input type="hidden" name="exchange_rate" value="1">
                                            <input type="hidden" name="items[0][type]" value="">
                                            <input type="hidden" name="items[0][type_id]" value="">
                                            <input type="hidden" name="items[0][quantity]" value="1">

                                            <fieldset class="">

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Paid to:</label>
                                                    <div class="col-lg-9">
                                                        <select name="contact_id" data-placeholder="Paid to" class="select-search">
                                                            <option value=""></option>
                                                            @foreach ($contacts['supplier'] as $contact)
                                                                <option value="{{$contact->id}}">{{$contact->display_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Date:</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="date" value="" class="form-control input-roundless daterange-single" placeholder="Choose date" autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Amount:</label>
                                                    <div class="col-lg-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon label-roundless text-semibold">{{$tenant->base_currency}}</span>
                                                            <input type="text" name="items[0][rate]" value="" class="form-control input-roundless banking_item_rate text-semibold" placeholder="0.00">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Reference:</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="reference" value="" class="form-control input-roundless" placeholder="Reference">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Description:</label>
                                                    <div class="col-lg-9">
                                                        <textarea name="items[0][description]" class="form-control input-roundless banking_item_description" placeholder="Description"></textarea>
                                                    </div>
                                                </div>

                                                @include('banking::tax_form_fields')

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label"> </label>
                                                    <div class="col-lg-9">
                                                        <button type="button" onclick="rg_banking.form_ajax_submit('#banking_card_payment form', false);" class="btn btn-danger"><i class="icon-check"></i> Save</button>
                                                    </div>
                                                </div>

                                            </fieldset>

                                        </form>

                                    </div>
                                </div>

                                <div id="banking_owner_drawings" class="txn_form_panel panel panel-flat no-border no-shadow hidden">

                                    <div class="panel-heading no-padding-top">
                                        <h4 class="panel-title">Owner Drawings</h4>
                                        <div class="heading-elements">
                                            <ul class="icons-list">
                                                <li><a class="hide-sidebar-opposite"><i class="icon-cross2 text-muted text-size-large"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="panel-body">

                                        <form action="{{url('banking/transactions')}}" method="post" class="form-horizontal" autocomplete="off">
                                            @csrf
                                            @method('POST')

                                            <input type="hidden" name="submit" value="1" />

                                            <input type="hidden" name="_transaction_id" value="">
                                            <input type="hidden" name="_transaction_status" value="">
                                            <input type="hidden" name="_financial_account_code" value="{{$bank_account->financial_account_code}}">
                                            <input type="hidden" name="bank_account_id" value="{{$bank_account->id}}">
                                            <input type="hidden" name="txn_entree_id" value="0">
                                            <input type="hidden" name="txn_type_id" value="0">
                                            <input type="hidden" name="credit" value="{{$bank_account->financial_account_code}}">
                                            <input type="hidden" name="number" value="NULL">
                                            <input type="hidden" name="base_currency" value="{{$bank_account->currency}}">
                                            <input type="hidden" name="quote_currency" value="{{$bank_account->currency}}">
                                            <input type="hidden" name="exchange_rate" value="1">
                                            <input type="hidden" name="items[0][type]" value="account">
                                            <input type="hidden" name="items[0][quantity]" value="1">

                                            <fieldset class="">

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">To Account:</label>
                                                    <div class="col-lg-9">
                                                        <select name="_debit_type_id" data-placeholder="To Account" class="select-search">
                                                            <option value=""></option>
                                                            <optgroup label="Equity Accounts">
                                                                @foreach ($accounts['equity'] as $account)
                                                                    <option value="{{$account->code}}">{{$account->name}}</option>
                                                                @endforeach
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Date: </label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="date" value="" class="form-control input-roundless daterange-single" placeholder="Choose date" autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Amount: </label>
                                                    <div class="col-lg-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon label-roundless text-semibold">{{$tenant->base_currency}}</span>
                                                            <input type="text" name="items[0][rate]" value="" class="form-control input-roundless banking_item_rate text-semibold" placeholder="0.00">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Reference:</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="reference" value="" class="form-control input-roundless" placeholder="Reference">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Description:</label>
                                                    <div class="col-lg-9">
                                                        <textarea name="items[0][description]" class="form-control input-roundless banking_item_description" placeholder="Description"></textarea>
                                                    </div>
                                                </div>

                                                @include('banking::tax_form_fields')

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label"> </label>
                                                    <div class="col-lg-9">
                                                        <button type="button" onclick="rg_banking.form_ajax_submit('#banking_owner_drawings form', false);" class="btn btn-danger"><i class="icon-check"></i> Save</button>
                                                    </div>
                                                </div>

                                            </fieldset>

                                        </form>

                                    </div>
                                </div>

                                <div id="banking_credit_note_refund" class="txn_form_panel panel panel-flat no-border no-shadow hidden">

                                    <div class="panel-heading no-padding-top">
                                        <h4 class="panel-title">Credit Note Refund</h4>
                                        <div class="heading-elements">
                                            <ul class="icons-list">
                                                <li><a class="hide-sidebar-opposite"><i class="icon-cross2 text-muted text-size-large"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="panel-body">

                                        <form action="{{url('banking/transactions')}}" method="post" class="form-horizontal" autocomplete="off">
                                            @csrf
                                            @method('POST')

                                            <input type="hidden" name="submit" value="1" />

                                            <input type="hidden" name="_transaction_id" value="">
                                            <input type="hidden" name="_transaction_status" value="">
                                            <input type="hidden" name="_financial_account_code" value="{{$bank_account->financial_account_code}}">
                                            <input type="hidden" name="bank_account_id" value="{{$bank_account->id}}">
                                            <input type="hidden" name="txn_entree_id" value="0">
                                            <input type="hidden" name="txn_type_id" value="0">
                                            <input type="hidden" name="debit" value="2">{{-- sales account --}}
                                            <input type="hidden" name="credit" value="{{$bank_account->financial_account_code}}">
                                            <input type="hidden" name="number" value="NULL">
                                            <input type="hidden" name="base_currency" value="{{$bank_account->currency}}">
                                            <input type="hidden" name="quote_currency" value="{{$bank_account->currency}}">
                                            <input type="hidden" name="exchange_rate" value="1">
                                            <input type="hidden" name="items[0][type]" value="">
                                            <input type="hidden" name="items[0][type_id]" value="">
                                            <input type="hidden" name="items[0][quantity]" value="1">

                                            <fieldset class="">

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Supplier:</label>
                                                    <div class="col-lg-9">
                                                        <select name="contact_id" data-placeholder="Select supplier" class="select-search">
                                                            <option value=""></option>
                                                            @foreach ($contacts['supplier'] as $contact)
                                                                <option value="{{$contact->id}}">{{$contact->display_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Date:</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="date" value="" class="form-control input-roundless daterange-single" placeholder="Choose date" autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Received via:</label>
                                                    <div class="col-lg-9">
                                                        <select name="payment_mode" data-placeholder="Received Via" class="select-search">
                                                            <option value=""></option>
                                                            @foreach ($payment_modes as $payment_mode)
                                                                <option value="{{$payment_mode->name}}">{{$payment_mode->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Reference:</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="reference" value="" class="form-control input-roundless" placeholder="Reference">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Description :</label>
                                                    <div class="col-lg-9">
                                                        <textarea name="items[0][description]" class="form-control input-roundless banking_item_description" placeholder="Description"></textarea>
                                                    </div>
                                                </div>

                                                @include('banking::tax_form_fields')

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label"> </label>
                                                    <div class="col-lg-9">
                                                        <button type="button" onclick="rg_banking.form_ajax_submit('#banking_credit_note_refund form', false);" class="btn btn-danger"><i class="icon-check"></i> Save</button>
                                                    </div>
                                                </div>

                                            </fieldset>

                                        </form>

                                    </div>
                                </div>

                                <div id="banking_payment_refund" class="txn_form_panel panel panel-flat no-border no-shadow hidden">

                                    <div class="panel-heading no-padding-top">
                                        <h4 class="panel-title">Payment Refund</h4>
                                        <div class="heading-elements">
                                            <ul class="icons-list">
                                                <li><a class="hide-sidebar-opposite"><i class="icon-cross2 text-muted text-size-large"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="panel-body">

                                        <form action="{{url('banking/transactions')}}" method="post" class="form-horizontal" autocomplete="off">
                                            @csrf
                                            @method('POST')

                                            <input type="hidden" name="submit" value="1" />

                                            <input type="hidden" name="_transaction_id" value="">
                                            <input type="hidden" name="_transaction_status" value="">
                                            <input type="hidden" name="_financial_account_code" value="{{$bank_account->financial_account_code}}">
                                            <input type="hidden" name="bank_account_id" value="{{$bank_account->id}}">
                                            <input type="hidden" name="txn_entree_id" value="0">
                                            <input type="hidden" name="txn_type_id" value="0">
                                            <input type="hidden" name="debit" value="1">{{--Receivables (Customers)--}}
                                            <input type="hidden" name="credit" value="{{$bank_account->financial_account_code}}">
                                            <input type="hidden" name="number" value="NULL">
                                            <input type="hidden" name="base_currency" value="{{$bank_account->currency}}">
                                            <input type="hidden" name="quote_currency" value="{{$bank_account->currency}}">
                                            <input type="hidden" name="exchange_rate" value="1">
                                            <input type="hidden" name="items[0][type]" value="">
                                            <input type="hidden" name="items[0][type_id]" value="">
                                            <input type="hidden" name="items[0][quantity]" value="1">

                                            <fieldset class="">

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Customer:</label>
                                                    <div class="col-lg-9">
                                                        <select name="contact_id" data-placeholder="Select Customer" class="select-search">
                                                            <option value=""></option>
                                                            @foreach ($contacts['customer'] as $contact)
                                                                <option value="{{$contact->id}}">{{$contact->display_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Date:</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="date" value="" class="form-control input-roundless daterange-single" placeholder="Choose date" autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Paid via:</label>
                                                    <div class="col-lg-9">
                                                        <select name="payment_mode" data-placeholder="Paid Via" class="select-search">
                                                            <option value=""></option>
                                                            @foreach ($payment_modes as $payment_mode)
                                                                <option value="{{$payment_mode->name}}">{{$payment_mode->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Reference:</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="reference" value="" class="form-control input-roundless" placeholder="Reference">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Description:</label>
                                                    <div class="col-lg-9">
                                                        <textarea name="items[0][description]" class="form-control input-roundless banking_item_description" placeholder="Description"></textarea>
                                                    </div>
                                                </div>

                                                @include('banking::tax_form_fields')

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label"> </label>
                                                    <div class="col-lg-9">
                                                        <button type="button" onclick="rg_banking.form_ajax_submit('#banking_payment_refund form', false);" class="btn btn-danger"><i class="icon-check"></i> Save</button>
                                                    </div>
                                                </div>

                                            </fieldset>

                                        </form>

                                    </div>
                                </div>

                                <!-- MONEY IN -->
                                <div id="banking_customer_advance" class="txn_form_panel panel panel-flat no-border no-shadow hidden">

                                    <div class="panel-heading no-padding-top">
                                        <h4 class="panel-title">Customer Advance</h4>
                                        <div class="heading-elements">
                                            <ul class="icons-list">
                                                <li><a class="hide-sidebar-opposite"><i class="icon-cross2 text-muted text-size-large"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="panel-body">

                                        <form action="{{url('banking/transactions')}}" method="post" class="form-horizontal" autocomplete="off">
                                            @csrf
                                            @method('POST')

                                            <input type="hidden" name="submit" value="1" />

                                            <input type="hidden" name="_transaction_id" value="">
                                            <input type="hidden" name="_transaction_status" value="">
                                            <input type="hidden" name="_financial_account_code" value="{{$bank_account->financial_account_code}}">
                                            <input type="hidden" name="bank_account_id" value="{{$bank_account->id}}">
                                            <input type="hidden" name="txn_entree_name" value="receipt">
                                            <input type="hidden" name="debit" value="{{$bank_account->financial_account_code}}">
                                            <input type="hidden" name="number" value="NULL">
                                            <input type="hidden" name="base_currency" value="{{$bank_account->currency}}">
                                            <input type="hidden" name="quote_currency" value="{{$bank_account->currency}}">
                                            <input type="hidden" name="exchange_rate" value="1">
                                            <input type="hidden" name="items[0][type]" value="">
                                            <input type="hidden" name="items[0][type_id]" value="">
                                            <input type="hidden" name="items[0][quantity]" value="1">

                                            <fieldset class="">

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Customer:</label>
                                                    <div class="col-lg-9">
                                                        <select name="contact_id" data-placeholder="Select Customer" class="select-search">
                                                            <option value=""></option>
                                                            @foreach ($contacts['customer'] as $contact)
                                                                <option value="{{$contact->id}}">{{$contact->display_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Amount:</label>
                                                    <div class="col-lg-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon label-roundless text-semibold">{{$tenant->base_currency}}</span>
                                                            <input type="text" name="items[0][rate]" value="" class="form-control input-roundless banking_item_rate text-semibold" placeholder="0.00">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Date:</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="date" value="" class="form-control input-roundless daterange-single" placeholder="Choose date" autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Received via:</label>
                                                    <div class="col-lg-9">
                                                        <select name="payment_mode" data-placeholder="Received Via" class="select-search">
                                                            <option value=""></option>
                                                            @foreach ($payment_modes as $payment_mode)
                                                                <option value="{{$payment_mode->name}}">{{$payment_mode->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Reference:</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="reference" value="" class="form-control input-roundless" placeholder="Reference">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Description:</label>
                                                    <div class="col-lg-9">
                                                        <textarea name="items[0][description]" class="form-control input-roundless banking_item_description" placeholder="Description"></textarea>
                                                    </div>
                                                </div>

                                                @include('banking::tax_form_fields')

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label"> </label>
                                                    <div class="col-lg-9">
                                                        <button type="button" onclick="rg_banking.form_ajax_submit('#banking_customer_advance form', false);" class="btn btn-danger"><i class="icon-check"></i> Save</button>
                                                    </div>
                                                </div>

                                            </fieldset>

                                        </form>

                                    </div>
                                </div>

                                <div id="banking_customer_payment" class="txn_form_panel panel panel-flat no-border no-shadow hidden">

                                    <div class="panel-heading no-padding-top">
                                        <h4 class="panel-title">Customer Payment</h4>
                                        <div class="heading-elements">
                                            <ul class="icons-list">
                                                <li><a class="hide-sidebar-opposite"><i class="icon-cross2 text-muted text-size-large"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="panel-body">

                                        <form action="{{url('banking/transactions')}}" method="post" class="form-horizontal" autocomplete="off">
                                            @csrf
                                            @method('POST')

                                            <input type="hidden" name="submit" value="1" />

                                            <input type="hidden" name="_transaction_id" value="">
                                            <input type="hidden" name="_transaction_status" value="">
                                            <input type="hidden" name="_financial_account_code" value="{{$bank_account->financial_account_code}}">
                                            <input type="hidden" name="bank_account_id" value="{{$bank_account->id}}">
                                            <input type="hidden" name="txn_entree_name" value="receipt">
                                            <input type="hidden" name="debit" value="{{$bank_account->financial_account_code}}">
                                            <input type="hidden" name="number" value="NULL">
                                            <input type="hidden" name="base_currency" value="{{$bank_account->currency}}">
                                            <input type="hidden" name="quote_currency" value="{{$bank_account->currency}}">
                                            <input type="hidden" name="exchange_rate" value="1">
                                            <input type="hidden" name="items[0][type]" value="">
                                            <input type="hidden" name="items[0][type_id]" value="">
                                            <input type="hidden" name="items[0][quantity]" value="1">

                                            <fieldset class="">

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Customer:</label>
                                                    <div class="col-lg-9">
                                                        <select name="contact_id" data-placeholder="Select Customer" class="select-search">
                                                            <option value=""></option>
                                                            @foreach ($contacts['customer'] as $contact)
                                                                <option value="{{$contact->id}}">{{$contact->display_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Amount:</label>
                                                    <div class="col-lg-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon label-roundless text-semibold">{{$tenant->base_currency}}</span>
                                                            <input type="text" name="items[0][rate]" value="" class="form-control input-roundless banking_item_rate text-semibold" placeholder="0.00">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Date:</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="date" value="" class="form-control input-roundless daterange-single" placeholder="Choose date" autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Received Via:</label>
                                                    <div class="col-lg-9">
                                                        <select name="payment_mode" data-placeholder="Received Via" class="select-search">
                                                            <option value=""></option>
                                                            @foreach ($payment_modes as $payment_mode)
                                                                <option value="{{$payment_mode->name}}">{{$payment_mode->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Reference:</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="reference" value="" class="form-control input-roundless" placeholder="Reference">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Description :</label>
                                                    <div class="col-lg-9">
                                                        <textarea name="items[0][description]" class="form-control input-roundless banking_item_description" placeholder="Description"></textarea>
                                                    </div>
                                                </div>

                                                @include('banking::tax_form_fields')

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label"> </label>
                                                    <div class="col-lg-9">
                                                        <button type="button" onclick="rg_banking.form_ajax_submit('#banking_customer_payment form', false);" class="btn btn-danger"><i class="icon-check"></i> Save</button>
                                                    </div>
                                                </div>

                                            </fieldset>

                                        </form>

                                    </div>
                                </div>

                                <div id="banking_retainer_payment" class="txn_form_panel panel panel-flat no-border no-shadow hidden">

                                    <div class="panel-heading no-padding-top">
                                        <h4 class="panel-title">Retainer Payment</h4>
                                        <div class="heading-elements">
                                            <ul class="icons-list">
                                                <li><a class="hide-sidebar-opposite"><i class="icon-cross2 text-muted text-size-large"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="panel-body">

                                        <form action="{{url('banking/transactions')}}" method="post" class="form-horizontal" autocomplete="off">
                                            @csrf
                                            @method('POST')

                                            <input type="hidden" name="submit" value="1" />

                                            <input type="hidden" name="_transaction_id" value="">
                                            <input type="hidden" name="_transaction_status" value="">
                                            <input type="hidden" name="_financial_account_code" value="{{$bank_account->financial_account_code}}">
                                            <input type="hidden" name="bank_account_id" value="{{$bank_account->id}}">
                                            <input type="hidden" name="txn_entree_name" value="receipt">
                                            <input type="hidden" name="debit" value="{{$bank_account->financial_account_code}}">
                                            <input type="hidden" name="number" value="NULL">
                                            <input type="hidden" name="base_currency" value="{{$bank_account->currency}}">
                                            <input type="hidden" name="quote_currency" value="{{$bank_account->currency}}">
                                            <input type="hidden" name="exchange_rate" value="1">
                                            <input type="hidden" name="items[0][type]" value="">
                                            <input type="hidden" name="items[0][type_id]" value="">
                                            <input type="hidden" name="items[0][quantity]" value="1">

                                            <fieldset class="">

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Customer:</label>
                                                    <div class="col-lg-9">
                                                        <select name="contact_id" data-placeholder="Select Customer" class="select-search">
                                                            <option value=""></option>
                                                            @foreach ($contacts['customer'] as $contact)
                                                                <option value="{{$contact->id}}">{{$contact->display_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Amount:</label>
                                                    <div class="col-lg-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon label-roundless text-semibold">{{$tenant->base_currency}}</span>
                                                            <input type="text" name="items[0][rate]" value="" class="form-control input-roundless banking_item_rate text-semibold" placeholder="0.00">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Date:</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="date" value="" class="form-control input-roundless daterange-single" placeholder="Choose date" autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Received Via:</label>
                                                    <div class="col-lg-9">
                                                        <select name="payment_mode" data-placeholder="Received Via" class="select-search">
                                                            <option value=""></option>
                                                            @foreach ($payment_modes as $payment_mode)
                                                                <option value="{{$payment_mode->name}}">{{$payment_mode->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Reference:</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="reference" value="" class="form-control input-roundless" placeholder="Reference">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Description :</label>
                                                    <div class="col-lg-9">
                                                        <textarea name="items[0][description]" class="form-control input-roundless banking_item_description" placeholder="Description"></textarea>
                                                    </div>
                                                </div>

                                                @include('banking::tax_form_fields')

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label"> </label>
                                                    <div class="col-lg-9">
                                                        <button type="button" onclick="rg_banking.form_ajax_submit('#banking_retainer_payment form', false);" class="btn btn-danger"><i class="icon-check"></i> Save</button>
                                                    </div>
                                                </div>

                                            </fieldset>

                                        </form>

                                    </div>
                                </div>

                                <div id="banking_sales_without_invoice" class="txn_form_panel panel panel-flat no-border no-shadow hidden">

                                    <div class="panel-heading no-padding-top">
                                        <h4 class="panel-title">Sales Without Invoice</h4>
                                        <div class="heading-elements">
                                            <ul class="icons-list">
                                                <li><a class="hide-sidebar-opposite"><i class="icon-cross2 text-muted text-size-large"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="panel-body">

                                        <form action="{{url('banking/transactions')}}" method="post" class="form-horizontal" autocomplete="off">
                                            @csrf
                                            @method('POST')

                                            <input type="hidden" name="submit" value="1" />

                                            <input type="hidden" name="_transaction_id" value="">
                                            <input type="hidden" name="_transaction_status" value="">
                                            <input type="hidden" name="_financial_account_code" value="{{$bank_account->financial_account_code}}">
                                            <input type="hidden" name="bank_account_id" value="{{$bank_account->id}}">
                                            <input type="hidden" name="txn_entree_name" value="0">
                                            <input type="hidden" name="txn_type_id" value="2">
                                            <input type="hidden" name="debit" value="{{$bank_account->financial_account_code}}">
                                            <input type="hidden" name="number" value="NULL">
                                            <input type="hidden" name="base_currency" value="{{$bank_account->currency}}">
                                            <input type="hidden" name="quote_currency" value="{{$bank_account->currency}}">
                                            <input type="hidden" name="exchange_rate" value="1">
                                            <input type="hidden" name="items[0][type]" value="account">
                                            <input type="hidden" name="items[0][quantity]" value="1">

                                            <fieldset class="">

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Revenue Account:</label>
                                                    <div class="col-lg-9">
                                                        <select name="_credit_type_id" data-placeholder="Revenue Account" class="select-search">
                                                            <option value=""></option>
                                                            <optgroup label="Revenue / Income Accounts">
                                                                @foreach ($accounts['income'] as $account)
                                                                    <option value="{{$account->code}}">{{$account->name}}</option>
                                                                @endforeach
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Customer:</label>
                                                    <div class="col-lg-9">
                                                        <select name="contact_id" data-placeholder="Select Customer" class="select-search">
                                                            <option value=""></option>
                                                            @foreach ($contacts['customer'] as $contact)
                                                                <option value="{{$contact->id}}">{{$contact->display_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Date:</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="date" value="" class="form-control input-roundless daterange-single" placeholder="Choose date" autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Amount:</label>
                                                    <div class="col-lg-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon label-roundless text-semibold">{{$tenant->base_currency}}</span>
                                                            <input type="text" name="items[0][rate]" value="" class="form-control input-roundless banking_item_rate text-semibold" placeholder="0.00">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Received Via:</label>
                                                    <div class="col-lg-9">
                                                        <select name="payment_mode" data-placeholder="Received Via" class="select-search">
                                                            <option value=""></option>
                                                            @foreach ($payment_modes as $payment_mode)
                                                                <option value="{{$payment_mode->name}}">{{$payment_mode->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Reference:</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="reference" value="" class="form-control input-roundless" placeholder="Reference">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Description:</label>
                                                    <div class="col-lg-9">
                                                        <textarea name="items[0][description]" class="form-control input-roundless banking_item_description" placeholder="Description"></textarea>
                                                    </div>
                                                </div>

                                                @include('banking::tax_form_fields')

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label"> </label>
                                                    <div class="col-lg-9">
                                                        <button type="button" onclick="rg_banking.form_ajax_submit('#banking_sales_without_invoice form', false);" class="btn btn-danger"><i class="icon-check"></i> Save</button>
                                                    </div>
                                                </div>

                                            </fieldset>

                                        </form>

                                    </div>
                                </div>

                                <div id="banking_transfer_from_another_account" class="txn_form_panel panel panel-flat no-border no-shadow hidden">

                                    <div class="panel-heading no-padding-top">
                                        <h4 class="panel-title">Transfer From Another Account</h4>
                                        <div class="heading-elements">
                                            <ul class="icons-list">
                                                <li><a class="hide-sidebar-opposite"><i class="icon-cross2 text-muted text-size-large"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="panel-body">

                                        <form action="{{url('banking/transactions')}}" method="post" class="form-horizontal" autocomplete="off">
                                            @csrf
                                            @method('POST')

                                            <input type="hidden" name="submit" value="1" />

                                            <input type="hidden" name="_transaction_id" value="">
                                            <input type="hidden" name="_transaction_status" value="">
                                            <input type="hidden" name="_financial_account_code" value="{{$bank_account->financial_account_code}}">
                                            <input type="hidden" name="bank_account_id" value="{{$bank_account->id}}">
                                            <input type="hidden" name="txn_entree_name" value="0">
                                            <input type="hidden" name="txn_type_id" value="0">
                                            <input type="hidden" name="debit" value="{{$bank_account->financial_account_code}}">
                                            <input type="hidden" name="number" value="NULL">
                                            <input type="hidden" name="base_currency" value="{{$bank_account->currency}}">
                                            <input type="hidden" name="quote_currency" value="{{$bank_account->currency}}">
                                            <input type="hidden" name="exchange_rate" value="1">
                                            <input type="hidden" name="items[0][type]" value="account">
                                            <input type="hidden" name="items[0][quantity]" value="1">

                                            <fieldset class="">

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Account:</label>
                                                    <div class="col-lg-9">
                                                        <select name="_credit_type_id" data-placeholder="Select Account" class="select-search">
                                                            <option value=""></option>
                                                            <optgroup label="Asset Accounts">
                                                                @foreach ($accounts['asset'] as $account)
                                                                    <option value="{{$account->code}}">{{$account->name}}</option>
                                                                @endforeach
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Date:</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="date" value="" class="form-control input-roundless daterange-single" placeholder="Choose date" autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Amount:</label>
                                                    <div class="col-lg-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon label-roundless text-semibold">{{$tenant->base_currency}}</span>
                                                            <input type="text" name="items[0][rate]" value="" class="form-control input-roundless banking_item_rate text-semibold" placeholder="0.00">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Reference:</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="reference" value="" class="form-control input-roundless" placeholder="Reference">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Description:</label>
                                                    <div class="col-lg-9">
                                                        <textarea name="items[0][description]" class="form-control input-roundless banking_item_description" placeholder="Description"></textarea>
                                                    </div>
                                                </div>

                                                @include('banking::tax_form_fields')

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label"> </label>
                                                    <div class="col-lg-9">
                                                        <button type="button" onclick="rg_banking.form_ajax_submit('#banking_transfer_from_another_account form', false);" class="btn btn-danger"><i class="icon-check"></i> Save</button>
                                                    </div>
                                                </div>

                                            </fieldset>

                                        </form>

                                    </div>
                                </div>

                                <div id="banking_interest_income" class="txn_form_panel panel panel-flat no-border no-shadow hidden">

                                    <div class="panel-heading no-padding-top">
                                        <h4 class="panel-title">Interest Income</h4>
                                        <div class="heading-elements">
                                            <ul class="icons-list">
                                                <li><a class="hide-sidebar-opposite"><i class="icon-cross2 text-muted text-size-large"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="panel-body">

                                        <form action="{{url('banking/transactions')}}" method="post" class="form-horizontal" autocomplete="off">
                                            @csrf
                                            @method('POST')

                                            <input type="hidden" name="submit" value="1" />

                                            <input type="hidden" name="_transaction_id" value="">
                                            <input type="hidden" name="_transaction_status" value="">
                                            <input type="hidden" name="_financial_account_code" value="{{$bank_account->financial_account_code}}">
                                            <input type="hidden" name="bank_account_id" value="{{$bank_account->id}}">
                                            <input type="hidden" name="txn_entree_id" value="0">
                                            <input type="hidden" name="txn_type_id" value="0">
                                            <input type="hidden" name="contact_id" value="{{optional($bank->contact)->id}}">
                                            <input type="hidden" name="debit" value="{{$bank_account->financial_account_code}}">
                                            <input type="hidden" name="credit" value="<?php echo 192; //Interest earned from Local source ?>">
                                            <input type="hidden" name="number" value="NULL">
                                            <input type="hidden" name="base_currency" value="{{$bank_account->currency}}">
                                            <input type="hidden" name="quote_currency" value="{{$bank_account->currency}}">
                                            <input type="hidden" name="exchange_rate" value="1">
                                            <input type="hidden" name="items[0][type]" value="account">
                                            <input type="hidden" name="items[0][type_id]" value="account">
                                            <input type="hidden" name="items[0][quantity]" value="1">

                                            <fieldset class="">

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Contact / Bank</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="contact_name" value="{{optional($bank->contact)->name}}" class="form-control input-roundless" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Date:</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="date" value="" class="form-control input-roundless daterange-single" placeholder="Choose date" autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Amount:</label>
                                                    <div class="col-lg-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon label-roundless text-semibold">{{$tenant->base_currency}}</span>
                                                            <input type="text" name="items[0][rate]" value="" class="form-control input-roundless banking_item_rate text-semibold" placeholder="0.00">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Reference:</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="reference" value="" class="form-control input-roundless" placeholder="Reference">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Description:</label>
                                                    <div class="col-lg-9">
                                                        <textarea name="items[0][description]" class="form-control input-roundless banking_item_description" placeholder="Description"></textarea>
                                                    </div>
                                                </div>

                                                @include('banking::tax_form_fields')

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label"> </label>
                                                    <div class="col-lg-9">
                                                        <button type="button" onclick="rg_banking.form_ajax_submit('#banking_interest_income form', true);" class="btn btn-danger"><i class="icon-check"></i> Save</button>
                                                    </div>
                                                </div>

                                            </fieldset>

                                        </form>

                                    </div>
                                </div>

                                <div id="banking_other_income" class="txn_form_panel panel panel-flat no-border no-shadow hidden">

                                    <div class="panel-heading no-padding-top">
                                        <h4 class="panel-title">Other Income</h4>
                                        <div class="heading-elements">
                                            <ul class="icons-list">
                                                <li><a class="hide-sidebar-opposite"><i class="icon-cross2 text-muted text-size-large"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="panel-body">

                                        <form action="{{url('banking/transactions')}}" method="post" class="form-horizontal" autocomplete="off">
                                            @csrf
                                            @method('POST')

                                            <input type="hidden" name="submit" value="1" />

                                            <input type="hidden" name="_transaction_id" value="">
                                            <input type="hidden" name="_transaction_status" value="">
                                            <input type="hidden" name="_financial_account_code" value="{{$bank_account->financial_account_code}}">
                                            <input type="hidden" name="bank_account_id" value="{{$bank_account->id}}">
                                            <input type="hidden" name="txn_entree_id" value="0">
                                            <input type="hidden" name="txn_type_id" value="0">
                                            <input type="hidden" name="debit" value="{{$bank_account->financial_account_code}}">
                                            <input type="hidden" name="number" value="NULL">
                                            <input type="hidden" name="base_currency" value="{{$bank_account->currency}}">
                                            <input type="hidden" name="quote_currency" value="{{$bank_account->currency}}">
                                            <input type="hidden" name="exchange_rate" value="1">
                                            <input type="hidden" name="items[0][type]" value="account">
                                            <input type="hidden" name="items[0][quantity]" value="1">

                                            <fieldset class="">

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">From Account:</label>
                                                    <div class="col-lg-9">
                                                        <select name="_credit_type_id" data-placeholder="From Account" class="select-search">
                                                            <option value=""></option>
                                                            <optgroup label="Income / Revenue Accounts">
                                                                @foreach ($accounts['income'] as $account)
                                                                    <option value="{{$account->code}}">{{$account->name}}</option>
                                                                @endforeach
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Date:</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="date" value="" class="form-control input-roundless daterange-single" placeholder="Choose date" autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Amount:</label>
                                                    <div class="col-lg-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon label-roundless text-semibold">{{$tenant->base_currency}}</span>
                                                            <input type="text" name="items[0][rate]" value="" class="form-control input-roundless banking_item_rate text-semibold" placeholder="0.00">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Received Via:</label>
                                                    <div class="col-lg-9">
                                                        <select name="payment_mode" data-placeholder="Received Via" class="select-search">
                                                            <option value=""></option>
                                                            @foreach ($payment_modes as $payment_mode)
                                                                <option value="{{$payment_mode->name}}">{{$payment_mode->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Reference:</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="reference" value="" class="form-control input-roundless" placeholder="Reference">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Description:</label>
                                                    <div class="col-lg-9">
                                                        <textarea name="items[0][description]" class="form-control input-roundless banking_item_description" placeholder="Description"></textarea>
                                                    </div>
                                                </div>

                                                @include('banking::tax_form_fields')

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label"> </label>
                                                    <div class="col-lg-9">
                                                        <button type="button" onclick="rg_banking.form_ajax_submit('#banking_other_income form', false);" class="btn btn-danger"><i class="icon-check"></i> Save</button>
                                                    </div>
                                                </div>

                                            </fieldset>

                                        </form>

                                    </div>
                                </div>

                                <div id="banking_expense_refund" class="txn_form_panel panel panel-flat no-border no-shadow hidden">

                                    <div class="panel-heading no-padding-top">
                                        <h4 class="panel-title">Expense Refund</h4>
                                        <div class="heading-elements">
                                            <ul class="icons-list">
                                                <li><a class="hide-sidebar-opposite"><i class="icon-cross2 text-muted text-size-large"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="panel-body">

                                        <form action="{{url('banking/transactions')}}" method="post" class="form-horizontal" autocomplete="off">
                                            @csrf
                                            @method('POST')

                                            <input type="hidden" name="submit" value="1" />

                                            <input type="hidden" name="_transaction_id" value="">
                                            <input type="hidden" name="_transaction_status" value="">
                                            <input type="hidden" name="_financial_account_code" value="{{$bank_account->financial_account_code}}">
                                            <input type="hidden" name="bank_account_id" value="{{$bank_account->id}}">
                                            <input type="hidden" name="txn_entree_id" value="0">
                                            <input type="hidden" name="txn_type_id" value="0">
                                            <input type="hidden" name="debit" value="{{$bank_account->financial_account_code}}">
                                            <input type="hidden" name="number" value="NULL">
                                            <input type="hidden" name="base_currency" value="{{$bank_account->currency}}">
                                            <input type="hidden" name="quote_currency" value="{{$bank_account->currency}}">
                                            <input type="hidden" name="exchange_rate" value="1">
                                            <input type="hidden" name="items[0][type]" value="account">
                                            <input type="hidden" name="items[0][quantity]" value="1">

                                            <fieldset class="">

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">From Account:</label>
                                                    <div class="col-lg-9">
                                                        <select name="_credit_type_id" data-placeholder="From Account" class="select-search">
                                                            <option value=""></option>
                                                            <optgroup label="Expense Accounts">
                                                                @foreach ($accounts['expense'] as $account)
                                                                    <option value="{{$account->code}}">{{$account->name}}</option>
                                                                @endforeach
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Date:</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="date" value="" class="form-control input-roundless daterange-single" placeholder="Choose date" autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Amount:</label>
                                                    <div class="col-lg-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon label-roundless text-semibold">{{$tenant->base_currency}}</span>
                                                            <input type="text" name="items[0][rate]" value="" class="form-control input-roundless banking_item_rate text-semibold" placeholder="0.00">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Received via:</label>
                                                    <div class="col-lg-9">
                                                        <select name="payment_mode" data-placeholder="Received Via" class="select-search">
                                                            <option value=""></option>
                                                            @foreach ($payment_modes as $payment_mode)
                                                                <option value="{{$payment_mode->name}}">{{$payment_mode->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Reference:</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="reference" value="" class="form-control input-roundless" placeholder="Reference">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Description:</label>
                                                    <div class="col-lg-9">
                                                        <textarea name="items[0][description]" class="form-control input-roundless banking_item_description" placeholder="Description"></textarea>
                                                    </div>
                                                </div>

                                                @include('banking::tax_form_fields')

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label"> </label>
                                                    <div class="col-lg-9">
                                                        <button type="button" onclick="rg_banking.form_ajax_submit('#banking_expense_refund form', false);" class="btn btn-danger"><i class="icon-check"></i> Save</button>
                                                    </div>
                                                </div>

                                            </fieldset>

                                        </form>

                                    </div>
                                </div>

                                <div id="banking_other_deposit" class="txn_form_panel panel panel-flat no-border no-shadow hidden">

                                    <div class="panel-heading no-padding-top">
                                        <h4 class="panel-title">Other Deposit</h4>
                                        <div class="heading-elements">
                                            <ul class="icons-list">
                                                <li><a class="hide-sidebar-opposite"><i class="icon-cross2 text-muted text-size-large"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="panel-body">

                                        <form action="{{url('banking/transactions')}}" method="post" class="form-horizontal" autocomplete="off">
                                            @csrf
                                            @method('POST')

                                            <input type="hidden" name="submit" value="1" />

                                            <input type="hidden" name="_transaction_id" value="">
                                            <input type="hidden" name="_transaction_status" value="">
                                            <input type="hidden" name="_financial_account_code" value="{{$bank_account->financial_account_code}}">
                                            <input type="hidden" name="bank_account_id" value="{{$bank_account->id}}">
                                            <input type="hidden" name="txn_entree_id" value="0">
                                            <input type="hidden" name="txn_type_id" value="0">
                                            <input type="hidden" name="debit" value="{{$bank_account->financial_account_code}}">
                                            <input type="hidden" name="number" value="NULL">
                                            <input type="hidden" name="base_currency" value="{{$bank_account->currency}}">
                                            <input type="hidden" name="quote_currency" value="{{$bank_account->currency}}">
                                            <input type="hidden" name="exchange_rate" value="1">
                                            <input type="hidden" name="items[0][type]" value="account">
                                            <input type="hidden" name="items[0][quantity]" value="1">

                                            <fieldset class="">

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">From Account:</label>
                                                    <div class="col-lg-9">
                                                        <select name="_credit_type_id" data-placeholder="From Account" class="select-search">
                                                            <option value=""></option>
                                                            @foreach ($accounts as $type => $value)
                                                                <optgroup label="<?php echo $type; ?> Accounts">
                                                                    @foreach ($value as $account)
                                                                        <option value="{{$account->code}}">{{$account->name}}</option>
                                                                    @endforeach
                                                                </optgroup>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Date:</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="date" value="" class="form-control input-roundless daterange-single" placeholder="Choose date" autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Amount:</label>
                                                    <div class="col-lg-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon label-roundless text-semibold">{{$tenant->base_currency}}</span>
                                                            <input type="text" name="items[0][rate]" value="" class="form-control input-roundless banking_item_rate text-semibold" placeholder="0.00">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Received Via:</label>
                                                    <div class="col-lg-9">
                                                        <select name="payment_mode" data-placeholder="Received Via" class="select-search">
                                                            <option value=""></option>
                                                            @foreach ($payment_modes as $payment_mode)
                                                                <option value="{{$payment_mode->name}}">{{$payment_mode->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Reference:</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="reference" value="" class="form-control input-roundless" placeholder="Reference">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Description:</label>
                                                    <div class="col-lg-9">
                                                        <textarea name="items[0][description]" class="form-control input-roundless banking_item_description" placeholder="Description"></textarea>
                                                    </div>
                                                </div>

                                                @include('banking::tax_form_fields')

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label"> </label>
                                                    <div class="col-lg-9">
                                                        <button type="button" onclick="rg_banking.form_ajax_submit('#banking_other_deposit form', false);" class="btn btn-danger"><i class="icon-check"></i> Save</button>
                                                    </div>
                                                </div>

                                            </fieldset>

                                        </form>

                                    </div>
                                </div>

                                <div id="banking_owners_contribution" class="txn_form_panel panel panel-flat no-border no-shadow hidden">

                                    <div class="panel-heading no-padding-top">
                                        <h4 class="panel-title">Owners Contribution</h4>
                                        <div class="heading-elements">
                                            <ul class="icons-list">
                                                <li><a class="hide-sidebar-opposite"><i class="icon-cross2 text-muted text-size-large"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="panel-body">

                                        <form action="{{url('banking/transactions')}}" method="post" class="form-horizontal" autocomplete="off">
                                            @csrf
                                            @method('POST')

                                            <input type="hidden" name="submit" value="1" />

                                            <input type="hidden" name="_transaction_id" value="">
                                            <input type="hidden" name="_transaction_status" value="">
                                            <input type="hidden" name="_financial_account_code" value="{{$bank_account->financial_account_code}}">
                                            <input type="hidden" name="bank_account_id" value="{{$bank_account->id}}">
                                            <input type="hidden" name="txn_entree_id" value="0">
                                            <input type="hidden" name="txn_type_id" value="0">
                                            <input type="hidden" name="debit" value="{{$bank_account->financial_account_code}}">
                                            <input type="hidden" name="number" value="NULL">
                                            <input type="hidden" name="base_currency" value="{{$bank_account->currency}}">
                                            <input type="hidden" name="quote_currency" value="{{$bank_account->currency}}">
                                            <input type="hidden" name="exchange_rate" value="1">
                                            <input type="hidden" name="items[0][type]" value="account">
                                            <input type="hidden" name="items[0][quantity]" value="1">

                                            <fieldset class="">

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">From Account:</label>
                                                    <div class="col-lg-9">
                                                        <select name="_credit_type_id" data-placeholder="Account" class="select-search">
                                                            <option value=""></option>
                                                            <optgroup label="Equity Accounts">
                                                                @foreach ($accounts['equity'] as $account)
                                                                    <option value="{{$account->code}}">{{$account->name}}</option>
                                                                @endforeach
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Date:</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="date" value="" class="form-control input-roundless daterange-single" placeholder="Choose date" autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Amount:</label>
                                                    <div class="col-lg-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon label-roundless text-semibold">{{$tenant->base_currency}}</span>
                                                            <input type="text" name="items[0][rate]" value="" class="form-control input-roundless banking_item_rate text-semibold" placeholder="0.00">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Received Via:</label>
                                                    <div class="col-lg-9">
                                                        <select name="payment_mode" data-placeholder="Received Via" class="select-search">
                                                            <option value=""></option>
                                                            @foreach ($payment_modes as $payment_mode)
                                                                <option value="{{$payment_mode->name}}">{{$payment_mode->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Reference:</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="reference" value="" class="form-control input-roundless" placeholder="Reference">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Description:</label>
                                                    <div class="col-lg-9">
                                                        <textarea name="items[0][description]" class="form-control input-roundless banking_item_description" placeholder="Description"></textarea>
                                                    </div>
                                                </div>

                                                @include('banking::tax_form_fields')

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label"> </label>
                                                    <div class="col-lg-9">
                                                        <button type="button" onclick="rg_banking.form_ajax_submit('#banking_owners_contribution form', false);" class="btn btn-danger"><i class="icon-check"></i> Save</button>
                                                    </div>
                                                </div>

                                            </fieldset>

                                        </form>

                                    </div>
                                </div>

                                <div id="banking_supplier_credit_refund" class="txn_form_panel panel panel-flat no-border no-shadow hidden">

                                    <div class="panel-heading no-padding-top">
                                        <h4 class="panel-title">Supplier Credit Refund</h4>
                                        <div class="heading-elements">
                                            <ul class="icons-list">
                                                <li><a class="hide-sidebar-opposite"><i class="icon-cross2 text-muted text-size-large"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="panel-body">

                                        <form action="{{url('banking/transactions')}}" method="post" class="form-horizontal" autocomplete="off">
                                            @csrf
                                            @method('POST')

                                            <input type="hidden" name="submit" value="1" />

                                            <input type="hidden" name="_transaction_id" value="">
                                            <input type="hidden" name="_transaction_status" value="">
                                            <input type="hidden" name="_financial_account_code" value="{{$bank_account->financial_account_code}}">
                                            <input type="hidden" name="bank_account_id" value="{{$bank_account->id}}">
                                            <input type="hidden" name="txn_entree_id" value="0">
                                            <input type="hidden" name="txn_type_id" value="0">
                                            <input type="hidden" name="debit" value="{{$bank_account->financial_account_code}}">
                                            <input type="hidden" name="credit" value="<?php echo 4; //Payables (Supppliers) ?>">
                                            <input type="hidden" name="number" value="NULL">
                                            <input type="hidden" name="base_currency" value="{{$bank_account->currency}}">
                                            <input type="hidden" name="quote_currency" value="{{$bank_account->currency}}">
                                            <input type="hidden" name="exchange_rate" value="1">
                                            <input type="hidden" name="items[0][type]" value="">
                                            <input type="hidden" name="items[0][type_id]" value="">
                                            <input type="hidden" name="items[0][quantity]" value="1">

                                            <fieldset class="">

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Supplier:</label>
                                                    <div class="col-lg-9">
                                                        <select name="contact_id" data-placeholder="Select Supplier" class="select-search">
                                                            <option value=""></option>
                                                            @foreach ($contacts['supplier'] as $contact)
                                                                <option value="{{$contact->id}}">{{$contact->display_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Date:</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="date" value="" class="form-control input-roundless daterange-single" placeholder="Choose date" autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Amount:</label>
                                                    <div class="col-lg-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon label-roundless text-semibold">{{$tenant->base_currency}}</span>
                                                            <input type="text" name="items[0][rate]" value="" class="form-control input-roundless banking_item_rate text-semibold" placeholder="0.00">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Received Via:</label>
                                                    <div class="col-lg-9">
                                                        <select name="payment_mode" data-placeholder="Received Via" class="select-search">
                                                            <option value=""></option>
                                                            @foreach ($payment_modes as $payment_mode)
                                                                <option value="{{$payment_mode->name}}">{{$payment_mode->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Reference:</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="reference" value="" class="form-control input-roundless" placeholder="Reference">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Description:</label>
                                                    <div class="col-lg-9">
                                                        <textarea name="items[0][description]" class="form-control input-roundless banking_item_description" placeholder="Description"></textarea>
                                                    </div>
                                                </div>

                                                @include('banking::tax_form_fields')

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label"> </label>
                                                    <div class="col-lg-9">
                                                        <button type="button" onclick="rg_banking.form_ajax_submit('#banking_supplier_credit_refund form', false);" class="btn btn-danger"><i class="icon-check"></i> Save</button>
                                                    </div>
                                                </div>

                                            </fieldset>

                                        </form>

                                    </div>
                                </div>

                                <div id="banking_supplier_payment_refund" class="txn_form_panel panel panel-flat no-border no-shadow hidden">

                                    <div class="panel-heading no-padding-top">
                                        <h4 class="panel-title">Supplier Payment Refund</h4>
                                        <div class="heading-elements">
                                            <ul class="icons-list">
                                                <li><a class="hide-sidebar-opposite"><i class="icon-cross2 text-muted text-size-large"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="panel-body">

                                        <form action="{{url('banking/transactions')}}" method="post" class="form-horizontal" autocomplete="off">
                                            @csrf
                                            @method('POST')

                                            <input type="hidden" name="submit" value="1" />

                                            <input type="hidden" name="_transaction_id" value="">
                                            <input type="hidden" name="_transaction_status" value="">
                                            <input type="hidden" name="_financial_account_code" value="{{$bank_account->financial_account_code}}">
                                            <input type="hidden" name="bank_account_id" value="{{$bank_account->id}}">
                                            <input type="hidden" name="txn_entree_id" value="0">
                                            <input type="hidden" name="txn_type_id" value="0">
                                            <input type="hidden" name="debit" value="{{$bank_account->financial_account_code}}">
                                            <input type="hidden" name="credit" value="<?php echo 4; //Payables (Supppliers) ?>">
                                            <input type="hidden" name="number" value="NULL">
                                            <input type="hidden" name="base_currency" value="{{$bank_account->currency}}">
                                            <input type="hidden" name="quote_currency" value="{{$bank_account->currency}}">
                                            <input type="hidden" name="exchange_rate" value="1">
                                            <input type="hidden" name="items[0][type]" value="">
                                            <input type="hidden" name="items[0][type_id]" value="">
                                            <input type="hidden" name="items[0][quantity]" value="1">

                                            <fieldset class="">

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Supplier:</label>
                                                    <div class="col-lg-9">
                                                        <select name="contact_id" data-placeholder="Select Supplier" class="select-search">
                                                            <option value=""></option>
                                                            @foreach ($contacts['supplier'] as $contact)
                                                                <option value="{{$contact->id}}">{{$contact->display_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Date:</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="date" value="" class="form-control input-roundless daterange-single" placeholder="Choose date" autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Amount:</label>
                                                    <div class="col-lg-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon label-roundless text-semibold">{{$tenant->base_currency}}</span>
                                                            <input type="text" name="items[0][rate]" value="" class="form-control input-roundless banking_item_rate text-semibold" placeholder="0.00">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Received Via:</label>
                                                    <div class="col-lg-9">
                                                        <select name="payment_mode" data-placeholder="Received Via" class="select-search">
                                                            <option value=""></option>
                                                            @foreach ($payment_modes as $payment_mode)
                                                                <option value="{{$payment_mode->name}}">{{$payment_mode->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Reference:</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="reference" value="" class="form-control input-roundless" placeholder="Reference">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Description:</label>
                                                    <div class="col-lg-9">
                                                        <textarea name="items[0][description]" class="form-control input-roundless banking_item_description" placeholder="Description"></textarea>
                                                    </div>
                                                </div>

                                                @include('banking::tax_form_fields')

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label"> </label>
                                                    <div class="col-lg-9">
                                                        <button type="button" onclick="rg_banking.form_ajax_submit('#banking_supplier_payment_refund form', false);" class="btn btn-danger"><i class="icon-check"></i> Save</button>
                                                    </div>
                                                </div>

                                            </fieldset>

                                        </form>

                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane " id="bottom-tab2">

                                <div class="panel panel-flat no-border no-shadow">

                                    <div class="panel-heading no-padding-top">
                                        <h4 class="panel-title pull-left mr-20">Possible Matches</h4>
                                        <h4 class="panel-title pull-left ml-20">
                                            <a href="#" class="text-size-small text-semibold" onclick="$('#transaction_match_filter').toggleClass('hidden');"><i class="icon-filter3"></i> FILTER</a>
                                        </h4>
                                        <div class="heading-elements">
                                            <ul class="icons-list no-margin-top">
                                                <li><a class="hide-sidebar-opposite"><i class="icon-cross2 text-muted text-size-large"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                    <div class="panel-body">

                                        <hr class=" no-margin-top">

                                        <div id="transaction_match_filter" class="hidden">

                                            <form action="{{url('banking/transactions')}}" method="post" class="form-horizontal" autocomplete="off">
                                                @csrf
                                                @method('POST')

                                                <input type="hidden" name="submit" value="1" />

                                                <input type="hidden" name="_transaction_id" value="">

                                                <fieldset class="">

                                                    <div class="form-group">
                                                        <label class="col-lg-3 control-label">Amount Range:</label>
                                                        <div class="col-lg-4">
                                                            <input type="text" name="range[amount][from]" value="" class="form-control input-roundless" placeholder="0">
                                                        </div>
                                                        <label class="col-lg-1 control-label">to</label>
                                                        <div class="col-lg-4">
                                                            <input type="text" name="range[amount][to]" value="" class="form-control input-roundless" placeholder="0">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-lg-3 control-label">Date Range:</label>
                                                        <div class="col-lg-4">
                                                            <input type="text" name="range[date][from]" value="" class="form-control input-roundless daterange-single" placeholder="Choose date">
                                                        </div>
                                                        <label class="col-lg-1 control-label">to</label>
                                                        <div class="col-lg-4">
                                                            <input type="text" name="range[date][from]" value="" class="form-control input-roundless daterange-single" placeholder="Choose date">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-lg-3 control-label">Contact:</label>
                                                        <div class="col-lg-9">
                                                            <select name="contact_id" data-placeholder="Select Customer, Supplier, Vendor" class="select-search">
                                                                <option value=""></option>
                                                                <optgroup label="Customers">
                                                                    @foreach ($contacts['supplier'] as $contact)
                                                                        <option value="{{$contact->id}}">{{$contact->display_name}}</option>
                                                                    @endforeach
                                                                </optgroup>
                                                                <optgroup label="Suppliers / Vendors">
                                                                @foreach ($contacts['supplier'] as $contact)
                                                                    <option value="{{$contact->id}}">{{$contact->display_name}}</option>
                                                                @endforeach
                                                                </optgroup>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-lg-3 control-label">Type:</label>
                                                        <div class="col-lg-9">
                                                            <select name="payment_mode" data-placeholder="Transaction Type" class="select-search">
                                                                <option value=""></option>
                                                                <optgroup label="MONEY OUT">
                                                                    <option value="#banking_expense">Expense</option>
                                                                    <option value="#banking_supplier_advance">Supplier Advance</option>
                                                                    <option value="#banking_supplier_payment">Supplier payment</option>
                                                                    <option value="#banking_transfer_to_another_account">Transfer To Another Account</option>
                                                                    <option value="#banking_sales_return">Sales Return</option>
                                                                    <option value="#banking_card_payment">Card Payment</option>
                                                                    <option value="#banking_owner_drawings">Owner Drawings</option>
                                                                    <option value="#banking_credit_note_refund">Credit Note Refund</option>
                                                                    <option value="#banking_payment_refund">Payment Refund</option>
                                                                </optgroup>
                                                                <optgroup label="MONEY IN">
                                                                    <option value="#banking_customer_advance">Customer Advance</option>
                                                                    <option value="#banking_customer_payment">Customer Payment</option>
                                                                    <option value="#banking_retainer_payment">Retainer Payment</option>
                                                                    <option value="#banking_sales_without_invoice">Sales Without Invoices</option>
                                                                    <option value="#banking_transfer_from_another_account">Transfer From Another Account</option>
                                                                    <option value="#banking_interest_income">Interest Income</option>
                                                                    <option value="#banking_other_income">Other Income</option>
                                                                    <option value="#banking_expense_refund">Expense Refund</option>
                                                                    <option value="#banking_other_deposit">Other Deposit</option>
                                                                    <option value="#banking_owners_contribution">Owner's Contribution</option>
                                                                    <option value="#banking_supplier_credit_refund">Supplier Credit Refund</option>
                                                                    <option value="#banking_supplier_payment_refund">Supplier Payment Refund</option>
                                                                </optgroup>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-lg-3 control-label">Reference:</label>
                                                        <div class="col-lg-9">
                                                            <input type="text" name="reference" value="" class="form-control input-roundless" placeholder="Reference">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-lg-3 control-label"> </label>
                                                        <div class="col-lg-9">
                                                            <button type="button" class="btn btn-danger" onclick="rg_banking.form_ajax_submit('#banking_supplier_payment_refund form', false);"><i class="icon-check"></i> Search</button>
                                                            <button type="button" class="btn btn-default"  onclick="$('#transaction_match_filter').addClass('hidden');"><i class="icon-cross2"></i> Cancel</button>
                                                        </div>
                                                    </div>

                                                </fieldset>

                                            </form>

                                            <hr>

                                        </div>


                                        <div class="table-responsive">
                                            <table id="transaction_matches" class="table table-hover">
                                                <thead>
                                                <tr>
                                                    <th>Best Matches</th>
                                                    <th> </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- /opposite sidebar -->
@endsection

@section('javascript')
    <script src="/rutatiina_assets/highcharts-6.0.7/highcharts.js"></script>
    <script src="/rutatiina_assets/highcharts-6.0.7/modules/exporting.js"></script>

    <script type="text/javascript">
        Highcharts.chart('highcharts_container', {
            chart: {
                //type: 'area'
            },
            credits: {
                enabled: false
            },
            title: {
                text: null
            },
            subtitle: {
                text: null
            },
            xAxis: {
                allowDecimals: false,
                type: 'datetime'
            },
            yAxis: {
                title: {
                    text: null
                },
                labels: {
                    formatter: function () {
                        return this.value / 1000 + 'k';
                    }
                }
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.y:,.0f}</b>'
            },
            plotOptions: {
                series: {
                    pointStart: Date.UTC(<?php echo date('Y', $opening_strtotime). ', '.(date('m', $opening_strtotime)-1). ', '.date('d', $opening_strtotime); ?>),
                    pointInterval: 24 * 3600 * 1000 // one day
                },
                area: {
                    pointStart: 1940,
                    marker: {
                        enabled: false,
                        symbol: 'circle',
                        radius: 2,
                        states: {
                            hover: {
                                enabled: true
                            }
                        }
                    }
                }
            },
            series: <?php echo json_encode($graph_data); ?>
        });
        <?php /*{
                name: 'Petty cash',
                data: [0, 0, 5000, 10000, 8000, 2000, 6, 11, 32, 110, 235, 369, 640, 1005, 1436, 2063, 3057, 4618, 6444, 9822, 15468, 20434, 24126, 27387, 29459, 31056, 31982, 32040, 31233, 29224]
            }, {
                name: 'Cash',
                data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 25, 50, 120, 150, 200, 426, 660, 869, 1060, 1605, 2471, 3322, 4238, 5221, 6129, 7089, 8339, 9399, 10538]
            }*/ ?>
    </script>
@endsection
