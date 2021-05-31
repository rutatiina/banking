<template>

    <!-- xxx Basic table -->
    <div class="card shadow-none rounded-0 border-0">

        <div class="card-body" v-if="!this.$root.loading && tableData.settingsDisplay">

            <div class="form-group row mb-0">
                <label class="col-lg-1 col-form-label text-right bg-light border rounded-left border-right-0"
                       style="white-space: nowrap;">
                    Search by column:
                </label>
                <div class="col-lg-2 pl-0">
                    <model-select
                        :options="tableData.searchColumnOptions"
                        v-model="tableData.searchColumn"
                        class="rounded-left-0"
                        placeholder="Choose column">
                    </model-select>
                </div>
                <div class="col-lg-6">
                    <input type="text"
                           v-model="tableData.searchValue"
                           class="form-control h-100 input-roundless"
                           placeholder="Search by column">
                </div>

                <label class="col-lg-1 col-form-label text-right bg-light border rounded-left border-right-0"
                       style="white-space: nowrap;">
                    Records per page:
                </label>
                <div class="col-lg-1 pl-0">
                    <model-select
                        :options="tableData.recordsPerPageOptions"
                        v-model="tableData.recordsPerPage"
                        class="rounded-left-0"
                        placeholder="...">
                    </model-select>
                </div>
                <div class="col-lg-1">
                    <button type="button"
                            @click="tableDataUpdate"
                            class="btn btn-danger rounded border-2 border-danger-400 w-100 h-100 pl-2 pr-2">
                        <i class="icon-cog"></i> Search
                    </button>
                </div>
            </div>

        </div>

        <div class="card-body" v-if="!this.$root.loading && tableData.payload.data.length===0">
            <h6>
                <i class="icon-files-empty mr-2"></i>
                No records found
            </h6>
        </div>

        <div class="table-responsive" v-if="!this.$root.loading && tableData.payload.data.length > 0">
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
                    <th scope="col" class="font-weight-bold">Transaction</th>
                    <th scope="col" class="font-weight-bold">Date</th>
                    <th scope="col" class="font-weight-bold" nowrap="">Contact name</th>
                    <th scope="col" class="font-weight-bold" nowrap="">Reference</th>
                    <th scope="col" class="font-weight-bold text-right" nowrap>Debit <small>Money in</small></th>
                    <th scope="col" class="font-weight-bold text-right" nowrap>Credit <small>Money out</small></th>
                </tr>
                </thead>
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
                    <td class="cursor-pointer" nowrap >{{row.date}}</td>
                    <td class="cursor-pointer">{{row.contact_name}}</td>
                    <td class="cursor-pointer">{{row.reference}}</td>
                    <td class="cursor-pointer font-weight-bold text-right" nowrap>
                        <span class="text-slate-800">{{rgNumberFormat(row.debit, 2)}}</span>
                        <small>{{row.currency}}</small>
                    </td>
                    <td class="cursor-pointer font-weight-bold text-right" nowrap>
                        <span class="text-slate-800">{{rgNumberFormat(row.credit, 2)}}</span>
                        <small>{{row.currency}}</small>
                    </td>
                </tr>
                </tbody>
            </table>

            <rg-tables-pagination></rg-tables-pagination>

        </div>

    </div>
    <!-- /basic table -->

</template>

<script>

    export default {
        data() {
            return {
                url: '/banking/accounts/'+this.$route.params.id+'/transactions',
                tab: 'tab-overview',
            }
        },
        watch: {
            '$route.query.page': function (page) {
                this.tableData.url = this.url+'?page='+page;
            }
        },
        mounted() {

            this.tableData.searchColumnOptions = [
                { value: 'date', text: 'Date' },
                { value: 'contact_name', text: 'Contact name' },
                { value: 'reference', text: 'Reference' },
                { value: 'debit', text: 'Debit' },
                { value: 'credit', text: 'Credit' }
            ]

            this.tableData.initiate = true;

            //page height - 230(page header and breadcrump) - 80 (lower space) / 45 (height of each row)
            this.tableRecordsPerPage(230, 80, 45)

            //let currentObj = this;

            if (this.$route.query.page === undefined) {
                this.tableData.url = this.url;
            } else {
                this.tableData.url = this.url+'?page='+this.$route.query.page;
            }

        },
        methods: {
            onRowClick(txn) {
                //console.log(txn)
                //this.$router.push({ path: '/financial-accounts/sales/estimates/'+txn.id })
            }
        },
        updated: function () {
            // console.log('updated')
            InputsCheckboxesRadios.initComponents();

            //Refresh that table
            if (this.$root.rgTableToRefresh === 'bank_account_transactions')
            {
                this.tableDataUpdate();
                this.$root.rgTableToRefresh = null;
            }

        }
    }

</script>
