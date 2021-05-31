@extends('accounting::layouts.layout_2.LTR.layout_navbar_sidebar_fixed')

@section('title', 'Banking :: Dashboard')

@section('head')
    {{--<script src="{{ mix('/template/limitless/layout_2/LTR/default/assets/mix/txn.js') }}"></script>--}}
@endsection

@section('content')
    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Page header -->
        <div class="page-header" style="border-bottom: 1px solid #ddd;">
            <div class="page-header-content">
                <div class="page-title clearfix">
                    <h1 class="pull-left no-margin text-light">
                        <i class="icon-file-plus position-left"></i> Banking overview
                        <?php /*<small></small>*/ ?>
                    </h1>
                    <div class="pull-right">
                        <a href="{{url('banking/accounts/create')}}" type="button" class="btn btn-danger pr-20"><i class="icon-plus22"></i> New Bank Account</a>
                    </div>
                </div>
            </div>

        </div>
        <!-- /page header -->



        <!-- Content area -->
        <div class="content">


            <!-- Main charts -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="row">

                        <div class="panel panel-default no-border no-shadow no-border-radius mt-20">

                            <div class="chart-container">
                                <div class="chart has-fixed-height" id="highcharts_container"></div>
                            </div>

                        </div>

                        <div class="clearfix"></div>

                    </div>
                </div>

            </div>
            <!-- /main charts -->


            <div class="row col-md-12 col-lg-8 col-lg-push-2">
                <div class="col-xs-12">

                    <!-- Pagination types -->
                    <div class="panel panel-flat no-shadow no-border-radius ">

                        <table class="table table-xlg">
                            <thead class="text-size-small">
                            <tr>
                                <th class="pt-10 pb-10 text-left text-bold">Account Name</th>
                                <th class="pt-10 pb-10 text-left text-bold">Bank</th>
                                <th class="pt-10 pb-10 text-right text-bold">Uncategorized</th>
                                <th class="pt-10 pb-10 text-right text-bold">Amount in Bank</th>
                                <th class="pt-10 pb-10 text-right text-bold">Amount in System</th>
                                <th class="pt-10 pb-10 text-right text-bold text-muted " width="60"><i class="icon-menu5"></i></th>
                            </tr>
                            </thead>
                            <tbody class="text-size-large">
                            <tr>
                                <td><a href="{{url('banking/accounts/67/overview')}}">Petty cash</a></td>
                                <td class="text-right"> </td>
                                <td class="text-right"> </td>
                                <td class="text-right"> </td>
                                <td class="text-right"><?php echo number_format($accounts[67]['balances'][date('Y-m-d')]) . ' ' . $accounts[67]['currency']; ?></td>
                                <td class="">
                                    <?php /*
                                    <ul class="icons-list">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu5"></i></a>

                                            <ul class="dropdown-menu dropdown-menu-solid no-border-radius">
                                                <li><a href="#"><i class="icon-pencil7"></i>Edit entry</a></li>
                                                <li><a href="#"><i class="icon-bin"></i>Remove entry</a></li>
                                                <li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                    */ ?>
                                </td>
                            </tr>
                            <tr>
                                <td><a href="{{url('banking/accounts/3/overview')}}">Cash</a></td>
                                <td class="text-right"> </td>
                                <td class="text-right"> </td>
                                <td class="text-right"> </td>
                                <td class="text-right"><?php echo number_format($accounts[3]['balances'][date('Y-m-d')]) . ' ' . $accounts[3]['currency']; ?></td>
                                <td class="">
                                    <?php /*
                                    <ul class="icons-list">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu5"></i></a>

                                            <ul class="dropdown-menu dropdown-menu-solid no-border-radius">
                                                <li><a href="#"><i class="icon-pencil7"></i>Edit entry</a></li>
                                                <li><a href="#"><i class="icon-bin"></i>Remove entry</a></li>
                                                <li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                    */ ?>
                                </td>
                            </tr>
                            <?php foreach ($bank_accounts as $bank_account) { ?>
                                <tr>
                                    <td><a href="{{url('banking/accounts/'.$bank_account->financial_account_code.'/overview')}}">{{$bank_account->name}}</a></td>
                                    <td class="">{{$bank_account->bank->name}}</td>
                                    <td class="text-right"><a href="#">-</a></td>
                                    <td class="text-right"><a href="#">- {{$bank_account->currency}}</a></td>
                                    <td class="text-right">{{number_format($accounts[$bank_account->financial_account_code]['balances'][date('Y-m-d')]) . ' ' . $bank_account->currency}}</td>
                                    <td class="">
                                        <ul class="icons-list">
                                            <li class="dropdown">
                                                <a href="{{url('banking/accounts/'.$bank_account->id.'/edit')}}"><i class="icon-pencil7"></i></a>

                                                <?php /*
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu5"></i></a>
                                                <ul class="dropdown-menu dropdown-menu-solid no-border-radius">
                                                    <li><a href="#"><i class="icon-pencil7"></i>Edit entry</a></li>
                                                    <li><a href="#"><i class="icon-bin"></i>Remove entry</a></li>
                                                    <li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
                                                </ul>
                                                */ ?>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>

                    </div>
                    <!-- /pagination types -->

                </div>
            </div>


        </div>
        <!-- /content area -->

    </div>
    <!-- /main content -->

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
                text: 'Transactions on All Accounts (For Last 30 days)'
            },
            subtitle: {
                text: null
            },
            xAxis: {
                allowDecimals: false,
                type: 'datetime',

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
