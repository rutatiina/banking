<template>

    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Page header -->
        <div class="page-header page-header-light">
            <div class="page-header-content header-elements-md-inline">
                <div class="page-title d-flex">
                    <h4>
                        <i class="icon-library2 mr-2"></i>
                        <span class="font-weight-semibold">{{pageTitle}}</span>
                    </h4>

                </div>

            </div>

            <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                <div class="d-flex">
                    <div class="d-flex">
                        <div class="breadcrumb">
                            <a href="/" class="breadcrumb-item">
                                <i class="icon-home2 mr-2"></i>
                                <span class="badge badge-primary badge-pill font-weight-bold rg-breadcrumb-item-tenant-name"> {{this.$root.tenant.name | truncate(30) }} </span>
                            </a>
                            <span class="breadcrumb-item">Banking</span>
                            <span class="breadcrumb-item">Accounts</span>
                            <span class="breadcrumb-item active">Create</span>
                        </div>

                        <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                    </div>

                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>

                <div class="header-elements">
                    <div class="breadcrumb justify-content-center">
                        <router-link :to="'/banking/accounts/'+$route.params.bank_account_id+'/transactions/rules'" class="btn btn-outline btn-primary border-primary text-primary-800 border-2 btn-sm rounded font-weight-bold mr-2">
                            <i class="icon-filter3 mr-1"></i>
                            Bank Accounts transaction rules
                        </router-link>
                    </div>
                </div>

            </div>

        </div>
        <!-- /page header -->

        <!-- Content area -->
        <div class="content border-0 padding-0">

            <!-- Form horizontal -->
            <div class="card shadow-none rounded-0 border-0">

                <div class="card-body p-0">

                    <loading-animation></loading-animation>

                    <form v-if="!this.$root.loading"
                          @submit="formSubmit"
                          action=""
                          method="post"
                          class="max-width-820"
                          style="margin-bottom: 100px;"
                          autocomplete="off">


                        <fieldset class="">

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">Rule name</label>
                                <div class="col-lg-10">
                                    <input type="text" v-model="attributes.name" placeholder="Rule Name" class="form-control rounded-0">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">Apply to: </label>
                                <div class="col-lg-10">

                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" v-model="attributes.apply_to" value="deposit" id="apply-to-deposit" checked>
                                        <label class="custom-control-label" for="apply-to-deposit">Deposit</label>
                                    </div>

                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" v-model="attributes.apply_to" value="withdraw" id="apply-to-withdraw">
                                        <label class="custom-control-label" for="apply-to-withdraw">Withdraw</label>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label" title="Categorize the transaction when">Categorize when:</label>
                                <div class="col-lg-10">

                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" v-model="attributes.categorize_when" value="all" id="categorize-when-all" checked>
                                        <label class="custom-control-label" for="categorize-when-all">All of the following criteria matches</label>
                                    </div>

                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" v-model="attributes.categorize_when" value="any" id="categorize-when-any">
                                        <label class="custom-control-label" for="categorize-when-any">Any one of the following criteria matches</label>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"> </label>
                                <div class="col-lg-10">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Column</th>
                                            <th>Condition</th>
                                            <th>Value</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="(criteria, index) in attributes.criteria">
                                            <td class="p-0">
                                                <model-select :options="criteriaColumn"
                                                              v-model="criteria.column"
                                                              placeholder="Column"
                                                              class="border-0">
                                                </model-select>
                                            </td>
                                            <td class="p-0">
                                                <model-select :options="criteriaCondition"
                                                              v-model="criteria.condition"
                                                              placeholder="Condition"
                                                              class="border-0">
                                                </model-select>
                                            </td>
                                            <td class="p-0">
                                                <input type="text" v-model="criteria.value" placeholder="Value" class="form-control input-roundless border-0">
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label"> </label>
                                <div class="col-sm-10">
                                    <button type="button"
                                            class="btn btn-primary font-weight-bold rounded-0 col-auto"
                                            @click="addCriteria">
                                        <i class="icon-googleplus5 mr-2"></i>
                                        Click here to add another Criteria
                                    </button>
                                </div>
                            </div>


                            <div class="form-group">
                                <div id="transaction_rule_deposit_process_as_row" class="row">
                                    <label class="col-lg-2 col-form-label">Process as</label>
                                    <div class="col-lg-10">
                                        <model-select :options="processAs"
                                                       v-model="attributes.process_as"
                                                       placeholder="Process as" class="rounded-0">
                                        </model-select>
                                    </div>
                                </div>
                            </div>

                            <!-- Deposit -->
                            <div v-if="attributes.process_as === 'sales_without_invoice'" class="">
                                <div class="form-group  row">
                                    <label class="col-lg-2 col-form-label">Account</label>
                                    <div class="col-lg-10">
                                        <model-list-select :list="financialAccountsByType.income"
                                                           v-model="attributes.options.financial_account_code"
                                                           option-value="id"
                                                           option-text="name"
                                                           placeholder="Select financial Account"
                                                           class="rounded-0">
                                        </model-list-select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Customer</label>
                                    <div class="col-lg-10">
                                        <model-list-select :list="contactsByType.customers"
                                                           v-model="attributes.options.contact_id"
                                                           option-value="id"
                                                           option-text="display_name"
                                                           placeholder="Select Customer"
                                                           class="rounded-0">
                                        </model-list-select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Received Via</label>
                                    <div class="col-lg-10">
                                        <model-list-select :list="paymentModes"
                                                           v-model="attributes.options.payment_mode"
                                                           option-value="value"
                                                           option-text="text"
                                                           placeholder="Received Via"
                                                           class="rounded-0">
                                        </model-list-select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Tax</label>
                                    <div class="col-lg-10">
                                        <model-list-select :list="taxes"
                                                           v-model="attributes.options.tax_id"
                                                           option-value="id"
                                                           option-text="name"
                                                           placeholder="Select tax"
                                                           class="rounded-0">
                                        </model-list-select>
                                    </div>
                                </div>
                            </div><!-- end #sales_without_invoices_fields -->

                            <div v-if="attributes.process_as === 'transfer_from_another_account'" class="">
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Account</label>
                                    <div class="col-lg-10">
                                        <model-list-select :list="bankAccounts"
                                                           v-model="attributes.options.financial_account_code"
                                                           option-value="financial_account_code"
                                                           option-text="name"
                                                           placeholder="Financial Account"
                                                           class="rounded-0">
                                        </model-list-select>
                                    </div>
                                </div>
                            </div><!-- end #transfer_from_another_account_fields -->

                            <div v-if="attributes.process_as === 'interest_income'" class="">
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Received Via</label>
                                    <div class="col-lg-10">
                                        <model-list-select :list="paymentModes"
                                                           v-model="attributes.options.payment_mode"
                                                           option-value="value"
                                                           option-text="text"
                                                           placeholder="Received Via"
                                                           class="rounded-0">
                                        </model-list-select>
                                    </div>
                                </div>
                            </div><!-- end #interest_income_fields -->

                            <div v-if="attributes.process_as === 'other_income'" class="">
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Account</label>
                                    <div class="col-lg-10">
                                        <model-list-select :list="financialAccountsByType.income"
                                                           v-model="attributes.options.financial_account_code"
                                                           option-value="id"
                                                           option-text="name"
                                                           placeholder="Select financial Account"
                                                           class="rounded-0">
                                        </model-list-select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Received Via</label>
                                    <div class="col-lg-10">
                                        <model-list-select :list="paymentModes"
                                                           v-model="attributes.options.payment_mode"
                                                           option-value="value"
                                                           option-text="text"
                                                           placeholder="Received Via"
                                                           class="rounded-0">
                                        </model-list-select>
                                    </div>
                                </div>
                            </div><!-- end #other_income_fields -->

                            <div v-if="attributes.process_as === 'expense_refund'" class="">

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Account</label>
                                    <div class="col-lg-10">
                                        <model-list-select :list="financialAccountsByType.expense"
                                                           v-model="attributes.options.financial_account_code"
                                                           option-value="id"
                                                           option-text="name"
                                                           placeholder="Select financial Account"
                                                           class="rounded-0">
                                        </model-list-select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Supplier / Vendor</label>
                                    <div class="col-lg-10">
                                        <model-list-select :list="contactsByType.suppliers"
                                                           v-model="attributes.options.contact_id"
                                                           option-value="id"
                                                           option-text="display_name"
                                                           placeholder="Select Customer"
                                                           class="rounded-0">
                                        </model-list-select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Received Via</label>
                                    <div class="col-lg-10">
                                        <model-list-select :list="paymentModes"
                                                           v-model="attributes.options.payment_mode"
                                                           option-value="value"
                                                           option-text="text"
                                                           placeholder="Received Via"
                                                           class="rounded-0">
                                        </model-list-select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Tax</label>
                                    <div class="col-lg-10">
                                        <model-list-select :list="taxes"
                                                           v-model="attributes.options.tax_id"
                                                           option-value="value"
                                                           option-text="text"
                                                           placeholder="Select tax"
                                                           class="rounded-0">
                                        </model-list-select>
                                    </div>
                                </div>
                            </div><!-- end #expense_refund_fields -->

                            <div v-if="attributes.process_as === 'other_deposit'" class="">

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Account</label>
                                    <div class="col-lg-10">
                                        <model-list-select :list="financialAccountsByType.asset"
                                                           v-model="attributes.options.financial_account_code"
                                                           option-value="id"
                                                           option-text="name"
                                                           placeholder="Select financial Account"
                                                           class="rounded-0">
                                        </model-list-select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Customer</label>
                                    <div class="col-lg-10">
                                        <model-list-select :list="contactsByType.customers"
                                                           v-model="attributes.options.contact_id"
                                                           option-value="id"
                                                           option-text="display_name"
                                                           placeholder="Select Customer"
                                                           class="rounded-0">
                                        </model-list-select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Received Via</label>
                                    <div class="col-lg-10">
                                        <model-list-select :list="paymentModes"
                                                           v-model="attributes.options.payment_mode"
                                                           option-value="value"
                                                           option-text="text"
                                                           placeholder="Received Via"
                                                           class="rounded-0">
                                        </model-list-select>
                                    </div>
                                </div>
                            </div><!-- end #other_deposit_fields -->

                            <div v-if="attributes.process_as === 'journal_entry'" class="">
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Account</label>
                                    <div class="col-lg-10">
                                        <model-list-select :list="financialAccounts"
                                                           v-model="attributes.options.financial_account_code"
                                                           option-value="id"
                                                           option-text="name"
                                                           placeholder="Select financial Account"
                                                           class="rounded-0">
                                        </model-list-select>
                                    </div>
                                </div>
                            </div><!-- end #journal_entry_fields -->

                            <!-- Withdraw -->
                            <div v-if="attributes.process_as === 'expense'" class="">

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Account</label>
                                    <div class="col-lg-10">
                                        <model-list-select :list="financialAccountsByType.expense"
                                                           v-model="attributes.options.financial_account_code"
                                                           option-value="id"
                                                           option-text="name"
                                                           placeholder="Select Expense financial Account"
                                                           class="rounded-0">
                                        </model-list-select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Supplier / Vendor</label>
                                    <div class="col-lg-10">
                                        <model-list-select :list="contactsByType.suppliers"
                                                           v-model="attributes.options.contact_id"
                                                           option-value="id"
                                                           option-text="display_name"
                                                           placeholder="Select Customer"
                                                           class="rounded-0">
                                        </model-list-select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Tax</label>
                                    <div class="col-lg-10">
                                        <model-list-select :list="taxes"
                                                           v-model="attributes.options.tax_id"
                                                           option-value="id"
                                                           option-text="name"
                                                           placeholder="Select tax"
                                                           class="rounded-0">
                                        </model-list-select>
                                    </div>
                                </div>
                            </div><!-- end #expense_fields -->

                            <div v-if="attributes.process_as === 'transfer_to_another_account'" class="">

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Account</label>
                                    <div class="col-lg-10">
                                        <model-list-select :list="bankAccounts"
                                                           v-model="attributes.options.financial_account_code"
                                                           option-value="financial_account_code"
                                                           option-text="name"
                                                           placeholder="Select Bank Account"
                                                           class="rounded-0">
                                        </model-list-select>
                                    </div>
                                </div>
                            </div><!-- end #transfer_to_another_account_fields -->

                            <div v-if="attributes.process_as === 'sales_return'" class="">

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Account</label>
                                    <div class="col-lg-10">
                                        <model-list-select :list="financialAccountsByType.income"
                                                           v-model="attributes.options.financial_account_code"
                                                           option-value="id"
                                                           option-text="name"
                                                           placeholder="Select Income / Revenue Account"
                                                           class="rounded-0">
                                        </model-list-select>
                                    </div>
                                </div>
                            </div><!-- end #sales_return_fields -->

                            <div v-if="attributes.process_as === 'card_payments'" class="">

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Account</label>
                                    <div class="col-lg-10">
                                        <model-list-select :list="financialAccountsByType.expense"
                                                           v-model="attributes.options.financial_account_code"
                                                           option-value="id"
                                                           option-text="name"
                                                           placeholder="Select Expense financial Account"
                                                           class="rounded-0">
                                        </model-list-select>
                                    </div>
                                </div>
                            </div><!-- end #card_payments_fields -->

                            <div v-if="attributes.process_as === 'owner_drawings'" class="">
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Account</label>
                                    <div class="col-lg-10">
                                        <model-list-select :list="financialAccountsByType.equity"
                                                           v-model="attributes.options.financial_account_code"
                                                           option-value="id"
                                                           option-text="name"
                                                           placeholder="Select financial Account"
                                                           class="rounded-0">
                                        </model-list-select>
                                    </div>
                                </div>
                            </div><!-- end #owner_drawings_fields -->

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label"> </label>
                                <div class="col-sm-10">
                                    <button type="button"
                                            @click="formSubmit"
                                            class="btn btn-danger font-weight-bold rounded-0 col-auto">
                                        <i class="icon-googleplus5 mr-2"></i>
                                        Save transaction rule
                                    </button>
                                </div>
                            </div>

                        </fieldset>

                    </form>

                </div>
            </div>
            <!-- /form horizontal -->


        </div>
        <!-- /content area -->

    </div>
    <!-- /main content -->

</template>

<script>

    export default {
        data() {
            return {
                pageTitle: 'Add Bank Account',
                urlPost: '/banking/accounts/'+this.$route.params.bank_account_id+'/transactions/rules',
                bankAccounts: [],
                financialAccountsByType: {
                    income: [],
                    expense: [],
                    equity: []
                },
                contactsByType: {
                    suppliers: [],
                    customers: []
                },
                paymentModes: [],
                taxes: [],
                attributes: {
                    bank_account: {},
                    apply_to: null,
                    process_as: null,
                    criteria: [{}],
                    options: {}
                },
                criteriaColumn: [
                    { value: 'payee', text: 'Payee' },
                    { value: 'description', text: 'Description' },
                    { value: 'reference', text: 'Reference' },
                    { value: 'amount', text: 'Amount' },
                ],
                criteriaCondition: [
                    { value: 'is', text: 'Is' },
                    { value: 'contains', text: 'Contains' },
                    { value: 'starts_with', text: 'Starts with' },
                    { value: 'is_empty', text: 'Is empty' },
                ]
            }
        },
        mounted() {
            this.$root.appMenu('accounting')
            this.$root.appFetchGlobalsCurrencies()
            this.fetchBanks('-initiate-')

            this.fetchAttributes();
            this.appFetchGlobalsCountries();

        },
        watch: {},
        computed: {
            processAs: function ()
            {
                // console.log(this.attributes.apply_to);

                if (this.attributes.apply_to === 'deposit')
                {
                    return [
                        { value: 'sales_without_invoice', text: 'Sales without invoice' },
                        { value: 'transfer_from_another_account', text: 'Transfer from another account' },
                        { value: 'interest_income', text: 'Interest income' },
                        { value: 'other_income', text: 'Other income' },
                        { value: 'expense_refund', text: 'Expense refund' },
                        { value: 'other_deposit', text: 'Other deposit' },
                    ];
                }
                else if (this.attributes.apply_to === 'withdraw')
                {
                    return [
                        { value: 'expense', text: 'Expense' },
                        { value: 'transfer_to_another_account', text: 'Transfer to another account' },
                        { value: 'sales_return', text: 'Sales return' },
                        { value: 'card_payments', text: 'Card payments' },
                        { value: 'owner_drawings', text: 'Owner drawings' }
                    ];
                }
                else
                {
                    return [];
                }
            },
            financialAccounts: function ()
            {
                let financialAccounts = [];

                // console.log(this.attributes.apply_to);
                this.financialAccountsByType.forEach((financialAccounts, group) => {
                    financialAccounts.forEach((account) => {
                        financialAccounts.push(account)
                    });
                });

                return financialAccounts;
            }
        },
        methods: {
            async fetchAttributes() {
                //console.log('fetchAttributes')

                try {

                    // let currentObj = this;

                    return await axios.get(this.$route.fullPath)
                        .then(response => {

                            //currentObj.pageTitle = response.data.pageTitle
                            //currentObj.urlPost = response.data.urlPost
                            //currentObj.attributes = response.data.attributes

                            this.urlPost = response.data.urlPost
                            this.attributes = response.data.attributes

                            this.bank_account = response.data.bankAccounts
                            this.financialAccountsByType = response.data.financialAccountsByType
                            this.paymentModes = response.data.paymentModes
                            this.contactsByType = response.data.contactsByType

                            if (this.attributes.criteria.length < 1)
                            {
                                this.attributes.criteria.push({})
                            }

                            // console.log(currentObj.financialAccountsByType.expense);

                        })
                        .catch(function (error) {
                            // handle error
                            console.log(error); //test
                        })
                        .finally(function (response) {
                            // always executed this is supposed
                        })

                } catch (e) {
                    console.log(e); //test
                }
            },
            async fetchBanks(searchText) {

                if(!searchText) {
                    return false
                }

                searchText = (searchText === '-initiate-') ? '' : searchText

                let data = {
                    search: [
                        {
                            column: 'name',
                            value: searchText
                        }
                    ]
                }

                try {

                    return await axios.post(
                        '/banking/banks/search',
                        data
                    )
                        .then(response => {
                            this.banks = response.data.data
                        })
                        .catch(function (error) {
                            // handle error
                            console.log(error); //test
                        })
                        .finally(function (response) {
                            // always executed this is supposed
                        })

                } catch (e) {
                    console.log(e); //test
                }

            },
            formSubmit(e) {

                e.preventDefault();

                let currentObj = this;

                PNotify.removeAll();

                let PNotifySettings = {
                    title: false, //'Processing',
                    text: 'Please wait as we do our thing',
                    addclass: 'bg-warning-400 border-warning-400',
                    hide: false,
                    buttons: {
                        closer: false,
                        sticker: false
                    }
                };

                let notice = new PNotify(PNotifySettings);

                axios.post(currentObj.urlPost, this.attributes)
                    .then(function (response) {

                        //PNotify.removeAll();

                        PNotifySettings.text = response.data.messages.join("\n");

                        if(response.data.status === true) {
                            PNotifySettings.title = 'Success';
                            PNotifySettings.type = 'success';
                            PNotifySettings.addclass = 'bg-success-400 border-success-400';

                            currentObj.attributes = {
                                name: '',
                                code: '',
                                country: '',
                            };

                        } else {
                            PNotifySettings.title = '! Error';
                            PNotifySettings.type = 'error';
                            PNotifySettings.addclass = 'bg-warning-400 border-warning-400';
                        }

                        //let notice = new PNotify(PNotifySettings);
                        notice.update(PNotifySettings);

                        notice.get().click(function() {
                            notice.remove();
                        });

                        //currentObj.response = response.data;
                    })
                    .catch(function (error) {
                        currentObj.response = error;
                    });
            },
            addCriteria()
            {
                this.attributes.criteria.push({});
            }
        },
        ready:function(){

        },
        beforeUpdate: function () {
            //console.log('beforeUpdate')
        },
        updated: function () {
            //console.log('updated:: dom updated -')

        }
    }
</script>
