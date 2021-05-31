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


    <style>
        @media (min-width: 769px) {
            .modal-dialog {
                margin: 0px auto;
            }
        }
    </style>
@endsection
