<template>
    <div class="transactions_tax_form_fields d-none">

        <hr>

        <div class="form-group row">
            <label class="col-form-label col-lg-3">Bank charge(If any): </label>
            <div class="col-lg-9">
                <div class="input-group">
                    <span class="input-group-prepend">
                        <span class="input-group-text">{{$root.tenant.base_currency}}</span>
                    </span>
                    <input type="text" name="items[0][rate]" value="" class="form-control font-weight-semibold" placeholder="0.00">
                </div>
                <div class="form-check form-check-inline pl-2">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input"  name="_tax_base" checked>
                        Is taxable amount
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group row mb-1">
            <label class="col-lg-3 col-form-label">Tax:</label>
            <div class="col-lg-4">
                <model-list-select :list="txnTaxes"
                                   v-model="txnAttributes._tax_id"
                                   option-value="id"
                                   option-text="name"
                                   class=""
                                   placeholder="select account">
                </model-list-select>

            </div>
            <div class="col-lg-5">
                <div class="input-group">
                    <span class="input-group-prepend">
                        <span class="input-group-text">{{$root.tenant.base_currency}}</span>
                    </span>
                    <input type="text" name="_tax_amount" value="" class="form-control font-weight-semibold" placeholder="0.00">
                </div>
            </div>
        </div>

        <div class="form-group row" title="Show/Hide Bank charge or Tax Reference">
            <label class="col-form-label col-lg-3"> </label>
            <div class="col-lg-9">
                <button type="button" class="btn btn-link" v-on:click='showBankChargeRefAndTaxRefFields = !showBankChargeRefAndTaxRefFields'>
                    <i class="icon-comment-discussion position-left"></i> Show/Hide Bank charge or Tax Reference
                </button>
            </div>
        </div>

        <div v-show="showBankChargeRefAndTaxRefFields" class="form-group row" title="Bank charge Reference">
            <label class="col-form-label col-lg-3">Bank charge Ref ... </label>
            <div class="col-lg-9">
                <input type="text" name="reference_bank_charge" value="" class="form-control" placeholder="Bank charge Reference">
            </div>
        </div>

        <div v-show="showBankChargeRefAndTaxRefFields" class="form-group row" title="Tax Reference">
            <label class="col-form-label col-lg-3">Tax Reference</label>
            <div class="col-lg-9">
                <input type="text" name="reference_tax" value="" class="form-control" placeholder="Tax Reference">
            </div>
        </div>

        <hr>

    </div>
</template>

<script>

    export default {
        data() {
            return {
                showBankChargeRefAndTaxRefFields: false
            }
        },
        watch: {},
        mounted() {
            this.txnFetchTaxes()
        },
        methods: {}
    }
</script>
