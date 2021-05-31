<?php defined('BASEPATH') || exit('No direct script access allowed'); ?>
<!-- Opposite sidebar -->
<div class="sidebar sidebar-opposite sidebar-default hidden" style="width:650px;">
    <div class="sidebar-content">

        <div class="panel panel-flat no-border no-shadow">
            <div class="panel-body">
                <div class="tabbable">
                    <ul id="tabs_add_transaction" class="nav nav-tabs nav-tabs-bottom hidden">
                        <li class="active"><a href="#bottom-tab1" data-toggle="tab" style="background: none;">Add Transaction</a></li>
                    </ul>

                    <ul id="tabs_selected_transaction" class="nav nav-tabs nav-tabs-bottom hidden">
                        <li class="active"><a href="#bottom-tab1" data-toggle="tab" style="background: none;">Categorize Manually</a></li>
                        <li><a href="#bottom-tab2" data-toggle="tab" style="background: none;">Match Transaction</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="bottom-tab1">

                            <!-- CETEGORY -->
                            <div id="banking_category_money_out" class="txn_form_panel txn_category_panel panel panel-flat no-border no-shadow hidden">

                                <div class="panel-body">

                                    <form action="#" method="post" class="form-horizontal">

                                        <fieldset class="">

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Category:</label>
                                                <div class="col-lg-8">
                                                    <select name="banking_category_money_out" data-placeholder="Category" class="select-search">
                                                        <option value=""></option>
                                                        <optgroup label="MONEY OUT">
                                                            <option value="#banking_expense">Expense</option>
                                                            <option value="#banking_supplier_advance">Supplier Advance</option>
                                                            <option value="#banking_supplier_payment">Supplier payment</option>
                                                            <option value="#banking_transfer_to_another_account">Transfer To Another Account</option>
                                                            <option value="#banking_sales_return">Sales Return</option>
                                                            <option value="#banking_card_payment">Card Payment</option>
                                                            <option value="#banking_owner_drawings">Owner Drawings</option>
                                                            <option value="#banking_credit_note_refund">Credit Note Refund</option>
                                                            <option value="#banking_payment_refund">Payment Refund</option>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                                <div class="col-lg-1 control-label">
                                                    <div class="pull-right">
                                                        <ul class="icons-list">
                                                            <li><a class="hide-sidebar-opposite"><i class="icon-cross2 text-muted text-size-large"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                        </fieldset>

                                    </form>

                                </div>
                            </div>

                            <div id="banking_category_money_in" class="txn_form_panel txn_category_panel panel panel-flat no-border no-shadow hidden">

                                <div class="panel-body">

                                    <form action="#" method="post" class="form-horizontal">

                                        <fieldset class="">

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Category:</label>
                                                <div class="col-lg-8">
                                                    <select name="banking_category_money_in" data-placeholder="Category" class="select-search">
                                                        <option value=""></option>
                                                        <optgroup label="MONEY IN">
                                                            <option value="#banking_customer_advance">Customer Advance</option>
                                                            <option value="#banking_customer_payment">Customer Payment</option>
                                                            <option value="#banking_retainer_payment">Retainer Payment</option>
                                                            <option value="#banking_sales_without_invoice">Sales Without Invoices</option>
                                                            <option value="#banking_transfer_from_another_account">Transfer From Another Account</option>
                                                            <option value="#banking_interest_income">Interest Income</option>
                                                            <option value="#banking_other_income">Other Income</option>
                                                            <option value="#banking_expense_refund">Expense Refund</option>
                                                            <option value="#banking_other_deposit">Other Deposit</option>
                                                            <option value="#banking_owners_contribution">Owner's Contribution</option>
                                                            <option value="#banking_supplier_credit_refund">Supplier Credit Refund</option>
                                                            <option value="#banking_supplier_payment_refund">Supplier Payment Refund</option>
                                                        </optgroup>

                                                    </select>
                                                </div>
                                                <div class="col-lg-1 control-label">
                                                    <div class="pull-right">
                                                        <ul class="icons-list">
                                                            <li><a class="hide-sidebar-opposite"><i class="icon-cross2 text-muted text-size-large"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                        </fieldset>

                                    </form>

                                </div>
                            </div>

                            <!-- MONEY OUT -->
                            <div id="banking_expense" class="txn_form_panel panel panel-flat no-border no-shadow hidden">

                                <div class="panel-heading no-padding-top">
                                    <h4 class="panel-title">Expense</h4>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a class="hide-sidebar-opposite"><i class="icon-cross2 text-muted text-size-large"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">

                                    <form action="/banking/transactions/<?php echo $bank_account->financial_account_code; ?>/insert/" method="post" class="form-horizontal">

                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                        <input type="hidden" name="submit" value="1" />

                                        <input type="hidden" name="_transaction_id" value="">
                                        <input type="hidden" name="_transaction_status" value="">
                                        <input type="hidden" name="_financial_account_code" value="<?php echo $bank_account->financial_account_code; ?>">
                                        <input type="hidden" name="bank_account_id" value="<?php echo $bank_account->id; ?>">
                                        <input type="hidden" name="txn_entree_id" value="expense">
                                        <input type="hidden" name="credit" value="<?php echo $bank_account->financial_account_code; ?>">
                                        <input type="hidden" name="number" value="NULL">
                                        <input type="hidden" name="base_currency" value="<?php echo $bank_account->currency; ?>">
                                        <input type="hidden" name="quote_currency" value="<?php echo $bank_account->currency; ?>">
                                        <input type="hidden" name="exchange_rate" value="1">
                                        <input type="hidden" name="items[0][type]" value="account">
                                        <input type="hidden" name="items[0][quantity]" value="1">

                                        <fieldset class="">

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Expense Account:</label>
                                                <div class="col-lg-9">
                                                    <select name="items[0][type_id]" data-placeholder="Account" class="select-search">
                                                        <option value=""></option>
                                                        <optgroup label="Expense Accounts">
                                                            <?php foreach ($accounts['expense'] as $account) { ?>
                                                                <option value="<?php echo $account->code; ?>"><?php echo $account->name; ?></option>
                                                            <?php } ?>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Supplier:</label>
                                                <div class="col-lg-9">
                                                    <select name="contact_id" data-placeholder="Select Supplier" class="select-search">
                                                        <option value=""></option>
                                                        <?php foreach ($contacts['supplier'] as $contact) { ?>
                                                            <option value="<?php echo $contact->id; ?>"><?php echo $contact->name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Date:</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="date_time" value="" class="form-control input-roundless daterange-single" placeholder="Choose date">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Amount:</label>
                                                <div class="col-lg-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon label-roundless text-semibold"><?php echo $bank_account->currency; ?></span>
                                                        <input type="text" name="items[0][rate]" value="" class="form-control input-roundless banking_item_rate text-semibold" placeholder="0.00">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Reference:</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="reference" value="" class="form-control input-roundless" placeholder="Reference">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Description:</label>
                                                <div class="col-lg-9">
                                                    <textarea name="items[0][description]" class="form-control input-roundless banking_item_description" placeholder="Description"></textarea>
                                                </div>
                                            </div>

                                            <?php /*
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Customer:</label>
                            <div class="col-lg-9">
                                <select name="country_code" data-placeholder="Select Customer" class="select-search">
                                    <option value=""></option>
                                    <?php foreach ($contacts['customer'] as $contact) { ?>
                                    <option value="<?php echo $contact->id; ?>"><?php echo $contact->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        */ ?>

                                            <?php Template::block('tax_form_fields'); ?>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label"> </label>
                                                <div class="col-lg-9">
                                                    <button type="button" onclick="rg_banking.form_ajax_submit('#banking_expense form', true);" class="btn btn-danger"><i class="icon-check"></i> Save</button>
                                                </div>
                                            </div>

                                        </fieldset>

                                    </form>

                                </div>
                            </div>

                            <div id="banking_supplier_advance" class="txn_form_panel panel panel-flat no-border no-shadow hidden">

                                <div class="panel-heading no-padding-top">
                                    <h4 class="panel-title">Supplier Advance</h4>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a class="hide-sidebar-opposite"><i class="icon-cross2 text-muted text-size-large"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">

                                    <form action="/banking/transactions/<?php echo $bank_account->financial_account_code; ?>/insert/" method="post" class="form-horizontal">

                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                        <input type="hidden" name="submit" value="1" />

                                        <input type="hidden" name="_transaction_id" value="">
                                        <input type="hidden" name="_transaction_status" value="">
                                        <input type="hidden" name="_financial_account_code" value="<?php echo $bank_account->financial_account_code; ?>">
                                        <input type="hidden" name="bank_account_id" value="<?php echo $bank_account->id; ?>">
                                        <input type="hidden" name="txn_entree_id" value="payment">
                                        <input type="hidden" name="credit" value="<?php echo $bank_account->financial_account_code; ?>">
                                        <input type="hidden" name="number" value="NULL">
                                        <input type="hidden" name="base_currency" value="<?php echo $bank_account->currency; ?>">
                                        <input type="hidden" name="quote_currency" value="<?php echo $bank_account->currency; ?>">
                                        <input type="hidden" name="exchange_rate" value="1">
                                        <input type="hidden" name="items[0][type]" value="">
                                        <input type="hidden" name="items[0][quantity]" value="1">

                                        <fieldset class="">

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Supplier:</label>
                                                <div class="col-lg-9">
                                                    <select name="contact_id" data-placeholder="Select Supplier" class="select-search">
                                                        <option value=""></option>
                                                        <?php foreach ($contacts['supplier'] as $contact) { ?>
                                                            <option value="<?php echo $contact->id; ?>"><?php echo $contact->name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Date:</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="date_time" value="" class="form-control input-roundless daterange-single" placeholder="Choose date">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Amount:</label>
                                                <div class="col-lg-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon label-roundless text-semibold"><?php echo $current_client->base_currency; ?></span>
                                                        <input type="text" name="items[0][rate]" value="" class="form-control input-roundless  banking_item_rate text-semibold" placeholder="0.00">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Paid Via:</label>
                                                <div class="col-lg-9">
                                                    <select name="payment_mode" data-placeholder="Paid Via" class="select-search">
                                                        <option value=""></option>
                                                        <?php foreach ($payment_modes as $payment_mode) { ?>
                                                            <option value="<?php echo $payment_mode->name; ?>"><?php echo $payment_mode->name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Reference:</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="reference" value="" class="form-control input-roundless" placeholder="Reference">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Description:</label>
                                                <div class="col-lg-9">
                                                    <textarea name="items[0][description]" class="form-control input-roundless banking_item_description" placeholder="Description"></textarea>
                                                </div>
                                            </div>

                                            <?php Template::block('tax_form_fields'); ?>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label"> </label>
                                                <div class="col-lg-9">
                                                    <button type="button" onclick="rg_banking.form_ajax_submit('#banking_supplier_advance form', false);" class="btn btn-danger"><i class="icon-check"></i> Save</button>
                                                </div>
                                            </div>

                                        </fieldset>

                                    </form>

                                </div>
                            </div>

                            <div id="banking_supplier_payment" class="txn_form_panel panel panel-flat no-border no-shadow hidden">

                                <div class="panel-heading no-padding-top">
                                    <h4 class="panel-title">Supplier Payment</h4>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a class="hide-sidebar-opposite"><i class="icon-cross2 text-muted text-size-large"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">

                                    <form action="/banking/transactions/<?php echo $bank_account->financial_account_code; ?>/insert/" method="post" class="form-horizontal">

                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                        <input type="hidden" name="submit" value="1" />

                                        <input type="hidden" name="_transaction_id" value="">
                                        <input type="hidden" name="_transaction_status" value="">
                                        <input type="hidden" name="_financial_account_code" value="<?php echo $bank_account->financial_account_code; ?>">
                                        <input type="hidden" name="bank_account_id" value="<?php echo $bank_account->id; ?>">
                                        <input type="hidden" name="txn_entree_id" value="payment">
                                        <input type="hidden" name="credit" value="<?php echo $bank_account->financial_account_code; ?>">
                                        <input type="hidden" name="number" value="NULL">
                                        <input type="hidden" name="base_currency" value="<?php echo $bank_account->currency; ?>">
                                        <input type="hidden" name="quote_currency" value="<?php echo $bank_account->currency; ?>">
                                        <input type="hidden" name="exchange_rate" value="1">
                                        <input type="hidden" name="items[0][type]" value="">
                                        <input type="hidden" name="items[0][quantity]" value="1">

                                        <fieldset class="">

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Supplier:</label>
                                                <div class="col-lg-9">
                                                    <select name="contact_id" data-placeholder="Select Supplier" class="select-search">
                                                        <option value=""></option>
                                                        <?php foreach ($contacts['supplier'] as $contact) { ?>
                                                            <option value="<?php echo $contact->id; ?>"><?php echo $contact->name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Date:</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="date_time" value="" class="form-control input-roundless daterange-single" placeholder="Choose date">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Amount:</label>
                                                <div class="col-lg-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon label-roundless text-semibold"><?php echo $current_client->base_currency; ?></span>
                                                        <input type="text" name="items[0][rate]" value="" class="form-control input-roundless banking_item_rate text-semibold" placeholder="0.00">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Paid Via:</label>
                                                <div class="col-lg-9">
                                                    <select name="payment_mode" data-placeholder="Paid Via" class="select-search">
                                                        <option value=""></option>
                                                        <?php foreach ($payment_modes as $payment_mode) { ?>
                                                            <option value="<?php echo $payment_mode->name; ?>"><?php echo $payment_mode->name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Reference:</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="reference" value="" class="form-control input-roundless" placeholder="Reference">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Description:</label>
                                                <div class="col-lg-9">
                                                    <textarea name="items[0][description]" class="form-control input-roundless banking_item_description" placeholder="Description"></textarea>
                                                </div>
                                            </div>

                                            <?php Template::block('tax_form_fields'); ?>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label"> </label>
                                                <div class="col-lg-9">
                                                    <button type="button" onclick="rg_banking.form_ajax_submit('#banking_supplier_payment form', false);" class="btn btn-danger"><i class="icon-check"></i> Save</button>
                                                </div>
                                            </div>

                                        </fieldset>

                                    </form>

                                </div>
                            </div>

                            <div id="banking_transfer_to_another_account" class="txn_form_panel panel panel-flat no-border no-shadow hidden">

                                <div class="panel-heading no-padding-top">
                                    <h4 class="panel-title">Transfer To Another Account</h4>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a class="hide-sidebar-opposite"><i class="icon-cross2 text-muted text-size-large"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">

                                    <form action="/banking/transactions/<?php echo $bank_account->financial_account_code; ?>/insert/" method="post" class="form-horizontal">

                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                        <input type="hidden" name="submit" value="1" />

                                        <input type="hidden" name="_transaction_id" value="">
                                        <input type="hidden" name="_transaction_status" value="">
                                        <input type="hidden" name="_financial_account_code" value="<?php echo $bank_account->financial_account_code; ?>">
                                        <input type="hidden" name="bank_account_id" value="<?php echo $bank_account->id; ?>">
                                        <input type="hidden" name="txn_entree_id" value="0">
                                        <input type="hidden" name="txn_type_id" value="0">
                                        <input type="hidden" name="credit" value="<?php echo $bank_account->financial_account_code; ?>">
                                        <input type="hidden" name="number" value="NULL">
                                        <input type="hidden" name="base_currency" value="<?php echo $bank_account->currency; ?>">
                                        <input type="hidden" name="quote_currency" value="<?php echo $bank_account->currency; ?>">
                                        <input type="hidden" name="exchange_rate" value="1">
                                        <input type="hidden" name="items[0][type]" value="">
                                        <input type="hidden" name="items[0][quantity]" value="1">

                                        <fieldset class="">

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">To Account:</label>
                                                <div class="col-lg-9">
                                                    <select name="_debit_type_id" data-placeholder="Select Account" class="select-search">
                                                        <option value=""></option>
                                                        <optgroup label="Asset Accounts">
                                                            <?php foreach ($accounts['asset'] as $account) { ?>
                                                                <option value="<?php echo $account->code; ?>"><?php echo $account->name; ?></option>
                                                            <?php } ?>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Date: </label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="date_time" value="" class="form-control input-roundless daterange-single" placeholder="Choose date">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Amount: </label>
                                                <div class="col-lg-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon label-roundless text-semibold"><?php echo $current_client->base_currency; ?></span>
                                                        <input type="text" name="items[0][rate]" value="" class="form-control input-roundless banking_item_rate text-semibold" placeholder="0.00">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Reference:</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="reference" value="" class="form-control input-roundless" placeholder="Reference">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Description:</label>
                                                <div class="col-lg-9">
                                                    <textarea name="items[0][description]" class="form-control input-roundless banking_item_description" placeholder="Description"></textarea>
                                                </div>
                                            </div>

                                            <?php Template::block('tax_form_fields'); ?>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label"> </label>
                                                <div class="col-lg-9">
                                                    <button type="button" onclick="rg_banking.form_ajax_submit('#banking_transfer_to_another_account form', false);" class="btn btn-danger"><i class="icon-check"></i> Save</button>
                                                </div>
                                            </div>

                                        </fieldset>

                                    </form>

                                </div>
                            </div>

                            <div id="banking_sales_return" class="txn_form_panel panel panel-flat no-border no-shadow hidden">

                                <div class="panel-heading no-padding-top">
                                    <h4 class="panel-title">Sales Return</h4>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a class="hide-sidebar-opposite"><i class="icon-cross2 text-muted text-size-large"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">

                                    <form action="/banking/transactions/<?php echo $bank_account->financial_account_code; ?>/insert/" method="post" class="form-horizontal">

                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                        <input type="hidden" name="submit" value="1" />

                                        <input type="hidden" name="_transaction_id" value="">
                                        <input type="hidden" name="_transaction_status" value="">
                                        <input type="hidden" name="_financial_account_code" value="<?php echo $bank_account->financial_account_code; ?>">
                                        <input type="hidden" name="bank_account_id" value="<?php echo $bank_account->id; ?>">
                                        <input type="hidden" name="txn_entree_id" value="0">
                                        <input type="hidden" name="txn_type_id" value="0">
                                        <input type="hidden" name="credit" value="<?php echo $bank_account->financial_account_code; ?>">
                                        <input type="hidden" name="number" value="NULL">
                                        <input type="hidden" name="base_currency" value="<?php echo $bank_account->currency; ?>">
                                        <input type="hidden" name="quote_currency" value="<?php echo $bank_account->currency; ?>">
                                        <input type="hidden" name="exchange_rate" value="1">
                                        <input type="hidden" name="items[0][type]" value="account">
                                        <input type="hidden" name="items[0][quantity]" value="1">

                                        <fieldset class="">

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Revenue Account:</label>
                                                <div class="col-lg-9">
                                                    <select name="_debit_type_id" data-placeholder="Account" class="select-search">
                                                        <option value=""></option>
                                                        <optgroup label="Revenue / Income Accounts">
                                                            <?php foreach ($accounts['income'] as $account) { ?>
                                                                <option value="<?php echo $account->code; ?>"><?php echo $account->name; ?></option>
                                                            <?php } ?>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Customer:</label>
                                                <div class="col-lg-9">
                                                    <select name="contact_id" data-placeholder="Select Customer" class="select-search">
                                                        <option value=""></option>
                                                        <?php foreach ($contacts['customer'] as $contact) { ?>
                                                            <option value="<?php echo $contact->id; ?>"><?php echo $contact->name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Date:</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="date_time" value="" class="form-control input-roundless daterange-single" placeholder="Choose date">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Amount: </label>
                                                <div class="col-lg-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon label-roundless text-semibold"><?php echo $current_client->base_currency; ?></span>
                                                        <input type="text" name="items[0][rate]" value="" class="form-control input-roundless banking_item_rate text-semibold" placeholder="0.00">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Paid via:</label>
                                                <div class="col-lg-9">
                                                    <select name="payment_mode" data-placeholder="Paid Via" class="select-search">
                                                        <option value=""></option>
                                                        <?php foreach ($payment_modes as $payment_mode) { ?>
                                                            <option value="<?php echo $payment_mode->name; ?>"><?php echo $payment_mode->name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Reference:</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="reference" value="" class="form-control input-roundless" placeholder="Reference">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Description:</label>
                                                <div class="col-lg-9">
                                                    <textarea name="items[0][description]" class="form-control input-roundless banking_item_description" placeholder="Description"></textarea>
                                                </div>
                                            </div>

                                            <?php Template::block('tax_form_fields'); ?>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label"> </label>
                                                <div class="col-lg-9">
                                                    <button type="button" onclick="rg_banking.form_ajax_submit('#banking_sales_return form', false);" class="btn btn-danger"><i class="icon-check"></i> Save</button>
                                                </div>
                                            </div>

                                        </fieldset>

                                    </form>

                                </div>
                            </div>

                            <div id="banking_card_payment" class="txn_form_panel panel panel-flat no-border no-shadow hidden">

                                <div class="panel-heading no-padding-top">
                                    <h4 class="panel-title">Card Payment</h4>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a class="hide-sidebar-opposite"><i class="icon-cross2 text-muted text-size-large"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">

                                    <form action="/banking/transactions/<?php echo $bank_account->financial_account_code; ?>/insert/" method="post" class="form-horizontal">

                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                        <input type="hidden" name="submit" value="1" />

                                        <input type="hidden" name="_transaction_id" value="">
                                        <input type="hidden" name="_transaction_status" value="">
                                        <input type="hidden" name="_financial_account_code" value="<?php echo $bank_account->financial_account_code; ?>">
                                        <input type="hidden" name="bank_account_id" value="<?php echo $bank_account->id; ?>">
                                        <input type="hidden" name="txn_entree_id" value="payment">
                                        <input type="hidden" name="credit" value="<?php echo $bank_account->financial_account_code; ?>">
                                        <input type="hidden" name="number" value="NULL">
                                        <input type="hidden" name="base_currency" value="<?php echo $bank_account->currency; ?>">
                                        <input type="hidden" name="quote_currency" value="<?php echo $bank_account->currency; ?>">
                                        <input type="hidden" name="exchange_rate" value="1">
                                        <input type="hidden" name="items[0][type]" value="">
                                        <input type="hidden" name="items[0][type_id]" value="">
                                        <input type="hidden" name="items[0][quantity]" value="1">

                                        <fieldset class="">

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Paid to:</label>
                                                <div class="col-lg-9">
                                                    <select name="contact_id" data-placeholder="Paid to" class="select-search">
                                                        <option value=""></option>
                                                        <?php foreach ($contacts['supplier'] as $contact) { ?>
                                                            <option value="<?php echo $contact->id; ?>"><?php echo $contact->name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Date:</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="date_time" value="" class="form-control input-roundless daterange-single" placeholder="Choose date">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Amount:</label>
                                                <div class="col-lg-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon label-roundless text-semibold"><?php echo $current_client->base_currency; ?></span>
                                                        <input type="text" name="items[0][rate]" value="" class="form-control input-roundless banking_item_rate text-semibold" placeholder="0.00">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Reference:</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="reference" value="" class="form-control input-roundless" placeholder="Reference">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Description:</label>
                                                <div class="col-lg-9">
                                                    <textarea name="items[0][description]" class="form-control input-roundless banking_item_description" placeholder="Description"></textarea>
                                                </div>
                                            </div>

                                            <?php Template::block('tax_form_fields'); ?>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label"> </label>
                                                <div class="col-lg-9">
                                                    <button type="button" onclick="rg_banking.form_ajax_submit('#banking_card_payment form', false);" class="btn btn-danger"><i class="icon-check"></i> Save</button>
                                                </div>
                                            </div>

                                        </fieldset>

                                    </form>

                                </div>
                            </div>

                            <div id="banking_owner_drawings" class="txn_form_panel panel panel-flat no-border no-shadow hidden">

                                <div class="panel-heading no-padding-top">
                                    <h4 class="panel-title">Owner Drawings</h4>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a class="hide-sidebar-opposite"><i class="icon-cross2 text-muted text-size-large"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">

                                    <form action="/banking/transactions/<?php echo $bank_account->financial_account_code; ?>/insert/" method="post" class="form-horizontal">

                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                        <input type="hidden" name="submit" value="1" />

                                        <input type="hidden" name="_transaction_id" value="">
                                        <input type="hidden" name="_transaction_status" value="">
                                        <input type="hidden" name="_financial_account_code" value="<?php echo $bank_account->financial_account_code; ?>">
                                        <input type="hidden" name="bank_account_id" value="<?php echo $bank_account->id; ?>">
                                        <input type="hidden" name="txn_entree_id" value="0">
                                        <input type="hidden" name="txn_type_id" value="0">
                                        <input type="hidden" name="credit" value="<?php echo $bank_account->financial_account_code; ?>">
                                        <input type="hidden" name="number" value="NULL">
                                        <input type="hidden" name="base_currency" value="<?php echo $bank_account->currency; ?>">
                                        <input type="hidden" name="quote_currency" value="<?php echo $bank_account->currency; ?>">
                                        <input type="hidden" name="exchange_rate" value="1">
                                        <input type="hidden" name="items[0][type]" value="account">
                                        <input type="hidden" name="items[0][quantity]" value="1">

                                        <fieldset class="">

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">To Account:</label>
                                                <div class="col-lg-9">
                                                    <select name="_debit_type_id" data-placeholder="To Account" class="select-search">
                                                        <option value=""></option>
                                                        <optgroup label="Equity Accounts">
                                                            <?php foreach ($accounts['equity'] as $account) { ?>
                                                                <option value="<?php echo $account->code; ?>"><?php echo $account->name; ?></option>
                                                            <?php } ?>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Date: </label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="date_time" value="" class="form-control input-roundless daterange-single" placeholder="Choose date">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Amount: </label>
                                                <div class="col-lg-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon label-roundless text-semibold"><?php echo $current_client->base_currency; ?></span>
                                                        <input type="text" name="items[0][rate]" value="" class="form-control input-roundless banking_item_rate text-semibold" placeholder="0.00">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Reference:</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="reference" value="" class="form-control input-roundless" placeholder="Reference">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Description:</label>
                                                <div class="col-lg-9">
                                                    <textarea name="items[0][description]" class="form-control input-roundless banking_item_description" placeholder="Description"></textarea>
                                                </div>
                                            </div>

                                            <?php Template::block('tax_form_fields'); ?>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label"> </label>
                                                <div class="col-lg-9">
                                                    <button type="button" onclick="rg_banking.form_ajax_submit('#banking_owner_drawings form', false);" class="btn btn-danger"><i class="icon-check"></i> Save</button>
                                                </div>
                                            </div>

                                        </fieldset>

                                    </form>

                                </div>
                            </div>

                            <div id="banking_credit_note_refund" class="txn_form_panel panel panel-flat no-border no-shadow hidden">

                                <div class="panel-heading no-padding-top">
                                    <h4 class="panel-title">Credit Note Refund</h4>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a class="hide-sidebar-opposite"><i class="icon-cross2 text-muted text-size-large"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">

                                    <form action="/banking/transactions/<?php echo $bank_account->financial_account_code; ?>/insert/" method="post" class="form-horizontal">

                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                        <input type="hidden" name="submit" value="1" />

                                        <input type="hidden" name="_transaction_id" value="">
                                        <input type="hidden" name="_transaction_status" value="">
                                        <input type="hidden" name="_financial_account_code" value="<?php echo $bank_account->financial_account_code; ?>">
                                        <input type="hidden" name="bank_account_id" value="<?php echo $bank_account->id; ?>">
                                        <input type="hidden" name="txn_entree_id" value="0">
                                        <input type="hidden" name="txn_type_id" value="0">
                                        <input type="hidden" name="debit" value="<?php echo 2; //Sales Revenue ?>">
                                        <input type="hidden" name="credit" value="<?php echo $bank_account->financial_account_code; ?>">
                                        <input type="hidden" name="number" value="NULL">
                                        <input type="hidden" name="base_currency" value="<?php echo $bank_account->currency; ?>">
                                        <input type="hidden" name="quote_currency" value="<?php echo $bank_account->currency; ?>">
                                        <input type="hidden" name="exchange_rate" value="1">
                                        <input type="hidden" name="items[0][type]" value="">
                                        <input type="hidden" name="items[0][type_id]" value="">
                                        <input type="hidden" name="items[0][quantity]" value="1">

                                        <fieldset class="">

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Supplier:</label>
                                                <div class="col-lg-9">
                                                    <select name="contact_id" data-placeholder="Select supplier" class="select-search">
                                                        <option value=""></option>
                                                        <?php foreach ($contacts['supplier'] as $contact) { ?>
                                                            <option value="<?php echo $contact->id; ?>"><?php echo $contact->name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Date:</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="date_time" value="" class="form-control input-roundless daterange-single" placeholder="Choose date">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Received via:</label>
                                                <div class="col-lg-9">
                                                    <select name="payment_mode" data-placeholder="Received Via" class="select-search">
                                                        <option value=""></option>
                                                        <?php foreach ($payment_modes as $payment_mode) { ?>
                                                            <option value="<?php echo $payment_mode->name; ?>"><?php echo $payment_mode->name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Reference:</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="reference" value="" class="form-control input-roundless" placeholder="Reference">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Description :</label>
                                                <div class="col-lg-9">
                                                    <textarea name="items[0][description]" class="form-control input-roundless banking_item_description" placeholder="Description"></textarea>
                                                </div>
                                            </div>

                                            <?php Template::block('tax_form_fields'); ?>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label"> </label>
                                                <div class="col-lg-9">
                                                    <button type="button" onclick="rg_banking.form_ajax_submit('#banking_credit_note_refund form', false);" class="btn btn-danger"><i class="icon-check"></i> Save</button>
                                                </div>
                                            </div>

                                        </fieldset>

                                    </form>

                                </div>
                            </div>

                            <div id="banking_payment_refund" class="txn_form_panel panel panel-flat no-border no-shadow hidden">

                                <div class="panel-heading no-padding-top">
                                    <h4 class="panel-title">Payment Refund</h4>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a class="hide-sidebar-opposite"><i class="icon-cross2 text-muted text-size-large"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">

                                    <form action="/banking/transactions/<?php echo $bank_account->financial_account_code; ?>/insert/" method="post" class="form-horizontal">

                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                        <input type="hidden" name="submit" value="1" />

                                        <input type="hidden" name="_transaction_id" value="">
                                        <input type="hidden" name="_transaction_status" value="">
                                        <input type="hidden" name="_financial_account_code" value="<?php echo $bank_account->financial_account_code; ?>">
                                        <input type="hidden" name="bank_account_id" value="<?php echo $bank_account->id; ?>">
                                        <input type="hidden" name="txn_entree_id" value="0">
                                        <input type="hidden" name="txn_type_id" value="0">
                                        <input type="hidden" name="debit" value="<?php echo 1; //Receivables (Customers) ?>">
                                        <input type="hidden" name="credit" value="<?php echo $bank_account->financial_account_code; ?>">
                                        <input type="hidden" name="number" value="NULL">
                                        <input type="hidden" name="base_currency" value="<?php echo $bank_account->currency; ?>">
                                        <input type="hidden" name="quote_currency" value="<?php echo $bank_account->currency; ?>">
                                        <input type="hidden" name="exchange_rate" value="1">
                                        <input type="hidden" name="items[0][type]" value="">
                                        <input type="hidden" name="items[0][type_id]" value="">
                                        <input type="hidden" name="items[0][quantity]" value="1">

                                        <fieldset class="">

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Customer:</label>
                                                <div class="col-lg-9">
                                                    <select name="contact_id" data-placeholder="Select Customer" class="select-search">
                                                        <option value=""></option>
                                                        <?php foreach ($contacts['customer'] as $contact) { ?>
                                                            <option value="<?php echo $contact->id; ?>"><?php echo $contact->name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Date:</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="date_time" value="" class="form-control input-roundless daterange-single" placeholder="Choose date">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Paid via:</label>
                                                <div class="col-lg-9">
                                                    <select name="payment_mode" data-placeholder="Paid Via" class="select-search">
                                                        <option value=""></option>
                                                        <?php foreach ($payment_modes as $payment_mode) { ?>
                                                            <option value="<?php echo $payment_mode->name; ?>"><?php echo $payment_mode->name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Reference:</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="reference" value="" class="form-control input-roundless" placeholder="Reference">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Description:</label>
                                                <div class="col-lg-9">
                                                    <textarea name="items[0][description]" class="form-control input-roundless banking_item_description" placeholder="Description"></textarea>
                                                </div>
                                            </div>

                                            <?php Template::block('tax_form_fields'); ?>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label"> </label>
                                                <div class="col-lg-9">
                                                    <button type="button" onclick="rg_banking.form_ajax_submit('#banking_payment_refund form', false);" class="btn btn-danger"><i class="icon-check"></i> Save</button>
                                                </div>
                                            </div>

                                        </fieldset>

                                    </form>

                                </div>
                            </div>

                            <!-- MONEY IN -->
                            <div id="banking_customer_advance" class="txn_form_panel panel panel-flat no-border no-shadow hidden">

                                <div class="panel-heading no-padding-top">
                                    <h4 class="panel-title">Customer Advance</h4>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a class="hide-sidebar-opposite"><i class="icon-cross2 text-muted text-size-large"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">

                                    <form action="/banking/transactions/<?php echo $bank_account->financial_account_code; ?>/insert/" method="post" class="form-horizontal">

                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                        <input type="hidden" name="submit" value="1" />

                                        <input type="hidden" name="_transaction_id" value="">
                                        <input type="hidden" name="_transaction_status" value="">
                                        <input type="hidden" name="_financial_account_code" value="<?php echo $bank_account->financial_account_code; ?>">
                                        <input type="hidden" name="bank_account_id" value="<?php echo $bank_account->id; ?>">
                                        <input type="hidden" name="txn_entree_id" value="receipt">
                                        <input type="hidden" name="debit" value="<?php echo $bank_account->financial_account_code; ?>">
                                        <input type="hidden" name="number" value="NULL">
                                        <input type="hidden" name="base_currency" value="<?php echo $bank_account->currency; ?>">
                                        <input type="hidden" name="quote_currency" value="<?php echo $bank_account->currency; ?>">
                                        <input type="hidden" name="exchange_rate" value="1">
                                        <input type="hidden" name="items[0][type]" value="">
                                        <input type="hidden" name="items[0][type_id]" value="">
                                        <input type="hidden" name="items[0][quantity]" value="1">

                                        <fieldset class="">

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Customer:</label>
                                                <div class="col-lg-9">
                                                    <select name="contact_id" data-placeholder="Select Customer" class="select-search">
                                                        <option value=""></option>
                                                        <?php foreach ($contacts['customer'] as $contact) { ?>
                                                            <option value="<?php echo $contact->id; ?>"><?php echo $contact->name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Amount:</label>
                                                <div class="col-lg-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon label-roundless text-semibold"><?php echo $current_client->base_currency; ?></span>
                                                        <input type="text" name="items[0][rate]" value="" class="form-control input-roundless banking_item_rate text-semibold" placeholder="0.00">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Date:</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="date_time" value="" class="form-control input-roundless daterange-single" placeholder="Choose date">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Received via:</label>
                                                <div class="col-lg-9">
                                                    <select name="payment_mode" data-placeholder="Received Via" class="select-search">
                                                        <option value=""></option>
                                                        <?php foreach ($payment_modes as $payment_mode) { ?>
                                                            <option value="<?php echo $payment_mode->name; ?>"><?php echo $payment_mode->name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Reference:</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="reference" value="" class="form-control input-roundless" placeholder="Reference">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Description:</label>
                                                <div class="col-lg-9">
                                                    <textarea name="items[0][description]" class="form-control input-roundless banking_item_description" placeholder="Description"></textarea>
                                                </div>
                                            </div>

                                            <?php Template::block('tax_form_fields'); ?>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label"> </label>
                                                <div class="col-lg-9">
                                                    <button type="button" onclick="rg_banking.form_ajax_submit('#banking_customer_advance form', false);" class="btn btn-danger"><i class="icon-check"></i> Save</button>
                                                </div>
                                            </div>

                                        </fieldset>

                                    </form>

                                </div>
                            </div>

                            <div id="banking_customer_payment" class="txn_form_panel panel panel-flat no-border no-shadow hidden">

                                <div class="panel-heading no-padding-top">
                                    <h4 class="panel-title">Customer Payment</h4>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a class="hide-sidebar-opposite"><i class="icon-cross2 text-muted text-size-large"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">

                                    <form action="/banking/transactions/<?php echo $bank_account->financial_account_code; ?>/insert/" method="post" class="form-horizontal">

                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                        <input type="hidden" name="submit" value="1" />

                                        <input type="hidden" name="_transaction_id" value="">
                                        <input type="hidden" name="_transaction_status" value="">
                                        <input type="hidden" name="_financial_account_code" value="<?php echo $bank_account->financial_account_code; ?>">
                                        <input type="hidden" name="bank_account_id" value="<?php echo $bank_account->id; ?>">
                                        <input type="hidden" name="txn_entree_id" value="receipt">
                                        <input type="hidden" name="debit" value="<?php echo $bank_account->financial_account_code; ?>">
                                        <input type="hidden" name="number" value="NULL">
                                        <input type="hidden" name="base_currency" value="<?php echo $bank_account->currency; ?>">
                                        <input type="hidden" name="quote_currency" value="<?php echo $bank_account->currency; ?>">
                                        <input type="hidden" name="exchange_rate" value="1">
                                        <input type="hidden" name="items[0][type]" value="">
                                        <input type="hidden" name="items[0][type_id]" value="">
                                        <input type="hidden" name="items[0][quantity]" value="1">

                                        <fieldset class="">

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Customer:</label>
                                                <div class="col-lg-9">
                                                    <select name="contact_id" data-placeholder="Select Customer" class="select-search">
                                                        <option value=""></option>
                                                        <?php foreach ($contacts['customer'] as $contact) { ?>
                                                            <option value="<?php echo $contact->id; ?>"><?php echo $contact->name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Amount:</label>
                                                <div class="col-lg-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon label-roundless text-semibold"><?php echo $current_client->base_currency; ?></span>
                                                        <input type="text" name="items[0][rate]" value="" class="form-control input-roundless banking_item_rate text-semibold" placeholder="0.00">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Date:</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="date_time" value="" class="form-control input-roundless daterange-single" placeholder="Choose date">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Received Via:</label>
                                                <div class="col-lg-9">
                                                    <select name="payment_mode" data-placeholder="Received Via" class="select-search">
                                                        <option value=""></option>
                                                        <?php foreach ($payment_modes as $payment_mode) { ?>
                                                            <option value="<?php echo $payment_mode->name; ?>"><?php echo $payment_mode->name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Reference:</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="reference" value="" class="form-control input-roundless" placeholder="Reference">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Description :</label>
                                                <div class="col-lg-9">
                                                    <textarea name="items[0][description]" class="form-control input-roundless banking_item_description" placeholder="Description"></textarea>
                                                </div>
                                            </div>

                                            <?php Template::block('tax_form_fields'); ?>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label"> </label>
                                                <div class="col-lg-9">
                                                    <button type="button" onclick="rg_banking.form_ajax_submit('#banking_customer_payment form', false);" class="btn btn-danger"><i class="icon-check"></i> Save</button>
                                                </div>
                                            </div>

                                        </fieldset>

                                    </form>

                                </div>
                            </div>

                            <div id="banking_retainer_payment" class="txn_form_panel panel panel-flat no-border no-shadow hidden">

                                <div class="panel-heading no-padding-top">
                                    <h4 class="panel-title">Retainer Payment</h4>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a class="hide-sidebar-opposite"><i class="icon-cross2 text-muted text-size-large"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">

                                    <form action="/banking/transactions/<?php echo $bank_account->financial_account_code; ?>/insert/" method="post" class="form-horizontal">

                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                        <input type="hidden" name="submit" value="1" />

                                        <input type="hidden" name="_transaction_id" value="">
                                        <input type="hidden" name="_transaction_status" value="">
                                        <input type="hidden" name="_financial_account_code" value="<?php echo $bank_account->financial_account_code; ?>">
                                        <input type="hidden" name="bank_account_id" value="<?php echo $bank_account->id; ?>">
                                        <input type="hidden" name="txn_entree_id" value="receipt">
                                        <input type="hidden" name="debit" value="<?php echo $bank_account->financial_account_code; ?>">
                                        <input type="hidden" name="number" value="NULL">
                                        <input type="hidden" name="base_currency" value="<?php echo $bank_account->currency; ?>">
                                        <input type="hidden" name="quote_currency" value="<?php echo $bank_account->currency; ?>">
                                        <input type="hidden" name="exchange_rate" value="1">
                                        <input type="hidden" name="items[0][type]" value="">
                                        <input type="hidden" name="items[0][type_id]" value="">
                                        <input type="hidden" name="items[0][quantity]" value="1">

                                        <fieldset class="">

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Customer:</label>
                                                <div class="col-lg-9">
                                                    <select name="contact_id" data-placeholder="Select Customer" class="select-search">
                                                        <option value=""></option>
                                                        <?php foreach ($contacts['customer'] as $contact) { ?>
                                                            <option value="<?php echo $contact->id; ?>"><?php echo $contact->name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Amount:</label>
                                                <div class="col-lg-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon label-roundless text-semibold"><?php echo $current_client->base_currency; ?></span>
                                                        <input type="text" name="items[0][rate]" value="" class="form-control input-roundless banking_item_rate text-semibold" placeholder="0.00">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Date:</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="date_time" value="" class="form-control input-roundless daterange-single" placeholder="Choose date">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Received Via:</label>
                                                <div class="col-lg-9">
                                                    <select name="payment_mode" data-placeholder="Received Via" class="select-search">
                                                        <option value=""></option>
                                                        <?php foreach ($payment_modes as $payment_mode) { ?>
                                                            <option value="<?php echo $payment_mode->name; ?>"><?php echo $payment_mode->name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Reference:</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="reference" value="" class="form-control input-roundless" placeholder="Reference">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Description :</label>
                                                <div class="col-lg-9">
                                                    <textarea name="items[0][description]" class="form-control input-roundless banking_item_description" placeholder="Description"></textarea>
                                                </div>
                                            </div>

                                            <?php Template::block('tax_form_fields'); ?>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label"> </label>
                                                <div class="col-lg-9">
                                                    <button type="button" onclick="rg_banking.form_ajax_submit('#banking_retainer_payment form', false);" class="btn btn-danger"><i class="icon-check"></i> Save</button>
                                                </div>
                                            </div>

                                        </fieldset>

                                    </form>

                                </div>
                            </div>

                            <div id="banking_sales_without_invoice" class="txn_form_panel panel panel-flat no-border no-shadow hidden">

                                <div class="panel-heading no-padding-top">
                                    <h4 class="panel-title">Sales Without Invoice</h4>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a class="hide-sidebar-opposite"><i class="icon-cross2 text-muted text-size-large"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">

                                    <form action="/banking/transactions/<?php echo $bank_account->financial_account_code; ?>/insert/" method="post" class="form-horizontal">

                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                        <input type="hidden" name="submit" value="1" />

                                        <input type="hidden" name="_transaction_id" value="">
                                        <input type="hidden" name="_transaction_status" value="">
                                        <input type="hidden" name="_financial_account_code" value="<?php echo $bank_account->financial_account_code; ?>">
                                        <input type="hidden" name="bank_account_id" value="<?php echo $bank_account->id; ?>">
                                        <input type="hidden" name="txn_entree_id" value="0">
                                        <input type="hidden" name="txn_type_id" value="2">
                                        <input type="hidden" name="debit" value="<?php echo $bank_account->financial_account_code; ?>">
                                        <input type="hidden" name="number" value="NULL">
                                        <input type="hidden" name="base_currency" value="<?php echo $bank_account->currency; ?>">
                                        <input type="hidden" name="quote_currency" value="<?php echo $bank_account->currency; ?>">
                                        <input type="hidden" name="exchange_rate" value="1">
                                        <input type="hidden" name="items[0][type]" value="account">
                                        <input type="hidden" name="items[0][quantity]" value="1">

                                        <fieldset class="">

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Revenue Account:</label>
                                                <div class="col-lg-9">
                                                    <select name="_credit_type_id" data-placeholder="Revenue Account" class="select-search">
                                                        <option value=""></option>
                                                        <optgroup label="Revenue / Income Accounts">
                                                            <?php foreach ($accounts['income'] as $account) { ?>
                                                                <option value="<?php echo $account->code; ?>"><?php echo $account->name; ?></option>
                                                            <?php } ?>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Customer:</label>
                                                <div class="col-lg-9">
                                                    <select name="contact_id" data-placeholder="Select Customer" class="select-search">
                                                        <option value=""></option>
                                                        <?php foreach ($contacts['customer'] as $contact) { ?>
                                                            <option value="<?php echo $contact->id; ?>"><?php echo $contact->name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Date:</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="date_time" value="" class="form-control input-roundless daterange-single" placeholder="Choose date">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Amount:</label>
                                                <div class="col-lg-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon label-roundless text-semibold"><?php echo $current_client->base_currency; ?></span>
                                                        <input type="text" name="items[0][rate]" value="" class="form-control input-roundless banking_item_rate text-semibold" placeholder="0.00">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Received Via:</label>
                                                <div class="col-lg-9">
                                                    <select name="payment_mode" data-placeholder="Received Via" class="select-search">
                                                        <option value=""></option>
                                                        <?php foreach ($payment_modes as $payment_mode) { ?>
                                                            <option value="<?php echo $payment_mode->name; ?>"><?php echo $payment_mode->name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Reference:</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="reference" value="" class="form-control input-roundless" placeholder="Reference">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Description:</label>
                                                <div class="col-lg-9">
                                                    <textarea name="items[0][description]" class="form-control input-roundless banking_item_description" placeholder="Description"></textarea>
                                                </div>
                                            </div>

                                            <?php Template::block('tax_form_fields'); ?>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label"> </label>
                                                <div class="col-lg-9">
                                                    <button type="button" onclick="rg_banking.form_ajax_submit('#banking_sales_without_invoice form', false);" class="btn btn-danger"><i class="icon-check"></i> Save</button>
                                                </div>
                                            </div>

                                        </fieldset>

                                    </form>

                                </div>
                            </div>

                            <div id="banking_transfer_from_another_account" class="txn_form_panel panel panel-flat no-border no-shadow hidden">

                                <div class="panel-heading no-padding-top">
                                    <h4 class="panel-title">Transfer From Another Account</h4>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a class="hide-sidebar-opposite"><i class="icon-cross2 text-muted text-size-large"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">

                                    <form action="/banking/transactions/<?php echo $bank_account->financial_account_code; ?>/insert/" method="post" class="form-horizontal">

                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                        <input type="hidden" name="submit" value="1" />

                                        <input type="hidden" name="_transaction_id" value="">
                                        <input type="hidden" name="_transaction_status" value="">
                                        <input type="hidden" name="_financial_account_code" value="<?php echo $bank_account->financial_account_code; ?>">
                                        <input type="hidden" name="bank_account_id" value="<?php echo $bank_account->id; ?>">
                                        <input type="hidden" name="txn_entree_id" value="0">
                                        <input type="hidden" name="txn_type_id" value="0">
                                        <input type="hidden" name="debit" value="<?php echo $bank_account->financial_account_code; ?>">
                                        <input type="hidden" name="number" value="NULL">
                                        <input type="hidden" name="base_currency" value="<?php echo $bank_account->currency; ?>">
                                        <input type="hidden" name="quote_currency" value="<?php echo $bank_account->currency; ?>">
                                        <input type="hidden" name="exchange_rate" value="1">
                                        <input type="hidden" name="items[0][type]" value="account">
                                        <input type="hidden" name="items[0][quantity]" value="1">

                                        <fieldset class="">

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Account:</label>
                                                <div class="col-lg-9">
                                                    <select name="_credit_type_id" data-placeholder="Select Account" class="select-search">
                                                        <option value=""></option>
                                                        <optgroup label="Asset Accounts">
                                                            <?php foreach ($accounts['asset'] as $account) { ?>
                                                                <option value="<?php echo $account->code; ?>"><?php echo $account->name; ?></option>
                                                            <?php } ?>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Date:</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="date_time" value="" class="form-control input-roundless daterange-single" placeholder="Choose date">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Amount:</label>
                                                <div class="col-lg-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon label-roundless text-semibold"><?php echo $current_client->base_currency; ?></span>
                                                        <input type="text" name="items[0][rate]" value="" class="form-control input-roundless banking_item_rate text-semibold" placeholder="0.00">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Reference:</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="reference" value="" class="form-control input-roundless" placeholder="Reference">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Description:</label>
                                                <div class="col-lg-9">
                                                    <textarea name="items[0][description]" class="form-control input-roundless banking_item_description" placeholder="Description"></textarea>
                                                </div>
                                            </div>

                                            <?php Template::block('tax_form_fields'); ?>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label"> </label>
                                                <div class="col-lg-9">
                                                    <button type="button" onclick="rg_banking.form_ajax_submit('#banking_transfer_from_another_account form', false);" class="btn btn-danger"><i class="icon-check"></i> Save</button>
                                                </div>
                                            </div>

                                        </fieldset>

                                    </form>

                                </div>
                            </div>

                            <div id="banking_interest_income" class="txn_form_panel panel panel-flat no-border no-shadow hidden">

                                <div class="panel-heading no-padding-top">
                                    <h4 class="panel-title">Interest Income</h4>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a class="hide-sidebar-opposite"><i class="icon-cross2 text-muted text-size-large"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">

                                    <form action="/banking/transactions/<?php echo $bank_account->financial_account_code; ?>/insert/" method="post" class="form-horizontal">

                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                        <input type="hidden" name="submit" value="1" />

                                        <input type="hidden" name="_transaction_id" value="">
                                        <input type="hidden" name="_transaction_status" value="">
                                        <input type="hidden" name="_financial_account_code" value="<?php echo $bank_account->financial_account_code; ?>">
                                        <input type="hidden" name="bank_account_id" value="<?php echo $bank_account->id; ?>">
                                        <input type="hidden" name="txn_entree_id" value="0">
                                        <input type="hidden" name="txn_type_id" value="0">
                                        <input type="hidden" name="debit" value="<?php echo $bank_account->financial_account_code; ?>">
                                        <input type="hidden" name="credit" value="<?php echo 192; //Interest earned from Local source ?>">
                                        <input type="hidden" name="number" value="NULL">
                                        <input type="hidden" name="base_currency" value="<?php echo $bank_account->currency; ?>">
                                        <input type="hidden" name="quote_currency" value="<?php echo $bank_account->currency; ?>">
                                        <input type="hidden" name="exchange_rate" value="1">
                                        <input type="hidden" name="items[0][type]" value="account">
                                        <input type="hidden" name="items[0][type_id]" value="account">
                                        <input type="hidden" name="items[0][quantity]" value="1">

                                        <fieldset class="">

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Date:</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="date_time" value="" class="form-control input-roundless daterange-single" placeholder="Choose date">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Amount:</label>
                                                <div class="col-lg-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon label-roundless text-semibold"><?php echo $current_client->base_currency; ?></span>
                                                        <input type="text" name="items[0][rate]" value="" class="form-control input-roundless banking_item_rate text-semibold" placeholder="0.00">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Reference:</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="reference" value="" class="form-control input-roundless" placeholder="Reference">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Description:</label>
                                                <div class="col-lg-9">
                                                    <textarea name="items[0][description]" class="form-control input-roundless banking_item_description" placeholder="Description"></textarea>
                                                </div>
                                            </div>

                                            <?php Template::block('tax_form_fields'); ?>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label"> </label>
                                                <div class="col-lg-9">
                                                    <button type="button" onclick="rg_banking.form_ajax_submit('#banking_interest_income form', false);" class="btn btn-danger"><i class="icon-check"></i> Save</button>
                                                </div>
                                            </div>

                                        </fieldset>

                                    </form>

                                </div>
                            </div>

                            <div id="banking_other_income" class="txn_form_panel panel panel-flat no-border no-shadow hidden">

                                <div class="panel-heading no-padding-top">
                                    <h4 class="panel-title">Other Income</h4>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a class="hide-sidebar-opposite"><i class="icon-cross2 text-muted text-size-large"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">

                                    <form action="/banking/transactions/<?php echo $bank_account->financial_account_code; ?>/insert/" method="post" class="form-horizontal">

                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                        <input type="hidden" name="submit" value="1" />

                                        <input type="hidden" name="_transaction_id" value="">
                                        <input type="hidden" name="_transaction_status" value="">
                                        <input type="hidden" name="_financial_account_code" value="<?php echo $bank_account->financial_account_code; ?>">
                                        <input type="hidden" name="bank_account_id" value="<?php echo $bank_account->id; ?>">
                                        <input type="hidden" name="txn_entree_id" value="0">
                                        <input type="hidden" name="txn_type_id" value="0">
                                        <input type="hidden" name="debit" value="<?php echo $bank_account->financial_account_code; ?>">
                                        <input type="hidden" name="number" value="NULL">
                                        <input type="hidden" name="base_currency" value="<?php echo $bank_account->currency; ?>">
                                        <input type="hidden" name="quote_currency" value="<?php echo $bank_account->currency; ?>">
                                        <input type="hidden" name="exchange_rate" value="1">
                                        <input type="hidden" name="items[0][type]" value="account">
                                        <input type="hidden" name="items[0][quantity]" value="1">

                                        <fieldset class="">

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">From Account:</label>
                                                <div class="col-lg-9">
                                                    <select name="_credit_type_id" data-placeholder="From Account" class="select-search">
                                                        <option value=""></option>
                                                        <optgroup label="Income / Revenue Accounts">
                                                            <?php foreach ($accounts['income'] as $account) { ?>
                                                                <option value="<?php echo $account->code; ?>"><?php echo $account->name; ?></option>
                                                            <?php } ?>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Date:</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="date_time" value="" class="form-control input-roundless daterange-single" placeholder="Choose date">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Amount:</label>
                                                <div class="col-lg-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon label-roundless text-semibold"><?php echo $current_client->base_currency; ?></span>
                                                        <input type="text" name="items[0][rate]" value="" class="form-control input-roundless banking_item_rate text-semibold" placeholder="0.00">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Received Via:</label>
                                                <div class="col-lg-9">
                                                    <select name="payment_mode" data-placeholder="Received Via" class="select-search">
                                                        <option value=""></option>
                                                        <?php foreach ($payment_modes as $payment_mode) { ?>
                                                            <option value="<?php echo $payment_mode->name; ?>"><?php echo $payment_mode->name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Reference:</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="reference" value="" class="form-control input-roundless" placeholder="Reference">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Description:</label>
                                                <div class="col-lg-9">
                                                    <textarea name="items[0][description]" class="form-control input-roundless banking_item_description" placeholder="Description"></textarea>
                                                </div>
                                            </div>

                                            <?php Template::block('tax_form_fields'); ?>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label"> </label>
                                                <div class="col-lg-9">
                                                    <button type="button" onclick="rg_banking.form_ajax_submit('#banking_other_income form', false);" class="btn btn-danger"><i class="icon-check"></i> Save</button>
                                                </div>
                                            </div>

                                        </fieldset>

                                    </form>

                                </div>
                            </div>

                            <div id="banking_expense_refund" class="txn_form_panel panel panel-flat no-border no-shadow hidden">

                                <div class="panel-heading no-padding-top">
                                    <h4 class="panel-title">Expense Refund</h4>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a class="hide-sidebar-opposite"><i class="icon-cross2 text-muted text-size-large"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">

                                    <form action="/banking/transactions/<?php echo $bank_account->financial_account_code; ?>/insert/" method="post" class="form-horizontal">

                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                        <input type="hidden" name="submit" value="1" />

                                        <input type="hidden" name="_transaction_id" value="">
                                        <input type="hidden" name="_transaction_status" value="">
                                        <input type="hidden" name="_financial_account_code" value="<?php echo $bank_account->financial_account_code; ?>">
                                        <input type="hidden" name="bank_account_id" value="<?php echo $bank_account->id; ?>">
                                        <input type="hidden" name="txn_entree_id" value="0">
                                        <input type="hidden" name="txn_type_id" value="0">
                                        <input type="hidden" name="debit" value="<?php echo $bank_account->financial_account_code; ?>">
                                        <input type="hidden" name="number" value="NULL">
                                        <input type="hidden" name="base_currency" value="<?php echo $bank_account->currency; ?>">
                                        <input type="hidden" name="quote_currency" value="<?php echo $bank_account->currency; ?>">
                                        <input type="hidden" name="exchange_rate" value="1">
                                        <input type="hidden" name="items[0][type]" value="account">
                                        <input type="hidden" name="items[0][quantity]" value="1">

                                        <fieldset class="">

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">From Account:</label>
                                                <div class="col-lg-9">
                                                    <select name="_credit_type_id" data-placeholder="From Account" class="select-search">
                                                        <option value=""></option>
                                                        <optgroup label="Expense Accounts">
                                                            <?php foreach ($accounts['expense'] as $account) { ?>
                                                                <option value="<?php echo $account->code; ?>"><?php echo $account->name; ?></option>
                                                            <?php } ?>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Date:</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="date_time" value="" class="form-control input-roundless daterange-single" placeholder="Choose date">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Amount:</label>
                                                <div class="col-lg-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon label-roundless text-semibold"><?php echo $current_client->base_currency; ?></span>
                                                        <input type="text" name="items[0][rate]" value="" class="form-control input-roundless banking_item_rate text-semibold" placeholder="0.00">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Received via:</label>
                                                <div class="col-lg-9">
                                                    <select name="payment_mode" data-placeholder="Received Via" class="select-search">
                                                        <option value=""></option>
                                                        <?php foreach ($payment_modes as $payment_mode) { ?>
                                                            <option value="<?php echo $payment_mode->name; ?>"><?php echo $payment_mode->name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Reference:</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="reference" value="" class="form-control input-roundless" placeholder="Reference">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Description:</label>
                                                <div class="col-lg-9">
                                                    <textarea name="items[0][description]" class="form-control input-roundless banking_item_description" placeholder="Description"></textarea>
                                                </div>
                                            </div>

                                            <?php Template::block('tax_form_fields'); ?>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label"> </label>
                                                <div class="col-lg-9">
                                                    <button type="button" onclick="rg_banking.form_ajax_submit('#banking_expense_refund form', false);" class="btn btn-danger"><i class="icon-check"></i> Save</button>
                                                </div>
                                            </div>

                                        </fieldset>

                                    </form>

                                </div>
                            </div>

                            <div id="banking_other_deposit" class="txn_form_panel panel panel-flat no-border no-shadow hidden">

                                <div class="panel-heading no-padding-top">
                                    <h4 class="panel-title">Other Deposit</h4>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a class="hide-sidebar-opposite"><i class="icon-cross2 text-muted text-size-large"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">

                                    <form action="/banking/transactions/<?php echo $bank_account->financial_account_code; ?>/insert/" method="post" class="form-horizontal">

                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                        <input type="hidden" name="submit" value="1" />

                                        <input type="hidden" name="_transaction_id" value="">
                                        <input type="hidden" name="_transaction_status" value="">
                                        <input type="hidden" name="_financial_account_code" value="<?php echo $bank_account->financial_account_code; ?>">
                                        <input type="hidden" name="bank_account_id" value="<?php echo $bank_account->id; ?>">
                                        <input type="hidden" name="txn_entree_id" value="0">
                                        <input type="hidden" name="txn_type_id" value="0">
                                        <input type="hidden" name="debit" value="<?php echo $bank_account->financial_account_code; ?>">
                                        <input type="hidden" name="number" value="NULL">
                                        <input type="hidden" name="base_currency" value="<?php echo $bank_account->currency; ?>">
                                        <input type="hidden" name="quote_currency" value="<?php echo $bank_account->currency; ?>">
                                        <input type="hidden" name="exchange_rate" value="1">
                                        <input type="hidden" name="items[0][type]" value="account">
                                        <input type="hidden" name="items[0][quantity]" value="1">

                                        <fieldset class="">

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">From Account:</label>
                                                <div class="col-lg-9">
                                                    <select name="_credit_type_id" data-placeholder="From Account" class="select-search">
                                                        <option value=""></option>
                                                        <?php foreach ($accounts as $type => $value) { ?>
                                                            <optgroup label="<?php echo $type; ?> Accounts">
                                                                <?php foreach ($value as $account) { ?>
                                                                    <option value="<?php echo $account->code; ?>"><?php echo $account->name; ?></option>
                                                                <?php } ?>
                                                            </optgroup>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Date:</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="date_time" value="" class="form-control input-roundless daterange-single" placeholder="Choose date">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Amount:</label>
                                                <div class="col-lg-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon label-roundless text-semibold"><?php echo $current_client->base_currency; ?></span>
                                                        <input type="text" name="items[0][rate]" value="" class="form-control input-roundless banking_item_rate text-semibold" placeholder="0.00">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Received Via:</label>
                                                <div class="col-lg-9">
                                                    <select name="payment_mode" data-placeholder="Received Via" class="select-search">
                                                        <option value=""></option>
                                                        <?php foreach ($payment_modes as $payment_mode) { ?>
                                                            <option value="<?php echo $payment_mode->name; ?>"><?php echo $payment_mode->name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Reference:</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="reference" value="" class="form-control input-roundless" placeholder="Reference">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Description:</label>
                                                <div class="col-lg-9">
                                                    <textarea name="items[0][description]" class="form-control input-roundless banking_item_description" placeholder="Description"></textarea>
                                                </div>
                                            </div>

                                            <?php Template::block('tax_form_fields'); ?>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label"> </label>
                                                <div class="col-lg-9">
                                                    <button type="button" onclick="rg_banking.form_ajax_submit('#banking_other_deposit form', false);" class="btn btn-danger"><i class="icon-check"></i> Save</button>
                                                </div>
                                            </div>

                                        </fieldset>

                                    </form>

                                </div>
                            </div>

                            <div id="banking_owners_contribution" class="txn_form_panel panel panel-flat no-border no-shadow hidden">

                                <div class="panel-heading no-padding-top">
                                    <h4 class="panel-title">Owners Contribution</h4>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a class="hide-sidebar-opposite"><i class="icon-cross2 text-muted text-size-large"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">

                                    <form action="/banking/transactions/<?php echo $bank_account->financial_account_code; ?>/insert/" method="post" class="form-horizontal">

                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                        <input type="hidden" name="submit" value="1" />

                                        <input type="hidden" name="_transaction_id" value="">
                                        <input type="hidden" name="_transaction_status" value="">
                                        <input type="hidden" name="_financial_account_code" value="<?php echo $bank_account->financial_account_code; ?>">
                                        <input type="hidden" name="bank_account_id" value="<?php echo $bank_account->id; ?>">
                                        <input type="hidden" name="txn_entree_id" value="0">
                                        <input type="hidden" name="txn_type_id" value="0">
                                        <input type="hidden" name="debit" value="<?php echo $bank_account->financial_account_code; ?>">
                                        <input type="hidden" name="number" value="NULL">
                                        <input type="hidden" name="base_currency" value="<?php echo $bank_account->currency; ?>">
                                        <input type="hidden" name="quote_currency" value="<?php echo $bank_account->currency; ?>">
                                        <input type="hidden" name="exchange_rate" value="1">
                                        <input type="hidden" name="items[0][type]" value="account">
                                        <input type="hidden" name="items[0][quantity]" value="1">

                                        <fieldset class="">

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">From Account:</label>
                                                <div class="col-lg-9">
                                                    <select name="_credit_type_id" data-placeholder="Account" class="select-search">
                                                        <option value=""></option>
                                                        <optgroup label="Equity Accounts">
                                                            <?php foreach ($accounts['equity'] as $account) { ?>
                                                                <option value="<?php echo $account->code; ?>"><?php echo $account->name; ?></option>
                                                            <?php } ?>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Date:</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="date_time" value="" class="form-control input-roundless daterange-single" placeholder="Choose date">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Amount:</label>
                                                <div class="col-lg-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon label-roundless text-semibold"><?php echo $current_client->base_currency; ?></span>
                                                        <input type="text" name="items[0][rate]" value="" class="form-control input-roundless banking_item_rate text-semibold" placeholder="0.00">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Received Via:</label>
                                                <div class="col-lg-9">
                                                    <select name="payment_mode" data-placeholder="Received Via" class="select-search">
                                                        <option value=""></option>
                                                        <?php foreach ($payment_modes as $payment_mode) { ?>
                                                            <option value="<?php echo $payment_mode->name; ?>"><?php echo $payment_mode->name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Reference:</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="reference" value="" class="form-control input-roundless" placeholder="Reference">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Description:</label>
                                                <div class="col-lg-9">
                                                    <textarea name="items[0][description]" class="form-control input-roundless banking_item_description" placeholder="Description"></textarea>
                                                </div>
                                            </div>

                                            <?php Template::block('tax_form_fields'); ?>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label"> </label>
                                                <div class="col-lg-9">
                                                    <button type="button" onclick="rg_banking.form_ajax_submit('#banking_owners_contribution form', false);" class="btn btn-danger"><i class="icon-check"></i> Save</button>
                                                </div>
                                            </div>

                                        </fieldset>

                                    </form>

                                </div>
                            </div>

                            <div id="banking_supplier_credit_refund" class="txn_form_panel panel panel-flat no-border no-shadow hidden">

                                <div class="panel-heading no-padding-top">
                                    <h4 class="panel-title">Supplier Credit Refund</h4>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a class="hide-sidebar-opposite"><i class="icon-cross2 text-muted text-size-large"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">

                                    <form action="/banking/transactions/<?php echo $bank_account->financial_account_code; ?>/insert/" method="post" class="form-horizontal">

                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                        <input type="hidden" name="submit" value="1" />

                                        <input type="hidden" name="_transaction_id" value="">
                                        <input type="hidden" name="_transaction_status" value="">
                                        <input type="hidden" name="_financial_account_code" value="<?php echo $bank_account->financial_account_code; ?>">
                                        <input type="hidden" name="bank_account_id" value="<?php echo $bank_account->id; ?>">
                                        <input type="hidden" name="txn_entree_id" value="0">
                                        <input type="hidden" name="txn_type_id" value="0">
                                        <input type="hidden" name="debit" value="<?php echo $bank_account->financial_account_code; ?>">
                                        <input type="hidden" name="credit" value="<?php echo 4; //Payables (Supppliers) ?>">
                                        <input type="hidden" name="number" value="NULL">
                                        <input type="hidden" name="base_currency" value="<?php echo $bank_account->currency; ?>">
                                        <input type="hidden" name="quote_currency" value="<?php echo $bank_account->currency; ?>">
                                        <input type="hidden" name="exchange_rate" value="1">
                                        <input type="hidden" name="items[0][type]" value="">
                                        <input type="hidden" name="items[0][type_id]" value="">
                                        <input type="hidden" name="items[0][quantity]" value="1">

                                        <fieldset class="">

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Supplier:</label>
                                                <div class="col-lg-9">
                                                    <select name="contact_id" data-placeholder="Select Supplier" class="select-search">
                                                        <option value=""></option>
                                                        <?php foreach ($contacts['supplier'] as $contact) { ?>
                                                            <option value="<?php echo $contact->id; ?>"><?php echo $contact->name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Date:</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="date_time" value="" class="form-control input-roundless daterange-single" placeholder="Choose date">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Amount:</label>
                                                <div class="col-lg-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon label-roundless text-semibold"><?php echo $current_client->base_currency; ?></span>
                                                        <input type="text" name="items[0][rate]" value="" class="form-control input-roundless banking_item_rate text-semibold" placeholder="0.00">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Received Via:</label>
                                                <div class="col-lg-9">
                                                    <select name="payment_mode" data-placeholder="Received Via" class="select-search">
                                                        <option value=""></option>
                                                        <?php foreach ($payment_modes as $payment_mode) { ?>
                                                            <option value="<?php echo $payment_mode->name; ?>"><?php echo $payment_mode->name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Reference:</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="reference" value="" class="form-control input-roundless" placeholder="Reference">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Description:</label>
                                                <div class="col-lg-9">
                                                    <textarea name="items[0][description]" class="form-control input-roundless banking_item_description" placeholder="Description"></textarea>
                                                </div>
                                            </div>

                                            <?php Template::block('tax_form_fields'); ?>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label"> </label>
                                                <div class="col-lg-9">
                                                    <button type="button" onclick="rg_banking.form_ajax_submit('#banking_supplier_credit_refund form', false);" class="btn btn-danger"><i class="icon-check"></i> Save</button>
                                                </div>
                                            </div>

                                        </fieldset>

                                    </form>

                                </div>
                            </div>

                            <div id="banking_supplier_payment_refund" class="txn_form_panel panel panel-flat no-border no-shadow hidden">

                                <div class="panel-heading no-padding-top">
                                    <h4 class="panel-title">Supplier Payment Refund</h4>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a class="hide-sidebar-opposite"><i class="icon-cross2 text-muted text-size-large"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">

                                    <form action="/banking/transactions/<?php echo $bank_account->financial_account_code; ?>/insert/" method="post" class="form-horizontal">

                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                        <input type="hidden" name="submit" value="1" />

                                        <input type="hidden" name="_transaction_id" value="">
                                        <input type="hidden" name="_transaction_status" value="">
                                        <input type="hidden" name="_financial_account_code" value="<?php echo $bank_account->financial_account_code; ?>">
                                        <input type="hidden" name="bank_account_id" value="<?php echo $bank_account->id; ?>">
                                        <input type="hidden" name="txn_entree_id" value="0">
                                        <input type="hidden" name="txn_type_id" value="0">
                                        <input type="hidden" name="debit" value="<?php echo $bank_account->financial_account_code; ?>">
                                        <input type="hidden" name="credit" value="<?php echo 4; //Payables (Supppliers) ?>">
                                        <input type="hidden" name="number" value="NULL">
                                        <input type="hidden" name="base_currency" value="<?php echo $bank_account->currency; ?>">
                                        <input type="hidden" name="quote_currency" value="<?php echo $bank_account->currency; ?>">
                                        <input type="hidden" name="exchange_rate" value="1">
                                        <input type="hidden" name="items[0][type]" value="">
                                        <input type="hidden" name="items[0][type_id]" value="">
                                        <input type="hidden" name="items[0][quantity]" value="1">

                                        <fieldset class="">

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Supplier:</label>
                                                <div class="col-lg-9">
                                                    <select name="contact_id" data-placeholder="Select Supplier" class="select-search">
                                                        <option value=""></option>
                                                        <?php foreach ($contacts['supplier'] as $contact) { ?>
                                                            <option value="<?php echo $contact->id; ?>"><?php echo $contact->name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Date:</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="date_time" value="" class="form-control input-roundless daterange-single" placeholder="Choose date">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Amount:</label>
                                                <div class="col-lg-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon label-roundless text-semibold"><?php echo $current_client->base_currency; ?></span>
                                                        <input type="text" name="items[0][rate]" value="" class="form-control input-roundless banking_item_rate text-semibold" placeholder="0.00">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Received Via:</label>
                                                <div class="col-lg-9">
                                                    <select name="payment_mode" data-placeholder="Received Via" class="select-search">
                                                        <option value=""></option>
                                                        <?php foreach ($payment_modes as $payment_mode) { ?>
                                                            <option value="<?php echo $payment_mode->name; ?>"><?php echo $payment_mode->name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Reference:</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="reference" value="" class="form-control input-roundless" placeholder="Reference">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Description:</label>
                                                <div class="col-lg-9">
                                                    <textarea name="items[0][description]" class="form-control input-roundless banking_item_description" placeholder="Description"></textarea>
                                                </div>
                                            </div>

                                            <?php Template::block('tax_form_fields'); ?>

                                            <div class="form-group">
                                                <label class="col-lg-3 control-label"> </label>
                                                <div class="col-lg-9">
                                                    <button type="button" onclick="rg_banking.form_ajax_submit('#banking_supplier_payment_refund form', false);" class="btn btn-danger"><i class="icon-check"></i> Save</button>
                                                </div>
                                            </div>

                                        </fieldset>

                                    </form>

                                </div>
                            </div>

                        </div>

                        <div class="tab-pane " id="bottom-tab2">

                            <div class="panel panel-flat no-border no-shadow">

                                <div class="panel-heading no-padding-top">
                                    <h4 class="panel-title pull-left mr-20">Possible Matches</h4>
                                    <h4 class="panel-title pull-left ml-20">
                                        <a href="#" class="text-size-small text-semibold" onclick="$('#transaction_match_filter').toggleClass('hidden');"><i class="icon-filter3"></i> FILTER</a>
                                    </h4>
                                    <div class="heading-elements">
                                        <ul class="icons-list no-margin-top">
                                            <li><a class="hide-sidebar-opposite"><i class="icon-cross2 text-muted text-size-large"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>

                                <div class="panel-body">

                                    <hr class=" no-margin-top">

                                    <div id="transaction_match_filter" class="hidden">

                                        <form action="/banking/transactions/<?php echo $bank_account->financial_account_code; ?>/insert/" method="post" class="form-horizontal">

                                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                            <input type="hidden" name="submit" value="1" />

                                            <input type="hidden" name="_transaction_id" value="">

                                            <fieldset class="">

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Amount Range:</label>
                                                    <div class="col-lg-4">
                                                        <input type="text" name="range[amount][from]" value="" class="form-control input-roundless" placeholder="0">
                                                    </div>
                                                    <label class="col-lg-1 control-label">to</label>
                                                    <div class="col-lg-4">
                                                        <input type="text" name="range[amount][to]" value="" class="form-control input-roundless" placeholder="0">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Date Range:</label>
                                                    <div class="col-lg-4">
                                                        <input type="text" name="range[date][from]" value="" class="form-control input-roundless daterange-single" placeholder="Choose date">
                                                    </div>
                                                    <label class="col-lg-1 control-label">to</label>
                                                    <div class="col-lg-4">
                                                        <input type="text" name="range[date][from]" value="" class="form-control input-roundless daterange-single" placeholder="Choose date">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Contact:</label>
                                                    <div class="col-lg-9">
                                                        <select name="contact_id" data-placeholder="Select Customer, Supplier, Vendor" class="select-search">
                                                            <option value=""></option>
                                                            <optgroup label="Customers">
                                                                <?php foreach ($contacts['supplier'] as $contact) { ?>
                                                                    <option value="<?php echo $contact->id; ?>"><?php echo $contact->name; ?></option>
                                                                <?php } ?>
                                                            </optgroup>
                                                            <optgroup label="Suppliers / Vendors">
                                                            <?php foreach ($contacts['supplier'] as $contact) { ?>
                                                                <option value="<?php echo $contact->id; ?>"><?php echo $contact->name; ?></option>
                                                            <?php } ?>
                                                            </optgroup>
                                                        </select>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Type:</label>
                                                    <div class="col-lg-9">
                                                        <select name="payment_mode" data-placeholder="Transaction Type" class="select-search">
                                                            <option value=""></option>
                                                            <optgroup label="MONEY OUT">
                                                                <option value="#banking_expense">Expense</option>
                                                                <option value="#banking_supplier_advance">Supplier Advance</option>
                                                                <option value="#banking_supplier_payment">Supplier payment</option>
                                                                <option value="#banking_transfer_to_another_account">Transfer To Another Account</option>
                                                                <option value="#banking_sales_return">Sales Return</option>
                                                                <option value="#banking_card_payment">Card Payment</option>
                                                                <option value="#banking_owner_drawings">Owner Drawings</option>
                                                                <option value="#banking_credit_note_refund">Credit Note Refund</option>
                                                                <option value="#banking_payment_refund">Payment Refund</option>
                                                            </optgroup>
                                                            <optgroup label="MONEY IN">
                                                                <option value="#banking_customer_advance">Customer Advance</option>
                                                                <option value="#banking_customer_payment">Customer Payment</option>
                                                                <option value="#banking_retainer_payment">Retainer Payment</option>
                                                                <option value="#banking_sales_without_invoice">Sales Without Invoices</option>
                                                                <option value="#banking_transfer_from_another_account">Transfer From Another Account</option>
                                                                <option value="#banking_interest_income">Interest Income</option>
                                                                <option value="#banking_other_income">Other Income</option>
                                                                <option value="#banking_expense_refund">Expense Refund</option>
                                                                <option value="#banking_other_deposit">Other Deposit</option>
                                                                <option value="#banking_owners_contribution">Owner's Contribution</option>
                                                                <option value="#banking_supplier_credit_refund">Supplier Credit Refund</option>
                                                                <option value="#banking_supplier_payment_refund">Supplier Payment Refund</option>
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Reference:</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="reference" value="" class="form-control input-roundless" placeholder="Reference">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label"> </label>
                                                    <div class="col-lg-9">
                                                        <button type="button" class="btn btn-danger" onclick="rg_banking.form_ajax_submit('#banking_supplier_payment_refund form', false);"><i class="icon-check"></i> Search</button>
                                                        <button type="button" class="btn btn-default"  onclick="$('#transaction_match_filter').addClass('hidden');"><i class="icon-cross2"></i> Cancel</button>
                                                    </div>
                                                </div>

                                            </fieldset>

                                        </form>

                                        <hr>

                                    </div>


                                    <div class="table-responsive">
                                        <table id="transaction_matches" class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>Best Matches</th>
                                                <th> </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- /opposite sidebar -->



