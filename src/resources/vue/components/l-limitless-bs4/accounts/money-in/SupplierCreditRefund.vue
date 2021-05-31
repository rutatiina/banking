<template>

    <div id="banking_supplier_credit_refund" class="card card-flat border-0 shadow-0">

        <div class="card-header bg-light header-elements-inline">
            <h4 class="card-title">Supplier Credit Refund</h4>
            <div class="header-elements">
                <div class="list-icons">
                    <router-link class="list-icons-item" to="" data-action="remove"></router-link>
                </div>
            </div>
        </div>

        <div class="card-body">

            <form @submit="bankingTxnStore"
                  class="form-horizontal"
                  autocomplete="off">

                <fieldset class="">

                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Supplier:</label>
                        <div class="col-lg-9">
                            <model-list-select :list="txnContacts"
                                               v-model="txnAttributes.contact"
                                               @searchchange="txnFetchSuppliers"
                                               @input="txnContactSelect"
                                               option-value="id"
                                               option-text="display_name"
                                               placeholder="Select Supplier">
                            </model-list-select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Date:</label>
                        <div class="col-lg-9">
                            <date-picker v-model="txnAttributes.date"
                                         valueType="format"
                                         :lang="vue2DatePicker.lang"
                                         class="font-weight-bold w-100 h-100"
                                         placeholder="Choose date">
                            </date-picker>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Amount:</label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <span class="input-group-text">{{$root.tenant.base_currency}}</span>
                                </span>
                                <input type="number"
                                       v-model="txnAttributes.debit"
                                       v-on:keyup="txnTotal"
                                       class="form-control font-weight-semibold"
                                       placeholder="0.00">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Received Via:</label>
                        <div class="col-lg-9">
                            <model-select
                                :options="txnPaymentModes"
                                v-model="txnAttributes.payment_mode"
                                placeholder="Select payment mode">
                            </model-select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Reference:</label>
                        <div class="col-lg-9">
                            <input type="text" v-model="txnAttributes.reference" value="" class="form-control input-roundless" placeholder="Reference">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Description:</label>
                        <div class="col-lg-9">
                            <textarea v-model="txnAttributes.description" class="form-control input-roundless banking_item_description" placeholder="Description"></textarea>
                        </div>
                    </div>

                    <tax-tax-ref-bank-ref></tax-tax-ref-bank-ref>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">Attach files</label>
                        <div class="col-lg-9">
                            <input ref="filesAttached" type="file" multiple class="form-control border-0 p-1 h-auto">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label"> </label>
                        <div class="col-lg-9">
                            <button type="submit" class="btn btn-danger font-weight-bold"><i class="icon-cloud-upload mr-1"></i> Save transaction</button>
                        </div>
                    </div>

                </fieldset>

            </form>

        </div>
    </div>

</template>

<script>

    import RgBankingTxn from './../../../../plugins/RgBankingTxn'

    import TaxTaxRefBankRef from './TaxTaxRefBankRef'

    export default {
        mixins: [RgBankingTxn],
        components: {
            TaxTaxRefBankRef,
        },
        data() {
            return {}
        },
        watch: {},
        mounted() {
            this.fetchAccountTxnAttributes({
                financial_account_code: this.$route.params.id,
                name: 'supplier-credit-refund'
            });
            this.txnFetchPaymentModes()
            this.txnFetchSuppliers('-initiate-')
        },
        methods: {}
    }
</script>
