<template>

    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Page header -->
        <div class="page-header page-header-light">
            <div class="page-header-content header-elements-md-inline">
                <div class="page-title d-flex">
                    <h4>
                        <i class="icon-library2 mr-2"></i>
                        <span class="font-weight-semibold">Bank Accounts</span>
                    </h4>
                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>

            </div>

            <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                <div class="d-flex">
                    <div class="breadcrumb">
                        <a href="/" class="breadcrumb-item">
                            <i class="icon-home2 mr-2"></i>
                            <span class="badge badge-primary badge-pill font-weight-bold rg-breadcrumb-item-tenant-name"> {{this.$root.tenant.name | truncate(30) }} </span>
                        </a>
                        <span class="breadcrumb-item">Banking</span>
                        <span class="breadcrumb-item active">Accounts</span>
                    </div>

                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>

                <div class="header-elements d-none">
                    <div class="breadcrumb justify-content-center">
                        <router-link to="/banking/accounts/create" class=" btn btn-danger btn-sm font-weight-bold">
                            <i class="icon-library2 mr-1"></i>
                            New Bank Account
                        </router-link>
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
                                <th scope="col" class="font-weight-bold" style="width: 20px;">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox"
                                               v-model="rgTableSelectAll"
                                               class="custom-control-input"
                                               id="row-checkbox-all">
                                        <label class="custom-control-label" for="row-checkbox-all"> </label>
                                    </div>
                                </th>
                                <th scope="col" class="font-weight-bold">Account Name</th>
                                <th scope="col" class="font-weight-bold">Bank</th>
                                <th scope="col" class="font-weight-bold">Uncategorized</th>
                                <th scope="col" class="font-weight-bold text-right">Amount in Bank</th>
                                <th scope="col" class="font-weight-bold text-right">Amount in System</th>
                            </tr>
                        </thead>

                        <rg-tables-state></rg-tables-state>

                        <tbody>
                            <tr v-for="row in tableData.payload.data"
                                @click="onRowClick(row)">
                                <td v-on:click.stop="" class="pr-0">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox"
                                               v-model="tableData.selected"
                                               :value="row.id"
                                               number
                                               class="custom-control-input"
                                               :id="'row-checkbox-'+row.id"
                                               isabled>
                                        <label class="custom-control-label" :for="'row-checkbox-'+row.id"> </label>
                                    </div>
                                </td>
                                <td class="cursor-pointer font-weight-semibold">{{row.name}}</td>
                                <td class="cursor-pointer" nowrap="">{{row.bank.name}}</td>
                                <td class="cursor-pointer"></td>
                                <td class="cursor-pointer text-right">0.00 <small>{{row.currency}}</small></td>
                                <td class="cursor-pointer text-right">{{rgNumberFormat((row.account.balance.debit - row.account.balance.credit), 2)}} <small>{{row.account.balance.currency}}</small></td>
                            </tr>
                        </tbody>
                    </table>

                    <rg-tables-pagination v-bind:table-data-prop="tableData"></rg-tables-pagination>

                </div>

            </div>
            <!-- /basic table -->

        </div>
        <!-- /content area -->


        <!-- Footer -->

        <!-- /footer -->

    </div>
    <!-- /main content -->

</template>

<script>

    export default {
        data() {
            return {}
        },
        watch: {
            '$route.query.page': function (page) {
                this.tableData.url = this.$router.currentRoute.path + '?page='+page;
            }
        },
        mounted() {

            this.tableData.initiate = true

            let currentObj = this;

            if (currentObj.$route.query.page === undefined) {
                currentObj.tableData.url = this.$router.currentRoute.path; //'/crbt/transactions';
            } else {
                currentObj.tableData.url = this.$router.currentRoute.path + '?page='+currentObj.$route.query.page;
            }

        },
        methods: {
            onRowClick(row) {
                this.$router.push({ path: '/banking/accounts/'+row.id })
            }
        },
        ready:function(){},
        beforeUpdate: function () {},
        updated: function () {
            InputsCheckboxesRadios.initComponents();
        }
    }
</script>
