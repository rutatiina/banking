<template>

    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Page header -->
        <div class="page-header page-header-light">
            <div class="page-header-content header-elements-md-inline">
                <div class="page-title d-flex">
                    <h4>
                        <i class="icon-library2 mr-2"></i>
                        <span class="font-weight-semibold">Banks</span>
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
                        <span class="breadcrumb-item active">Banks</span>
                    </div>

                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>

                <div class="header-elements d-none">
                    <div class="breadcrumb justify-content-center">
                        <router-link to="/banking/banks/create" class=" btn btn-danger btn-sm rounded-round font-weight-bold">
                            <i class="icon-library2 mr-1"></i>
                            New Bank
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

                <div class="card-body" v-if="!this.$root.loading && tableData.payload.data.length==0">

                    <h6>
                        <i class="icon-files-empty mr-2"></i>
                        No records found
                    </h6>

                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <tbody>
                        <tr class="table-active">
                            <th scope="col" class="font-weight-bold">Name</th>
                            <th scope="col" class="font-weight-bold">Country</th>
                            <th scope="col" class="font-weight-bold">Login URL</th>
                        </tr>

                        <tr v-for="row in tableData.payload.data"
                            @click="onRowClick(row)">
                            <td class="cursor-pointer font-weight-semibold">{{row.name}}</td>
                            <td class="cursor-pointer">{{row.country}}</td>
                            <td class="cursor-pointer" nowrap="">{{row.login_url}}</td>
                        </tr>
                        </tbody>
                    </table>

                    <rg-tables-pagination></rg-tables-pagination>

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
            this.$root.appMenu('accounting')

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
                return false
                //this.$router.push({ path: '/banking/banks/'+row.id })
            }
        },
        ready:function(){},
        beforeUpdate: function () {},
        updated: function () {
            InputsCheckboxesRadios.initComponents();
        }
    }
</script>
