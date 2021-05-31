{{--@extends('accounting::layouts.layout_2.LTR.layout_navbar_sidebar_fixed')--}}
@extends('l-limitless-bs4.layout_2-ltr-default.full')

@section('title', 'Banking :: Transaction rules')

{{--@section('head')--}}
{{--    <script src="{{ mix('/template/limitless/layout_2/LTR/default/assets/mix/banking.js') }}"></script>--}}
{{--@endsection--}}

@section('content')

    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Page header -->
        <div class="page-header page-header-light">
            <div class="page-header-content header-elements-md-inline">
                <div class="page-title d-flex">
                    <h4>
                        <i class="icon-file-plus"></i>
                        Transaction Rules
                    </h4>
                </div>

            </div>

            <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                <div class="d-flex">
                    <div class="breadcrumb">
                        <a href="/" class="breadcrumb-item">
                            <i class="icon-home2 mr-2"></i>
                            <span class="badge badge-primary badge-pill font-weight-bold rg-breadcrumb-item-tenant-name"> [this.$root.tenant.name] </span>
                        </a>
                        <span class="breadcrumb-item">Banking</span>
                        <span class="breadcrumb-item">Account</span>
                        <span class="breadcrumb-item active">Transaction Rules</span>
                    </div>

                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>

                <div class="header-elements">
                    <div class="breadcrumb justify-content-center">
                        <a href="" class=" btn btn-danger btn-sm rounded-round font-weight-bold">
                            <i class="icon-drawer3 mr-2"></i>
                            Transaction Rule(s)
                        </a>
                        <button type="button" class=" btn btn-danger btn-sm rounded-round font-weight-bold" data-toggle="modal" data-target="#modal_new_rule">
                            <i class="icon-drawer3 mr-2"></i>
                            New Rule(s)
                        </button>
                    </div>
                </div>

            </div>

        </div>
        <!-- /page header -->


        <!-- Content area -->
        <div class="content border-0 p-0">

            <loading-animation></loading-animation>

            <!-- Basic table -->
            <div class="card shadow-none rounded-0 border-0">

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr class="table-active">
                            <th scope="col" class="font-weight-bold" style="width: 20px;"></th>
                            <th scope="col" class="font-weight-bold">Rule Name</th>
                            <th scope="col" class="font-weight-bold" nowrap="">Apply To</th>
                            <th scope="col" class="font-weight-bold" nowrap="">Process As</th>
                            <th scope="col" class="font-weight-bold" nowrap="">Criteria</th>
                            <th scope="col" class="font-weight-bold"> </th>
                        </tr>
                        </thead>

                        <tbody></tbody>

                    </table>

                </div>

            </div>
            <!-- /basic table -->

        </div>
        <!-- /content area -->


        <!-- Footer -->

        <!-- /footer -->

    </div>
    <!-- /main content -->























    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Page header -->
        <div class="page-header page-header-light">
            <div class="page-header-content header-elements-md-inline">
                <div class="page-title d-flex">
                    <h4>
                        <i class="icon-file-plus"></i>
                        Transaction Rules
                    </h4>
                </div>

            </div>

            <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                <div class="d-flex">
                    <div class="breadcrumb">
                        <a href="/" class="breadcrumb-item">
                            <i class="icon-home2 mr-2"></i>
                            <span class="badge badge-primary badge-pill font-weight-bold rg-breadcrumb-item-tenant-name"> [this.$root.tenant.name] </span>
                        </a>
                        <span class="breadcrumb-item">Banking</span>
                        <span class="breadcrumb-item">Account</span>
                        <span class="breadcrumb-item active">Transaction Rules</span>
                    </div>

                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>

                <div class="header-elements">
                    <div class="breadcrumb justify-content-center">
                        <a href="" class=" btn btn-danger btn-sm rounded-round font-weight-bold">
                            <i class="icon-drawer3 mr-2"></i>
                            Transaction Rule(s)
                        </a>
                        <button type="button" class=" btn btn-danger btn-sm rounded-round font-weight-bold" data-toggle="modal" data-target="#modal_new_rule">
                            <i class="icon-drawer3 mr-2"></i>
                            New Rule(s)
                        </button>
                    </div>
                </div>

            </div>

        </div>
        <!-- /page header -->

        <!-- Content area -->
        <div class="content">

            <div class="row mt-20">

                <div class="col-12">

                    <div class="card card-flat no-border no-shadow">
                        <div class="card-body no-padding">

                            <table id="rg_datatable_banking_transaction_rules" class="table datatable-pagination" data-ajax="{{url('banking/accounts/'.$bank_account->financial_account_code.'/transaction-rules/datatables')}}">
                                <thead>
                                <tr>
                                    <th class="" width="12"></th>
                                    <th class="text-bold">Rule Name</th>
                                    <th class="text-bold">Apply To</th>
                                    <th class="text-bold">Process As</th>
                                    <th class="text-bold" width="50%">Criteria</th>
                                    <th class="text-bold" width="20px"></th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>

            </div>


            <!-- Primary modal -->
            <div id="modal_new_rule" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h6 class="modal-title">New Rule</h6>
                        </div>

                        <form id="transaction_rule_form" action="{{url('banking/accounts/'.$bank_account->financial_account_code.'/transaction-rules')}}" method="post">
                            @csrf
                            @method('POST')

                            <input type="hidden" name="submit" value="1" />

                            <input type="hidden" name="financial_account_code" value="{{$bank_account->financial_account_code}}">

                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label>Rule name</label>
                                            <input type="text" name="name" placeholder="Rule Name" class="form-control input-roundless">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="mr-20">Apply to: </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="apply_to" value="deposit" checked="checked">
                                        Deposit
                                    </label>

                                    <label class="radio-inline">
                                        <input type="radio" name="apply_to" value="withdraw">
                                        Withdraw
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label class="">Categorize the transaction when</label>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="categorize_when" value="all" checked="checked">
                                            All of the following criteria matches
                                        </label>
                                    </div>

                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="categorize_when" value="any">
                                            Any one of the following criteria matches
                                        </label>
                                    </div>
                                </div>

                                <div id="transaction_rule_criteria_fields" class="form-group transaction_rule_criteria_fields hidden">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <select name="criteria[_][column]" data-placeholder="Column" class="">
                                                <option value=""></option>
                                                <option value="payee">Payee</option>
                                                <option value="description">Description</option>
                                                <option value="reference">Reference</option>
                                                <option value="amount">Amount</option>
                                            </select>
                                        </div>

                                        <div class="col-sm-4">
                                            <select name="criteria[_][condition]" data-placeholder="Condition" class="">
                                                <option value=""></option>
                                                <option value="is">is</option>
                                                <option value="contains">contains</option>
                                                <option value="starts_with">starts with</option>
                                                <option value="is_empty">is empty</option>
                                            </select>
                                        </div>

                                        <div class="col-sm-4">
                                            <input type="text" name="criteria[_][value]" value="" placeholder="Value" class="form-control input-roundless">
                                        </div>
                                    </div>
                                </div>

                                <div id="transaction_rule_criteria_add" class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <a href="{{url()->current()}}#"><i class="icon-plus22"></i> Add another Criteria</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div id="transaction_rule_deposit_process_as_row" class="row">
                                        <div class="col-sm-12">
                                            <label>Process Deposit as</label>
                                            <select id="transaction_rule_deposit_process_as_field" name="process_deposit_as" class="select" data-placeholder="Process Deposit as" data-allow-clear="true">
                                                <option value=""></option>
                                                <option value="sales_without_invoice">Sales Without Invoice</option>
                                                <option value="transfer_from_another_account">Transfer From Another Account</option>
                                                <option value="interest_income">Interest Income</option>
                                                <option value="other_income">Other Income</option>
                                                <option value="expense_refund">Expense Refund</option>
                                                <option value="other_deposit">Other Deposit</option>
                                                <?php /*<option value="journal_entry">Journal Entry</option>*/ ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div id="transaction_rule_withdraw_process_as_row" class="row hidden">
                                        <div class="col-sm-12">
                                            <label>Process Withdraw as</label>
                                            <select id="transaction_rule_withdraw_process_as_field" name="process_withdraw_as" class="select" data-placeholder="Process Withdraw as" data-allow-clear="true">
                                                <option value=""></option>
                                                <option value="expense">Expense</option>
                                                <option value="transfer_to_another_account">Transfer To Another Account</option>
                                                <option value="sales_return">Sales return</option>
                                                <option value="card_payments">Card payments</option>
                                                <option value="owner_drawings">Owner drawings</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Deposit -->
                                <div id="sales_without_invoice_fields" class="_options hidden">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>Account</label>
                                                <select name="options[sales_without_invoice][financial_account_code]" data-placeholder="Account" class="select-search">
                                                    <option value=""></option>
                                                    @foreach ($accounts as $type => $value)
                                                        <optgroup label="{{$type}} Accounts">
                                                            @foreach ($value as $account)
                                                                <option value="{{$account->code}}">{{$account->name}}</option>
                                                            @endforeach
                                                        </optgroup>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>Customer</label>
                                                <select name="options[sales_without_invoice][contact_id]" data-placeholder="Customer" class="select">
                                                    <option value=""></option>
                                                    @foreach ($contacts['customer'] as $contact)
                                                        <option value="{{$contact->id}}">{{$contact->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Tax</label>
                                                <select name="options[sales_without_invoice][tax_id]" data-placeholder="Tax" class="select">
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Received Via</label>
                                                <select name="options[sales_without_invoice][payment_mode]" data-placeholder="Received Via" class="select">
                                                    <option value=""></option>
                                                    @foreach ($payment_modes as $payment_mode)
                                                        <option value="{{$payment_mode->name}}">{{$payment_mode->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end #sales_without_invoices_fields -->

                                <div id="transfer_from_another_account_fields" class="_options hidden">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>Account</label>
                                                <select name="options[transfer_from_another_account][financial_account_code]" data-placeholder="Account" class="select-search">
                                                    <option value=""></option>
                                                    @foreach ($accounts as $type => $value)
                                                        <optgroup label="{{$type}} Accounts">
                                                            @foreach ($value as $account)
                                                                <option value="{{$account->code}}">{{$account->name}}</option>
                                                            @endforeach
                                                        </optgroup>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end #transfer_from_another_account_fields -->

                                <div id="interest_income_fields" class="_options hidden">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>Received Via</label>
                                                <select name="options[interest_income][payment_mode]" data-placeholder="Received Via" class="select">
                                                    <option value=""></option>
                                                    @foreach ($payment_modes as $payment_mode)
                                                        <option value="{{$payment_mode->name}}">{{$payment_mode->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end #interest_income_fields -->

                                <div id="other_income_fields" class="_options hidden">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>Account</label>
                                                <select name="options[other_income][financial_account_code]" data-placeholder="Account" class="select-search">
                                                    <option value=""></option>
                                                    @foreach ($accounts as $type => $value)
                                                        <optgroup label="{{$type}} Accounts">
                                                            @foreach ($value as $account)
                                                                <option value="{{$account->code}}">{{$account->name}}</option>
                                                            @endforeach
                                                        </optgroup>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>Received Via</label>
                                                <select name="options[other_income][payment_mode]" data-placeholder="Received Via" class="select">
                                                    <option value=""></option>
                                                    @foreach ($payment_modes as $payment_mode)
                                                        <option value="{{$payment_mode->name}}">{{$payment_mode->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end #other_income_fields -->

                                <div id="expense_refund_fields" class="_options hidden">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>Account</label>
                                                <select name="options[expense_refund][financial_account_code]" data-placeholder="Account" class="select-search">
                                                    <option value=""></option>
                                                    @foreach ($accounts['expense'] as $account)
                                                        <option value="{{$account->code}}">{{$account->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>Supplier / Vendor</label>
                                                <select name="options[expense_refund][contact_id]" data-placeholder="Supplier / Vendor" class="select">
                                                    <option value=""></option>
                                                    @foreach ($contacts['supplier'] as $contact)
                                                        <option value="{{$contact->id}}">{{$contact->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Tax</label>
                                                <select name="options[expense_refund][tax_id]" data-placeholder="Account" class="select">
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Received Via</label>
                                                <select name="options[expense_refund][payment_mode]" data-placeholder="Received Via" class="select">
                                                    <option value=""></option>
                                                    @foreach ($payment_modes as $payment_mode)
                                                        <option value="{{$payment_mode->name}}">{{$payment_mode->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end #expense_refund_fields -->

                                <div id="other_deposit_fields" class="_options hidden">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>Account</label>
                                                <select name="options[other_deposit][financial_account_code]" data-placeholder="Account" class="select-search">
                                                    <option value=""></option>
                                                    @foreach ($accounts as $type => $value)
                                                        <optgroup label="{{$type}} Accounts">
                                                            @foreach ($value as $account)
                                                                <option value="{{$account->code}}">{{$account->name}}</option>
                                                            @endforeach
                                                        </optgroup>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>Customer</label>
                                                <select name="options[other_deposit][contact_id]" data-placeholder="Customer" class="select">
                                                    <option value=""></option>
                                                    @foreach ($contacts['customer'] as $contact)
                                                        <option value="{{$contact->id}}">{{$contact->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>Received Via</label>
                                                <select name="options[other_deposit][payment_mode]" data-placeholder="Received Via" class="select">
                                                    <option value=""></option>
                                                    @foreach ($payment_modes as $payment_mode)
                                                        <option value="{{$payment_mode->name}}">{{$payment_mode->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end #other_deposit_fields -->

                                <div id="journal_entry_fields" class="_options hidden">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>Account</label>
                                                <select name="options[journal_entry][financial_account_code]" data-placeholder="Account" class="select-search">
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end #journal_entry_fields -->

                                <!-- Withdraw -->
                                <div id="expense_fields" class="_options hidden">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>Account</label>
                                                <select name="options[expense][financial_account_code]" data-placeholder="Account" class="select-search">
                                                    <option value=""></option>
                                                    <optgroup label="Expense Accounts">
                                                    @foreach ($accounts['expense'] as $account)
                                                        <option value="{{$account->code}}">{{$account->name}}</option>
                                                    @endforeach
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>Supplier / Vendor</label>
                                                <select name="options[expense][contact_id]" data-placeholder="Customer" class="select">
                                                    <option value=""></option>
                                                    @foreach ($contacts['supplier'] as $contact)
                                                        <option value="{{$contact->id}}">{{$contact->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>Tax</label>
                                                <select name="options[expense][tax_id]" data-placeholder="Tax" class="select">
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end #expense_fields -->

                                <div id="transfer_to_another_account_fields" class="_options hidden">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>Account</label>
                                                <select name="options[transfer_to_another_account][financial_account_code]" data-placeholder="Account" class="select-search">
                                                    <option value=""></option>
                                                    @foreach ($accounts as $type => $value)
                                                        @continue ($type == 'expense')
                                                        <optgroup label="{{$type}} Accounts">
                                                            @foreach ($value as $account) { ?>
                                                                <option value="{{$account->code}}">{{$account->name}}</option>
                                                            @endforeach
                                                        </optgroup>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end #transfer_to_another_account_fields -->

                                <div id="sales_return_fields" class="_options hidden">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>Account</label>
                                                <select name="options[sales_return][financial_account_code]" data-placeholder="Account" class="select-search">
                                                    <option value=""></option>
                                                    <optgroup label="Income / Revenue Accounts">
                                                    @foreach ($accounts['income'] as $account)
                                                        <option value="{{$account->code}}">{{$account->name}}</option>
                                                    @endforeach
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end #sales_return_fields -->

                                <div id="card_payments_fields" class="_options hidden">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>Account</label>
                                                <select name="options[card_payments][financial_account_code]" data-placeholder="Account" class="select-search">
                                                    <option value=""></option>
                                                    <optgroup label="Expense Accounts">
                                                        @foreach ($accounts['expense'] as $account)
                                                            <option value="{{$account->code}}">{{$account->name}}</option>
                                                        @endforeach
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end #card_payments_fields -->

                                <div id="owner_drawings_fields" class="_options hidden">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>Account</label>
                                                <select name="options[owner_drawings][financial_account_code]" data-placeholder="Account" class="select-search">
                                                    <option value=""></option>
                                                    <optgroup label="Equity Accounts">
                                                        @foreach ($accounts['equity'] as $account)
                                                            <option value="{{$account->code}}">{{$account->name}}</option>
                                                        @endforeach
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end #owner_drawings_fields -->

                            </div>

                            <div class="modal-footer text-left">
                                <button type="button" class="btn btn-danger" onclick="rutatiina.form_ajax_submit('#transaction_rule_form', true);">Save</button>
                                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /primary modal -->


        </div>
        <!-- /content area -->

    </div>
    <!-- /main content -->

    <style>
        @media (min-width: 769px) {
            .modal-dialog {
                margin: 0px auto;
            }
        }
    </style>
@endsection
<script>
    import Button from "../../../../../../../../rutatiina/vue/vue-search-select/src/components/Button";
    export default {
        components: {Button}
    }
</script>