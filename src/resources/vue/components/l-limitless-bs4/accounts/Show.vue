<template>

    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Page header -->
        <div class="page-header page-header-light d-print-none">
            <div class="page-header-content header-elements-md-inline">
                <div class="page-title d-flex">
                    <h4><i class="icon-files-empty2 mr-2"></i> <span class="font-weight-semibold">Bank Account</span></h4>
                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>

            </div>

            <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                <div class="d-flex">
                    <div class="breadcrumb">
                        <a href="/" class="breadcrumb-item">
                            <i class="icon-home2 mr-2"></i>
                            <span class="badge badge-primary badge-pill font-weight-bold rg-breadcrumb-item-tenant-name"> {{$root.tenant.name | truncate(30) }} </span>
                        </a>
                        <span class="breadcrumb-item">Banking</span>
                        <span class="breadcrumb-item active">Account</span>
                    </div>

                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>

                <div class="header-elements d-none">

                    <div class="btn-group">
                        <button type="button" class="btn bg-danger btn-sm btn-labeled btn-labeled-left dropdown-toggle font-weight-bold mr-1" data-toggle="dropdown">
                            <b><i class="icon-plus22"></i></b> Add transactions
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" style="max-height: 400px; overflow-x: hidden;">
                            <div class="dropdown-header">MONEY OUT</div>
                            <router-link class="dropdown-item" to="#expense">Expense</router-link>
                            <router-link class="dropdown-item" to="#supplier-advance">Supplier Advance</router-link>
                            <router-link class="dropdown-item" to="#supplier-payment">Supplier payment</router-link>
                            <router-link class="dropdown-item" to="#transfer-out">Transfer To Another Account</router-link>
                            <router-link class="dropdown-item" to="#sales-return">Sales Return</router-link>
                            <router-link class="dropdown-item" to="#card-payment">Card Payment</router-link>
                            <router-link class="dropdown-item" to="#owner-drawings">Owner Drawings</router-link>
                            <router-link class="dropdown-item" to="#credit-note-refund">Credit Note Refund</router-link>
                            <router-link class="dropdown-item" to="#payment-refund">Payment Refund</router-link>

                            <div class="dropdown-divider"></div>
                            <div class="dropdown-header">MONEY IN</div>

                            <router-link class="dropdown-item" to="#customer-advance">Customer Advance</router-link>
                            <router-link class="dropdown-item" to="#customer-payment">Customer Payment</router-link>
                            <router-link class="dropdown-item" to="#retainer-payment">Retainer Payment</router-link>
                            <router-link class="dropdown-item" to="#sales-without-invoice">Sales Without Invoices</router-link>
                            <router-link class="dropdown-item" to="#transfer-in">Transfer From Another Account</router-link>
                            <router-link class="dropdown-item" to="#interest-income">Interest Income</router-link>
                            <router-link class="dropdown-item" to="#other-income">Other Income</router-link>
                            <router-link class="dropdown-item" to="#expense-refund">Expense Refund</router-link>
                            <router-link class="dropdown-item" to="#other-deposit">Other Deposit</router-link>
                            <router-link class="dropdown-item" to="#owners-contribution">Owner's Contribution</router-link>
                            <router-link class="dropdown-item" to="#supplier-credit-refund">Supplier Credit Refund</router-link>
                            <router-link class="dropdown-item" to="#supplier-payment-refund">Supplier Payment Refund</router-link>

                        </div>
                    </div>

                    <div class="breadcrumb justify-content-center">
                        <router-link :to="'/banking/accounts/'+$route.params.id+'/transactions/upload'" class=" btn btn-danger btn-sm font-weight-bold">
                            <i class="icon-cloud-upload mr-1"></i>
                            Upload statement
                        </router-link>
                    </div>

                    <div class="btn-group ml-1">
                        <button type="button" class="btn btn-sm btn-outline bg-purple-300 border-purple-300 text-purple-800 btn-icon border-2 dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-cog4"></i>
                        </button>

                        <div class="dropdown-menu dropdown-menu-right">

                            <a class="dropdown-item" :href="'/banking/accounts/'+$route.params.id+'/edit'">Edit Bank Account</a>
                            <!--<a href="#">Automatic Import</a>-->
                            <a class="dropdown-item" :href="'/banking/accounts/'+$route.params.id+'/transactions/rules'">Manage Transaction Rules</a>
                            <!--<a href="#">Reconciliation History</a>-->
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Undo Last Import</a>
                            <a class="dropdown-item" :href="'/banking/accounts/'+$route.params.id+'/inactive'">Mark as Inactive</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="#" @click="confirmBankAccountDelete">Delete Bank Account</a>

                        </div>
                    </div>

                </div>

            </div>
        </div>
        <!-- /page header -->


        <!-- Content area -->
        <div class="content border-0 p-0">

            <loading-animation></loading-animation>

            <div class="card border-0 shadow-0 m-0">

                <div class="card-body p-0">
                    <ul class="nav nav-tabs nav-tabs-bottom font-weight-bold mb-0">
                        <li class="nav-item">
                            <a href="#" @click="tab = 'tab-overview'"
                               :class="'nav-link ' + [tab === 'tab-overview' ? 'active' : '']" data-toggle="tab">Overview</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#"
                               @click.prevent="tab = 'tab-transactions'"
                               :class="'nav-link dropdown-toggle ' + [tab === 'tab-transactions' ? 'active' : '']"
                               data-toggle="dropdown">
                                All transactions
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="#" @click.prevent class="dropdown-item">All transactions</a>
                                <a href="#" @click.prevent class="dropdown-item">Matched transactions</a>
                                <a href="#" @click.prevent class="dropdown-item">Manually added transactions</a>
                                <a href="#" @click.prevent class="dropdown-item">Categorized transactions</a>
                                <a href="#" @click.prevent class="dropdown-item">Reconciled transactions</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#"
                               @click.prevent="tab = 'tab-import-que'"
                               :class="'nav-link dropdown-toggle ' + [tab === 'tab-import-que' ? 'active' : '']"
                               data-toggle="dropdown">
                                Import Que
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="#" @click.prevent class="dropdown-item">All Que transactions</a>
                                <a href="#" @click.prevent class="dropdown-item">Un-categorized transactions</a>
                                <a href="#" @click.prevent class="dropdown-item">Recognized added transactions</a>
                                <a href="#" @click.prevent class="dropdown-item">Excluded transactions</a>
                            </div>
                        </li>

                    </ul>

                    <div class="tab-content">
                        <div v-if="tab === 'tab-overview'" :class="'tab-pane fade ' + [tab === 'tab-overview' ? 'show active' : '']">
                            <overview></overview>
                        </div>

                        <div v-if="tab === 'tab-transactions'" :class="'tab-pane fade ' + [tab === 'tab-transactions' ? 'show active' : '']">
                            <transactions></transactions>
                        </div>

                        <div v-if="tab === 'tab-import-que'" :class="'tab-pane fade ' + [tab === 'tab-import-que' ? 'show active' : '']">
                            <import-que></import-que>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <!-- Footer -->

        <!-- /footer -->

    </div>
    <!-- /main content -->

</template>
<style>
.ui-pnotify-action-bar {
    text-align: left !important;
}
</style>

<script>

    import Overview from './Overview'
    import ImportQue from './transations/ImportQue'
    import Transactions from './transations/Transactions'

    export default {
        components: {
            Overview,
            ImportQue,
            Transactions
        },
        data() {
            return {
                // url: '/financial-accounts/transactions/sort-by-bank-account/'+this.$route.params.id,
                tab: 'tab-overview',
            }
        },
        mounted() {},
        methods: {
            confirmBankAccountDelete(e)
            {
                e.preventDefault();
                let currentObj = this;

                // Setup
                let notice = new PNotify({
                    title: '<b>Confirmation</b>',
                    text: '<p>Are you sure you want to delete this Bank Account changes?</p>',
                    hide: false,
                    type: 'warning',
                    addclass: 'border-danger',
                    confirm: {
                        confirm: true,
                        buttons: [
                            {
                                text: 'Yes, delete bank account',
                                addClass: 'btn btn-sm btn-danger font-weight-bold'
                            },
                            {
                                addClass: 'btn btn-sm btn-link font-weight-bold'
                            }
                        ]
                    },
                    buttons: {
                        closer: false,
                        sticker: false
                    }
                })

                // On confirm
                notice.get().on('pnotify.confirm', function() {

                    let PNotifySettings = currentObj.$root.PNotifySettings;

                    let _notice = new PNotify(PNotifySettings);

                    let data = {
                        _method: 'DELETE',
                        id: currentObj.$route.params.id
                    };

                    axios.post('/banking/accounts/'+currentObj.$route.params.id, data)
                        .then(function (response) {

                            //PNotify.removeAll();

                            PNotifySettings.text = response.data.messages.join("\n");

                            if(response.data.status === true)
                            {
                                PNotifySettings.title = 'Success';
                                PNotifySettings.type = 'success';
                                PNotifySettings.addclass = 'bg-success-400 border-success-400';

                                currentObj.attributes = {
                                    name: '',
                                    code: '',
                                    country: '',
                                };

                                if (response.data.callback) currentObj.$router.push({ path: response.data.callback });
                            }
                            else
                            {
                                PNotifySettings.title = '! Error';
                                PNotifySettings.type = 'error';
                                PNotifySettings.addclass = 'bg-warning-400 border-warning-400';
                            }

                            //let _notice = new PNotify(PNotifySettings);
                            _notice.update(PNotifySettings);

                            _notice.get().click(function() {
                                _notice.remove();
                            });

                            //currentObj.response = response.data;
                        })
                        .catch(function (error) {
                            currentObj.response = error;
                        });

                });

                // On cancel
                notice.get().on('pnotify.cancel', function() {
                    // alert('Oh ok. Chicken, I see.');
                });
            }
        }
    }

</script>
