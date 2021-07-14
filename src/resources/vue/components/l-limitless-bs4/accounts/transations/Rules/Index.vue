<template>

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
                            <span class="badge badge-primary badge-pill font-weight-bold rg-breadcrumb-item-tenant-name"> {{this.$root.tenant.name | truncate(30) }} </span>
                        </a>
                        <span class="breadcrumb-item">Banking</span>
                        <span class="breadcrumb-item">Account</span>
                        <span class="breadcrumb-item active">Transaction Rules</span>
                    </div>

                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>

                <div class="header-elements">
                    <div class="breadcrumb justify-content-center">
                        <router-link to="/banking/accounts/1/transactions/rules/create"
                                     class="btn btn-outline btn-primary border-primary text-primary-800 border-2 btn-sm rounded font-weight-bold mr-2">
                            <i class="icon-files-empty2 mr-2"></i>
                            New Transaction Rule
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

                <!-- search details go here -->

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="">
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
                            <th scope="col" class="font-weight-bold">Rule Name</th>
                            <th scope="col" class="font-weight-bold">Apply To</th>
                            <th scope="col" class="font-weight-bold" nowrap="">Process As</th>
                            <th scope="col" class="font-weight-bold" nowrap="">Criteria</th>
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
                            <td class="cursor-pointer" nowrap >{{$root.humanizeString(row.name)}}</td>
                            <td class="cursor-pointer" nowrap >{{row.apply_to}}</td>
                            <td class="cursor-pointer">{{row.process_as}}</td>
                            <td class="cursor-pointer pt-0 pb-0">
                                <!--{{row.criteria}}-->
                                <div v-for="(criteria, index) in row.criteria" class="input-group input-group-sm">
                                    <span class="input-group-prepend">
                                        <span class="input-group-text rg-input-group-text border-left-3 rounded-0">Column</span>
                                    </span>
                                    <span class="input-group-prepend">
                                        <span class="input-group-text rg-input-group-text bg-white">{{criteria.column}}</span>
                                    </span>
                                    <span class="input-group-prepend ml-2">
                                        <span class="input-group-text rg-input-group-text border-left-3 rounded-0">Condition</span>
                                    </span>
                                    <span class="input-group-prepend">
                                        <span class="input-group-text rg-input-group-text bg-white">{{criteria.condition}}</span>
                                    </span>
                                    <span class="input-group-prepend ml-2">
                                        <span class="input-group-text rg-input-group-text border-left-3 rounded-0">Value</span>
                                    </span>
                                    <span class="input-group-prepend">
                                        <span class="input-group-text rg-input-group-text bg-white">{{criteria.value}}</span>
                                    </span>
                                </div>
                            </td>
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

<style>
    .rg-input-group-text {
        padding: 0px 15px;
        /*font-size: 0.75rem;*/
        line-height: 14px;
        border-radius: 0px;
    }
</style>

<script>

export default {
    //components: {},
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

        this.tableData.searchColumnOptions = [
            { value: 'date', text: 'Date' },
            { value: 'number', text: 'Document No' },
            { value: 'reference', text: 'Reference' },
            { value: 'contact_name', text: 'Contact name' },
            { value: 'status', text: 'Status' },
            { value: 'expiry_date', text: 'Expiry date' },
            { value: 'total', text: 'Total' }
        ]

        this.tableData.initiate = true

        //page height - 230(page header and breadcrump) - 80 (lower space) / 45 (height of each row)
        this.tableRecordsPerPage(230, 80, 45)

        let currentObj = this;

        if (currentObj.$route.query.page === undefined) {
            currentObj.tableData.url = this.$router.currentRoute.path;
        } else {
            currentObj.tableData.url = this.$router.currentRoute.path + '?page='+currentObj.$route.query.page;
        }


    },
    methods: {
        onRowClick(row) {
            //console.log(txn)
            this.$router.push({ path: '/banking/accounts/'+this.$route.params.bank_account_id+'/transactions/rules/'+row.id+'/edit' })
        }
    },
    ready:function(){},
    beforeUpdate: function () {},
    updated: function () {
        // InputsCheckboxesRadios.initComponents();
    }
}
</script>
