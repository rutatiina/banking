<template>
    <!-- Right sidebar -->
    <div v-if="$route.hash" class="sidebar sidebar-light sidebar-right sidebar-expand-md" style="width:600px;">

        <!-- Sidebar mobile toggler -->
        <div class="sidebar-mobile-toggler text-center">
            <a href="#" class="sidebar-mobile-expand">
                <i class="icon-screen-full"></i>
                <i class="icon-screen-normal"></i>
            </a>
            <span class="font-weight-semibold">Right sidebar</span>
            <a href="#" class="sidebar-mobile-right-toggle">
                <i class="icon-arrow-right8"></i>
            </a>
        </div>
        <!-- /sidebar mobile toggler -->


        <!-- Sidebar content -->
        <div class="sidebar-content">
            <div id="rg-sidebar-right-fixed-content-scroll"
                 class="position-fixed h-100"
                 style="width: 600px; overflow: hidden; padding-bottom:80px !important;">
                <div>

                    <money-in-customer-advance v-if="$route.hash === '#customer-advance'"></money-in-customer-advance>
                    <money-in-customer-payment v-if="$route.hash === '#customer-payment'"></money-in-customer-payment>
                    <money-in-expense-refund v-if="$route.hash === '#expense-refund'"></money-in-expense-refund>
                    <money-in-interest-income v-if="$route.hash === '#interest-income'"></money-in-interest-income>
                    <money-in-other-deposit v-if="$route.hash === '#other-deposit'"></money-in-other-deposit>
                    <money-in-other-income v-if="$route.hash === '#other-income'"></money-in-other-income>
                    <money-in-owners-contribution v-if="$route.hash === '#owners-contribution'"></money-in-owners-contribution>
                    <money-in-retainer-payment v-if="$route.hash === '#retainer-payment'"></money-in-retainer-payment>
                    <money-in-sales-without-invoice v-if="$route.hash === '#sales-without-invoice'"></money-in-sales-without-invoice>
                    <money-in-supplier-credit-refund v-if="$route.hash === '#supplier-credit-refund'"></money-in-supplier-credit-refund>
                    <money-in-supplier-payment-refund v-if="$route.hash === '#supplier-payment-refund'"></money-in-supplier-payment-refund>
                    <money-in-transfer-in v-if="$route.hash === '#transfer-in'"></money-in-transfer-in>

                    <money-out-card-payment v-if="$route.hash === '#card-payment'"></money-out-card-payment>
                    <money-out-credit-note-refund v-if="$route.hash === '#credit-note-refund'"></money-out-credit-note-refund>
                    <money-out-expense v-if="$route.hash === '#expense'"></money-out-expense>
                    <money-out-owner-drawings v-if="$route.hash === '#owner-drawings'"></money-out-owner-drawings>
                    <money-out-payment-refund v-if="$route.hash === '#payment-refund'"></money-out-payment-refund>
                    <money-out-sales-return v-if="$route.hash === '#sales-return'"></money-out-sales-return>
                    <money-out-supplier-advance v-if="$route.hash === '#supplier-advance'"></money-out-supplier-advance>
                    <money-out-supplier-payment v-if="$route.hash === '#supplier-payment'"></money-out-supplier-payment>
                    <money-out-transfer-out v-if="$route.hash === '#transfer-out'"></money-out-transfer-out>

                </div>
            </div>

        </div>
        <!-- /sidebar content -->

    </div>
    <!-- /right sidebar -->
</template>

<script>

    //money in
    import MoneyInCustomerAdvance from './money-in/CustomerAdvance'
    import MoneyInCustomerPayment from './money-in/CustomerPayment'
    import MoneyInExpenseRefund from './money-in/ExpenseRefund'
    import MoneyInInterestIncome from './money-in/InterestIncome'
    import MoneyInOtherDeposit from './money-in/OtherDeposit'
    import MoneyInOtherIncome from './money-in/OtherIncome'
    import MoneyInOwnersContribution from './money-in/OwnersContribution'
    import MoneyInRetainerPayment from './money-in/RetainerPayment'
    import MoneyInSalesWithoutInvoice from './money-in/SalesWithoutInvoice'
    import MoneyInSupplierCreditRefund from './money-in/SupplierCreditRefund'
    import MoneyInSupplierPaymentRefund from './money-in/SupplierPaymentRefund'
    import MoneyInTransferIn from './money-in/TransferIn'

    import MoneyOutCardPayment from './money-out/CardPayment'
    import MoneyOutCreditNoteRefund from './money-out/CreditNoteRefund'
    import MoneyOutExpense from './money-out/Expense'
    import MoneyOutOwnerDrawings from './money-out/OwnerDrawings'
    import MoneyOutPaymentRefund from './money-out/PaymentRefund'
    import MoneyOutSalesReturn from './money-out/SalesReturn'
    import MoneyOutSupplierAdvance from './money-out/SupplierAdvance'
    import MoneyOutSupplierPayment from './money-out/SupplierPayment'
    import MoneyOutTransferOut from './money-out/TransferOut'

    export default {
        components: {
            MoneyInCustomerAdvance,
            MoneyInCustomerPayment,
            MoneyInExpenseRefund,
            MoneyInInterestIncome,
            MoneyInOtherDeposit,
            MoneyInOtherIncome,
            MoneyInOwnersContribution,
            MoneyInRetainerPayment,
            MoneyInSalesWithoutInvoice,
            MoneyInSupplierCreditRefund,
            MoneyInSupplierPaymentRefund,
            MoneyInTransferIn,

            MoneyOutCardPayment,
            MoneyOutCreditNoteRefund,
            MoneyOutExpense,
            MoneyOutOwnerDrawings,
            MoneyOutPaymentRefund,
            MoneyOutSalesReturn,
            MoneyOutSupplierAdvance,
            MoneyOutSupplierPayment,
            MoneyOutTransferOut
        },
        data() {
            return {
                PerfectScrollbar: null
            }
        },
        mounted() {

            //make the secondary sidebar scrollable
            if (this.$route.hash) this.PerfectScrollbar = new PerfectScrollbar('#rg-sidebar-right-fixed-content-scroll');

        },
        updated: function () {

            //update scrollable are on data change
            if (this.$route.hash) {

                if (this.PerfectScrollbar) {
                    this.PerfectScrollbar.update();
                } else {
                    this.PerfectScrollbar = new PerfectScrollbar('#rg-sidebar-right-fixed-content-scroll');
                }
            }
        }
    }
</script>
