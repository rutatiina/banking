<div class="navbar navbar-default navbar-fixed-top rg_datatable_onselect_btns animate-class-change" >
    <!--<button type="button" class="btn btn-link rg_datatable_selected_deactivate" data-url="/transaction/reverse/"><i class="icon-alert position-left"></i> Reverse</button>-->
    <button type="button" class="btn btn-link text-danger rg_datatable_selected_delete" data-url="/banking/delete/"><i class="icon-bin position-left"></i> Delete</button>
</div>

<!-- Main content -->
<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header" style="border-bottom: 1px solid #ddd;">
        <div class="page-header-content">
            <div class="page-title clearfix">
                <h1 class="pull-left no-margin text-light">
                    <i class="icon-file-plus position-left"></i> Bank Account(s)
                    <small></small>
                </h1>
                <div class="pull-right">
                    <a href="/banking/account/" type="button" class="btn btn-danger pr-20"><i class="icon-plus22"></i> New Bank Account</a>

                    <?php /*<div class="btn-group ml-5">
                        <button type="button" class="btn btn-default btn-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <i class="icon-menu7"></i> &nbsp;<span class="caret"></span>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-right dropdown-menu-xs" style="min-width: 220px;">
                            <!--<li class="dropdown-header">SORT BY</li>
                            <li><a href="#">Created time</a></li>
                            <li><a href="#">Last modified time</a></li>
                            <li><a href="#">Date</a></li>
                            <li><a href="#">Invoice #</a></li>
                            <li><a href="#">Order Number</a></li>
                            <li><a href="#">Customer Name</a></li>
                            <li><a href="#">Due Date</a></li>
                            <li><a href="#">Amount</a></li>
                            <li><a href="#">Balance Due</a></li>
                            <li class="divider"></li>-->
                            <li><a href="#"><i class="icon-upload4"></i> Import Customer</a></li>
                            <li><a href="#"><i class="icon-upload4"></i> Import Vendors / suppliers</a></li>
                            <li class="divider"></li>
                            <li><a href="#"><i class="icon-download4"></i> Export Customers</a></li>
                            <li><a href="#"><i class="icon-download4"></i> Export Vendors / suppliers</a></li>
                            <li><a href="#"><i class="icon-download4"></i> Export Contacts</a></li>
                        </ul>
                    </div>*/ ?>
                </div>
            </div>
        </div>

    </div>
    <!-- /page header -->

    <!-- Content area -->
    <div class="content">

        <!-- Pagination types -->
        <div class="panel panel-flat no-border no-shadow">

            <!--<div class="panel-body hidden">
                Manage <code>cusotmer</code>, <code>suppliers</code>, <code>salespersons</code>, <code>retailers</code> e.t.c
            </div>-->

            <table class="rg_datatable table datatable-pagination">
                <thead>
                <tr>
                <th class="" width="12"></th>
                    <th width="30">EDIT</th>
                    <th>BANK</th>
                    <th>NAME</th>
                    <th>NUMBER</th>
                    <th>CODE</th>
                    <th>CURRENCY</th>
                    <th class="text-right">BALANCE</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

        </div>
        <!-- /pagination types -->

    </div>
    <!-- /content area -->

</div>
<!-- /main content -->


