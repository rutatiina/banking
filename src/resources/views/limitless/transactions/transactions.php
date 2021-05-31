<!-- Main content -->
<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header" style="border-bottom: 1px solid #ddd;">
        <div class="page-header-content">
            <div class="page-title clearfix">
                <div class="pull-left">
                    <h1 class="text-light">
                        <?php echo $bank_account->name; ?>
                        <?php echo (empty($bank_account->number)) ? '' : '<small>'.$bank_account->number.'</small>'; ?>
                    </h1>
                    <div class="text-size-large">
                        <span class="text-muted">Amount in the system</span>
                        <span class="pl-10 text-semibold account_balance" data-financial_account_code="<?php echo $bank_account->financial_account_code; ?>"><?php echo number_format($bank_account->balance) . ' ' . $bank_account->currency; ?></span>
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
                            <li><a href="#banking_expense">Expense</a></li>
                            <li><a href="#banking_supplier_advance">Supplier Advance</a></li>
                            <li><a href="#banking_supplier_payment">Supplier payment</a></li>
                            <li><a href="#banking_transfer_to_another_account">Transfer To Another Account</a></li>
                            <li><a href="#banking_sales_return">Sales Return</a></li>
                            <li><a href="#banking_card_payment">Card Payment</a></li>
                            <li><a href="#banking_owner_drawings">Owner Drawings</a></li>
                            <li><a href="#banking_credit_note_refund">Credit Note Refund</a></li>
                            <li><a href="#banking_payment_refund">Payment Refund</a></li>

                            <li class="divider"></li>
                            <li class="dropdown-header">MONEY IN</li>

                            <li><a href="#banking_customer_advance">Customer Advance</a></li>
                            <li><a href="#banking_customer_payment">Customer Payment</a></li>
                            <li><a href="#banking_retainer_payment">Retainer Payment</a></li>
                            <li><a href="#banking_sales_without_invoice">Sales Without Invoices</a></li>
                            <li><a href="#banking_transfer_from_another_account">Transfer From Another Account</a></li>
                            <li><a href="#banking_interest_income">Interest Income</a></li>
                            <li><a href="#banking_other_income">Other Income</a></li>
                            <li><a href="#banking_expense_refund">Expense Refund</a></li>
                            <li><a href="#banking_other_deposit">Other Deposit</a></li>
                            <li><a href="#banking_owners_contribution">Owner's Contribution</a></li>
                            <li><a href="#banking_supplier_credit_refund">Supplier Credit Refund</a></li>
                            <li><a href="#banking_supplier_payment_refund">Supplier Payment Refund</a></li>

                        </ul>
                    </div>

                    <?php if (@$bank_account->type != 'account') { ?>
                    <button type="button" class="btn btn-danger" class="" data-href="/banking/transactions/<?php echo $bank_account->financial_account_code; ?>/file/"> Import statement </button>
                    <?php } ?>

                    <div class="btn-group ml-5">
                        <button type="button" class="btn btn-default btn-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <i class="icon-cog4"></i> &nbsp;<span class="caret"></span>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-right dropdown-menu-xs no-border-radius" style="min-width: 220px;">
                            <li><a href="/banking/account/<?php echo $bank_account->id; ?>">Edit Bank Account</a></li>
                            <?php /*<li><a href="#">Automatic Import</a></li>*/ ?>
                            <li><a href="/banking/transactions/<?php echo $bank_account->financial_account_code; ?>/rules">Manage Transaction Rules</a></li>
                            <?php /*<li><a href="#">Reconciliation History</a></li>*/ ?>
                            <li class="divider"></li>
                            <li><a href="#">Undo Last Import</a></li>
                            <li><a href="/banking/account/<?php echo $bank_account->id; ?>/inactive/" class="rg_ajax_call">Mark as Inactive</a></li>
                            <li><a href="/banking/account/<?php echo $bank_account->id; ?>/delete/" class="rg_ajax_call">Delete Bank Account</a></li>
                        </ul>

                    </div>

                </div>
                
            </div>
        </div>

    </div>
    <!-- /page header -->

    <!-- Content area -->
    <div class="content no-padding">

        <?php echo Template::message(); ?>

        <div class="panel panel-flat no-shadow no-border-radius no-border">

            <div class="panel-body no-padding">
                <div class="tabbable">

                    <ul id="transactions_nav_exclude" class="nav nav-tabs nav-tabs-solid p-10 hidden">
                        <li class="">
                            <button id="transactions_btn_exclude" type="button" class="btn btn-default text-semibold ml-10" data-url="/banking/transactions/<?php echo $bank_account->financial_account_code; ?>/row/update/">Exclude</button>
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

                        <?php if ($is_bank_account === false) { ?>
                        <li class="">
                            <a class="dropdown-title banking_txn_sorting pull-left" href="#icon-only-tab2" data-toggle="tab" data-ajax="/datatable/transactions/account/<?php echo $bank_account->financial_account_code; ?>/">All Transactions</a>

                        </li>
                        <?php } ?>

                        <?php if ($is_bank_account === true) { ?>
                        <li class="dropdown border-left ml-5" style="border-color: #eee; white-space: nowrap !important;">

                            <a class="dropdown-title banking_txn_sorting pull-left border-right border-grey-300 pr-5" href="#icon-only-tab2" data-toggle="tab" data-ajax="/banking/transactions/<?php echo $bank_account->financial_account_code; ?>/rows/uncategorized/">
                                <span class="text-danger text-bold"><?php echo @$uncategorized_transactions_count->rows; ?></span>
                                Uncategorized Transactions
                            </a>
                            <a href="#"  class="dropdown-toggle pull-left no-padding-left no-padding-left" data-toggle="dropdown">
                                <!--<span class="visible-xs-inline-block position-right">Dropdown</span>-->
                                <span class="caret pl-5"></span>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-xs dropdown-menu-right">
                                <li>
                                    <a class="banking_txn_sorting" href="#icon-only-tab2" data-toggle="tab" data-ajax="/banking/transactions/<?php echo $bank_account->financial_account_code; ?>/rows/uncategorized/">
                                        <span class="text-danger text-bold"><?php echo @$uncategorized_transactions_count->rows; ?></span>
                                        Uncategorized Transactions
                                    </a>
                                </li>
                                <li><a class="banking_txn_sorting" href="#icon-only-tab2" data-toggle="tab" data-ajax="/banking/transactions/<?php echo $bank_account->financial_account_code; ?>/rows/recognized/">Recognized Transactions</a></li>
                                <li><a class="banking_txn_sorting" href="#icon-only-tab2" data-toggle="tab" data-ajax="/banking/transactions/<?php echo $bank_account->financial_account_code; ?>/rows/excluded/">Excluded Transactions</a></li>
                            </ul>
                        </li>

                        <li class="dropdown border-left ml-5" style="border-color: #eee;">
                            <a class="dropdown-title banking_txn_sorting pull-left pr-5" href="#icon-only-tab2" data-toggle="tab" data-ajax="/datatable/transactions/account/<?php echo $bank_account->financial_account_code; ?>/">All Transactions</a><?php /* /banking/transactions/<?php echo $bank_account->financial_account_code; ?>/rows/all/ */ ?>
                            <a href="#" class="dropdown-toggle pull-left no-padding-left" data-toggle="dropdown">
                                <!--<span class="visible-xs-inline-block position-right">Dropdown</span>-->
                                <span class="caret pl-5"></span>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-xs dropdown-menu-right">
                                <li><a class="banking_txn_sorting" href="#icon-only-tab2" data-toggle="tab" data-ajax="/datatable/transactions/account/<?php echo $bank_account->financial_account_code; ?>/">All Transactions</a></li>
                                <li><a class="banking_txn_sorting" href="#icon-only-tab2" data-toggle="tab" data-ajax="/banking/transactions/<?php echo $bank_account->financial_account_code; ?>/rows/matched/">Matched Transactions</a></li>
                                <li><a class="banking_txn_sorting" href="#icon-only-tab2" data-toggle="tab" data-ajax="/banking/transactions/<?php echo $bank_account->financial_account_code; ?>/rows/manually_added/">Manually added Transactions</a></li>
                                <li><a class="banking_txn_sorting" href="#icon-only-tab2" data-toggle="tab" data-ajax="/banking/transactions/<?php echo $bank_account->financial_account_code; ?>/rows/categorized/">Categorized Transactions</a></li>
                                <li><a class="banking_txn_sorting" href="#icon-only-tab2" data-toggle="tab" data-ajax="/banking/transactions/<?php echo $bank_account->financial_account_code; ?>/rows/reconciled/">Reconciled Transactions</a></li>
                            </ul>
                        </li>
                        <?php } ?>

                    </ul>

                    <div class="tab-content">

                        <div class="tab-pane p-10 active" id="icon-only-tab1">

                            <div class="">

                                <?php if (!empty($uncategorized_transactions_count->rows)) { ?>
                                <div class="panel panel-default no-shadow no-border-radius">
                                    <div class="panel-heading">
                                        <span class="text-danger text-bold"><?php echo @$uncategorized_transactions_count->rows; ?></span> Uncategorized Transactions
                                        <a href="#" class="ml-20">Categorize now</a>
                                    </div>
                                </div>
                                <?php } ?>

                                <div class="panel panel-flat no-shadow no-border-radius no-border">
                                    <div class="panel-heading">
                                        <h6 class="panel-title">
                                            <?php
                                                echo $banking_account->name;
                                                if (!empty($banking_account->number)) {
                                                    echo ' (' . $banking_account->number . ')';
                                                }
                                            ?>
                                        </h6>
                                        <div class="heading-elements">
                                            <ul class="list-inline text-size-small pt-10">
                                                <li><span class="text-size-small">For Last 30 days</span></li>
                                                <?php /*<li>|</li>
                                        <li><a href="#" class="text-size-small">For Last 12 months</a></li>*/ ?>
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

                            <table class="rg_datatable_transactions table datatable-pagination table-hover" data-ajax="/datatable/empty/"><?php ///banking/transactions/' . $bank_account->financial_account_code . '/imported_rows/ ?>
                                <thead>
                                <tr>
                                    <th class="hide_sort_icon" width="12"></th>
                                    <th width="130" class="text-semibold">DATE</th>
                                    <th class="text-semibold">DETAILS</th>
                                    <?php /*<th class="text-semibold" width="180">STATUS</th>*/ ?>
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

    <?php Template::block('transaction_forms'); ?>

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

<script src="/assets/highcharts-6.0.7/highcharts.js"></script>
<script src="/assets/highcharts-6.0.7/modules/exporting.js"></script>

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

