/**
 * Created by t on 9/9/2017.
 */
rg_banking = function () {

    var datatable_bank_accounts = function() {

        var dtable = $('.rg_datatable').DataTable({
            buttons: {
                dom: {
                    button: {
                        className: 'btn btn-default'
                    }
                },
                buttons: [{
                        extend: 'copyHtml5',
                        className: 'btn btn-default btn-icon',
                        text: '<i class="icon-copy3"></i>'
                    },
                    {
                        extend: 'excelHtml5',
                        className: 'btn btn-default btn-icon',
                        text: '<i class="icon-file-excel"></i>'
                    },
                    {
                        extend: 'pdfHtml5',
                        className: 'btn btn-default btn-icon',
                        text: '<i class="icon-file-pdf"></i>'
                    }
                ]
            },
            ajax: APP_URL + '/datatable/bank_accounts/',
            pagingType: "simple",
            language: {
                paginate: { 'next': 'Next &rarr;', 'previous': '&larr; Prev' }
            },
            iDisplayLength: 20,
            aLengthMenu: [
                [10, 20, 50, 100],
                [10, 20, 50, 100]
            ],
            /*columnDefs: [
                {
                    orderable: false,
                    className: 'select-checkbox',
                    targets: 0
                }
            ],*/
            columnDefs: [{
                    'targets': 0,
                    "orderable": false,
                    'checkboxes': {
                        'selectRow': true,
                        'selectCallback': function(nodes, selected, indeterminate) {
                            //nodes: [Array] List of cell nodes td containing checkboxes.
                            //selected: [Boolean]  Flag indicating whether checkbox has been checked.
                            //indeterminate: [Boolean] Flag indicating whether “Select all” checkbox has indeterminate state.
                            //console.log(nodes);
                            //console.log(selected);

                            var rows_selected = nodes.column(0).checkboxes.selected().length;
                            if (rows_selected > 0) {
                                $('.rg_datatable_onselect_btns').slideDown(100);
                            } else {
                                $('.rg_datatable_onselect_btns').slideUp(100);
                            }
                        }
                    },
                },
                {
                    'targets': [0, 4, 5, 6],
                    "orderable": false
                }
            ],
            select: {
                style: 'multi',
                selector: 'td:first-child'
            },
            order: [
                [0, false]
            ],
            ordering: false,
            //info: false,
            //bLengthChange: false,
            //bFilter: false,
            iDisplayLength: 20,
            aoColumns: [
                { "mDataProp": 'id' },
                { "mDataProp": null, "sClass": "text-center" },
                { "mDataProp": "bank", "sClass": "" },
                { "mDataProp": "name", "sClass": "" },
                { "mDataProp": "number", "sClass": "" },
                { "mDataProp": 'code', "sClass": "text-left" },
                { "mDataProp": 'currency', "sClass": "text-left" },
                { "mDataProp": 'balance', "sClass": "text-right" }
            ],
            fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                var action = '<ul class="icons-list">\
                    <li><a href="/banking/account/' + aData['id'] + '" title="Edit"><i class="icon-pencil7"></i></a></li> \
                </ul>';

                $('td:eq(1)', nRow).html(action);
            }
        });

        $('.navbar-fixed-top').on('click', '.rg_datatable_selected_delete, .rg_datatable_row_delete', function(ev) {

            ev.stopPropagation();
            ev.preventDefault();

            var ids = [];
            var url = (rg_empty($(this).data('url')) ? $(this).attr('href') : $(this).data('url'));

            //console.log(url);

            var rows_selected = dtable.column(0).checkboxes.selected();

            // Iterate over all selected checkboxes
            try {
                $.each(rows_selected, function(index, rowId) {
                    ids[index] = rowId;
                });
            } catch(e) {
                //do nothing
            }

            //console.log(ids);

            rutatiina.transaction_delete({
                datatable: dtable,
                url: url,
                data: { ids: ids },

                onSuccessCallback: function(dtable) {
                    dtable.ajax.reload();
                    $('.rg_datatable_onselect_btns').slideUp(100);
                },
                onFailureCallback: function() {
                    //console.log('this is the failure callback');
                },

                title: "Are you sure?",
                text: "You will not be able to recover this Invoice(s)!",
                type: "warning",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel pls!"
            });

        });

        return dtable;

    }

    var datatable_reconcile = function() {

        var dtable = $('.rg_datatable_reconcile').DataTable({
            pagingType: "simple",
            serverSide: true,
            fixedHeader: true,
            ajax: APP_URL + '/datatable/banking_reconciliations/',
            language: {
                paginate: { 'next': 'Next &rarr;', 'previous': '&larr; Prev' }
            },
            iDisplayLength: 50,
            aLengthMenu: [
                [10, 20, 50, 100, 150, 200, 250, 300, 350, 400],
                [10, 20, 50, 100, 150, 200, 250, 300, 350, 400]
            ],
            columnDefs: [
                {
                    'targets': 0,
                    "orderable": true,
                    'checkboxes': {
                        'selectRow': true,
                        'selectCallback': function(nodes, selected, indeterminate) {
                            //nodes: [Array] List of cell nodes td containing checkboxes.
                            //selected: [Boolean]  Flag indicating whether checkbox has been checked.
                            //indeterminate: [Boolean] Flag indicating whether “Select all” checkbox has indeterminate state.
                            //console.log(nodes);
                            //console.log(selected);

                            var rows_selected = nodes.column(0).checkboxes.selected().length;

                        }
                    },
                },
                /*{
                    'targets': [4, 5, 6],
                    "orderable": false
                }*/
            ],
            select: {
                style: 'multi',
                selector: 'td:first-child'
            },
            aaSorting: [[0, 'asc']],
            order: [
                [0, 'asc']
            ],
            ordering: true,
            info: true,
            bLengthChange: true,
            //bFilter: false,
            aoColumns: [
                { "mDataProp": "id", "sClass": "" },
                { "mDataProp": null, "sClass": "" },
                //{ "mDataProp": "status", "sClass": "" },
                { "mDataProp": "date", "sClass": "" },
                { "mDataProp": "value_date", "sClass": "" },
                { "mDataProp": "description", "sClass": "" },
                { "mDataProp": "reference", "sClass": "" },
                { "mDataProp": "debit", "sClass": "text-right" },
                { "mDataProp": "credit", "sClass": "text-right" },
                { "mDataProp": "balance", "sClass": "text-right" },
            ],
            fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                $('td:eq(1)', nRow).html(
                    '<ul class="icons-list">' +
                        '<li><a href="#/'+aData['id']+'" class="accouting_add" title="Add transaction"><i class="icon-file-plus"></i></a></li>' +
                        '<li><a href="#/'+aData['id']+'" title="Search for transaction"><i class="icon-search4"></i></a></li>' +
                        '<li><a href="#/'+aData['id']+'" title="Re-auto reconsile"><i class="icon-loop3"></i></a></li>' +
                    '</ul> '
                );

                aData['_debit']      = (aData['debit'] > 0 ? rg_number_format(aData['debit'], rg_decimal_places) + ' ' + aData['currency'] : ' - ');
                aData['_credit']     = (aData['credit'] > 0 ? rg_number_format(aData['credit'], rg_decimal_places) + ' ' + aData['currency'] : ' - ');
                aData['_balance']    = (aData['balance'] > 0 ? rg_number_format(aData['balance'], rg_decimal_places) + ' ' + aData['currency'] : ' - ');

                $('td:eq(6)', nRow).html(aData['_debit']);
                $('td:eq(7)', nRow).html(aData['_credit']);
                $('td:eq(8)', nRow).html(aData['_balance']);
            }
        });

        $('body').delegate('.accouting_add', 'click', function() {
            $("#modal_accouting_add").modal()
        });

        return dtable;

    }

    var datatable_transactions = function() {

        var dtable = $('.rg_datatable_transactions').DataTable({
            pagingType: "simple",
            processing: true,
            serverSide: true,
            fixedHeader: true,
            ajax: APP_URL + '/datatable/empty/',
            deferLoading: 0, //This will delay the loading of data until a filter, sorting action or draw/reload Ajax happens programmatically
            language: {
                paginate: { 'next': 'Next &rarr;', 'previous': '&larr; Prev' }
            },
            iDisplayLength: 25,
            aLengthMenu: [
                [10, 20, 50, 100, 150, 200, 250, 300, 350, 400],
                [10, 20, 50, 100, 150, 200, 250, 300, 350, 400]
            ],
            columnDefs: [
                {
                    'targets': 0,
                    "orderable": false,
                    'checkboxes': {
                        'selectRow': true,
                        'selectCallback': function(nodes, selected, indeterminate) {
                            //nodes: [Array] List of cell nodes td containing checkboxes.
                            //selected: [Boolean]  Flag indicating whether checkbox has been checked.
                            //indeterminate: [Boolean] Flag indicating whether “Select all” checkbox has indeterminate state.
                            //console.log(nodes);
                            //console.log(selected);

                            var rows_selected = nodes.column(0).checkboxes.selected().length;
                            $('#number_of_selected_transactions').html(rows_selected);

                            if (rows_selected > 0) {
                                $('#transactions_nav_exclude').removeClass('hidden');
                                $('#transactions_nav').addClass('hidden');
                            } else {
                                $('#transactions_nav_exclude').addClass('hidden');
                                $('#transactions_nav').removeClass('hidden');
                            }

                        }
                    },
                },
                /*{
                    'targets': [4, 5, 6],
                    "orderable": false
                }*/
            ],
            select: {
                style: 'multi',
                selector: 'td:first-child'
            },
            aaSorting: [[0, 'asc']],
            ordering: false,
            info: true,
            bLengthChange: true,
            //bFilter: false,
            aoColumns: [
                { "mDataProp": "id", "sClass": "" },
                { "mDataProp": "date", "sClass": "pointer" },
                { "mDataProp": "description", "sClass": "pointer" },
                { "mDataProp": "reference", "sClass": "pointer" },
                { "mDataProp": "status", "sClass": "pointer" },
                { "mDataProp": null, "sClass": "pointer text-right" },
                { "mDataProp": null, "sClass": "pointer text-right" },
            ],
            fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {

                aData['_debit']      = (aData['debit_amount'] > 0 ? rg_number_format(aData['debit_amount'], rg_decimal_places) + ' ' + aData['currency'] : ' - ');
                aData['_credit']     = (aData['credit_amount'] > 0 ? rg_number_format(aData['credit_amount'], rg_decimal_places) + ' ' + aData['currency'] : ' - ');
                //aData['_balance']    = (aData['balance'] > 0 ? rg_number_format(aData['balance'], rg_decimal_places) + ' ' + aData['base_currency'] : ' - ');

                $('td:eq(5)', nRow).html(aData['_debit']);
                $('td:eq(6)', nRow).html(aData['_credit']);

                $('td:gt(0)', nRow).click(function() {

                    $('.categorize_manually').removeClass('categorize_manually');

                    if (!rg_empty(aData['status'])) {
                        $('.hide-sidebar-opposite').trigger('click');
                        $('.txn_form_panel form').trigger("reset");
                        $('[name=_transaction_id]').val('');
                        $('[name=_transaction_status]').val('');
                        return false;
                    }

                    //check for any matches
                    $('#transaction_matches tbody').html('');
                    $.ajax({
                        url: '/banking/transactions/'+aData['financial_account_code']+'/matches/',
                        method: 'POST',
                        data: {_transaction_id: aData['id']},
                        dataType: "json",
                        success: function(response, status, xhr, $form) {
                            //console.log('done getting the matches');
                            $('#transaction_matches tbody').html('');
                            var _row = '';

                            $.each(response.transactions, function(index, txn) {
                                _row += '<tr class="banking_transactions_possible_matches">';
                                    _row += '<td>';
                                        _row += '<p>' + txn['txn_type']['name'] +' for ' + txn['base_currency'] + ' <span class="text-semibold">' + rg_number_format(txn['total'], rg_decimal_places) + '</span></p>';
                                        _row += '<span>Date: '+txn['date']+'</span>';
                                    _row += '</td>';
                                    _row += '<td class="text-right">';
                                        _row += '<button type="button" class="btn btn-default banking_transaction_match" data-financial_account_code="' + aData['financial_account_code'] + '" data-bank_transaction="' + aData['id'] + '" data-transaction="'+txn['id']+'"> Match </button>';
                                    _row += '</td>';
                                _row += '</tr>';
                            });

                            $('#transaction_matches tbody').html(_row);
                        }
                    });

                    $(nRow).find('td').addClass('categorize_manually');

                    $('.tabbable [id^=tabs_]').addClass('hidden');
                    $('.tabbable #tabs_selected_transaction').removeClass('hidden');
                    $('.sidebar-opposite').removeClass('hidden');
                    $('.sidebar-opposite .txn_form_panel').addClass('hidden');
                    $('.transactions_tax_form_fields').addClass('hidden');

                    var _amount = 0;

                    if (aData['credit_amount'] > 0) {
                        _amount = aData['credit_amount'];
                        $('#banking_expense, #banking_category_money_out').removeClass('hidden');
                        $('#banking_expense .panel-heading').addClass('hidden');
                        $('[name=banking_category_money_out]').val('#banking_expense').trigger('change');
                    }

                    if (aData['debit_amount'] > 0) {
                        _amount = aData['debit_amount'];
                        $('#banking_other_deposit, #banking_category_money_in').removeClass('hidden');
                        $('#banking_other_deposit .panel-heading').addClass('hidden');
                        $('[name=banking_category_money_in]').val('#banking_other_deposit').trigger('change');
                    }

                    //Auto fill the form fields
                    $('[name=_transaction_id]').val(aData['id']);
                    $('[name=_transaction_status]').val('Categorized');
                    $('[name=date]').val(aData['date']);
                    $('[name=reference]').val(aData['reference']);
                    $('.banking_item_rate').val(_amount).addClass('text-danger').prop("readonly", true);
                    $('.banking_item_description').val(aData['description']);
                });

            },
            /*drawCallback : function(settings) {
                if ($(this).find('tbody tr').length<=1) {
                    //$(this).parent().hide(); console.log('Hide table');
                    $(this).parents('.dataTables_wrapper').hide(); //Hide the datatable  if not data is found
                }
            }*/
        });

        $('body').delegate('.accouting_add', 'click', function() {
            $("#modal_accouting_add").modal()
        });

        $('body').delegate('.banking_txn_sorting', 'click', function() {
            console.log('re drawing the table');
            var _url = $(this).data('ajax');
            dtable.ajax.url(_url).load();
        });

        $('#transactions-btn-exclude').click(function () {

            var ids = [];
            var url = $(this).data('url');
            var financial_account_code = $(this).data('financial-account-code');

            //console.log(url);

            var rows_selected = dtable.column(0).checkboxes.selected();

            // Iterate over all selected checkboxes
            try {
                $.each(rows_selected, function(index, row_id) {
                    ids[index] = row_id;
                });
            } catch(e) {
                //do nothing
            }

            //console.log(ids);

            transaction_exclude({
                datatable: dtable,
                url: url,
                ajax_data: {
                    ids: ids,
                    columns: {status: 'Excluded'},
                    financial_account_code: financial_account_code,
                    _method: 'POST'
                },
                onSuccessCallback: function(dtable) {
                    dtable.ajax.reload();
                    $('.rg_datatable_onselect_btns').slideUp(100);
                },
                onFailureCallback: function() {
                    //console.log('this is the failure callback');
                },

                title: "Are you sure?",
                text: "You want to exclude selected transactions(s)!",
                type: "warning",
                confirmButtonText: "Yes, proceed",
                cancelButtonText: "No, cancel!"
            });

        });

        $('#transactions-btn-delete').click(function () {

            var ids = [];
            var url = $(this).data('url');
            var financial_account_code = $(this).data('financial-account-code');

            //console.log(url);

            var rows_selected = dtable.column(0).checkboxes.selected();

            // Iterate over all selected checkboxes
            try {
                $.each(rows_selected, function(index, row_id) {
                    ids[index] = row_id;
                });
            } catch(e) {
                //do nothing
            }

            //console.log(ids);

            transaction_exclude({
                datatable: dtable,
                url: url,
                ajax_data: {
                    ids: ids,
                    financial_account_code: financial_account_code,
                    _method: 'DELETE'
                },
                onSuccessCallback: function(dtable) {
                    dtable.ajax.reload();
                    $('.rg_datatable_onselect_btns').slideUp(100);
                },
                onFailureCallback: function() {
                    //console.log('this is the failure callback');
                },

                title: "Are you sure?",
                text: "Delete selected transactions(s) from Que!",
                type: "warning",
                confirmButtonText: "Yes, proceed",
                cancelButtonText: "No, cancel!"
            });

        });

        return dtable;

    }

    var transaction_exclude = function( options ) {

        var settings = $.extend({
            url: APP_URL + '/empty-response',
            ajax_data: [],

            onSuccessCallback: function() {},
            onFailureCallback: function() {},

            title: "Are you sure?",
            text: "You will not be able to recover this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#EF5350",
            confirmButtonText: "Yes, proceed",
            cancelButtonText: "No, cancel pls!",
            closeOnConfirm: false,
            closeOnCancel: true,
            showLoaderOnConfirm: true
        }, options );

        //console.log(settings);

        swal({
                title: settings.title,
                text: settings.text,
                type: settings.type,
                showCancelButton: settings.showCancelButton,
                confirmButtonColor: settings.confirmButtonColor,
                confirmButtonText: settings.confirmButtonText,
                cancelButtonText: settings.cancelButtonText,
                closeOnConfirm: settings.closeOnConfirm,
                closeOnCancel: settings.closeOnCancel,
                showLoaderOnConfirm: settings.showLoaderOnConfirm
            },
            function(isConfirm) {
                if (isConfirm) {

                    $.ajax({
                        url: settings.url,
                        method: 'POST',
                        data: settings.ajax_data,
                        dataType: "json",
                        success: function(response, status, xhr, $form) {

                            //console.log('we are here');
                            //console.log(response);

                            //Update the cross dite tocken
                            //form.find('[name=ci_csrf_token]').val(Cookies.get('ci_csrf_token'));

                            if (response.status === true) {
                                swal({
                                    title: "Excluded!",
                                    text: response.message,
                                    confirmButtonColor: "#66BB6A",
                                    type: "success",
                                    timer: 2000
                                });

                                //Redraw the the table
                                //dtable.ajax.reload();
                                $('.rg_datatable_onselect_btns').slideUp(100);

                                settings.onSuccessCallback(settings.datatable);

                            } else {

                                swal({
                                    title: "Failed!",
                                    text: response.message,
                                    confirmButtonColor: "#66BB6A",
                                    type: "error",
                                    timer: 2000
                                });

                                settings.onFailureCallback();

                            }

                        }
                    });

                }
            });

        return true;

    }

    var datatable_transaction_rules = function() {

        var dtable = $('#rg_datatable_banking_transaction_rules').DataTable({
            pagingType: "simple",
            serverSide: true,
            fixedHeader: true,
            //ajax: APP_URL + '/datatable/banking_transaction_rules/',
            language: {
                paginate: { 'next': 'Next &rarr;', 'previous': '&larr; Prev' }
            },
            iDisplayLength: 25,
            aLengthMenu: [
                [10, 20, 50, 100, 150, 200, 250, 300, 350, 400],
                [10, 20, 50, 100, 150, 200, 250, 300, 350, 400]
            ],
            columnDefs: [
                {
                    'targets': 0,
                    "orderable": false,
                    'checkboxes': {
                        'selectRow': true,
                        'selectCallback': function(nodes, selected, indeterminate) {
                            //nodes: [Array] List of cell nodes td containing checkboxes.
                            //selected: [Boolean]  Flag indicating whether checkbox has been checked.
                            //indeterminate: [Boolean] Flag indicating whether “Select all” checkbox has indeterminate state.
                            //console.log(nodes);
                            //console.log(selected);

                            var rows_selected = nodes.column(0).checkboxes.selected().length;

                        }
                    },
                },
                /*{
                    'targets': [4, 5, 6],
                    "orderable": false
                }*/
            ],
            select: {
                style: 'multi',
                selector: 'td:first-child'
            },
            aaSorting: [[0, 'asc']],
            ordering: false,
            info: true,
            bLengthChange: true,
            //bFilter: false,
            aoColumns: [
                { "mDataProp": 'id', "sClass": "" },
                { "mDataProp": 'name', "sClass": "" },
                { "mDataProp": 'apply_to', "sClass": "" },
                { "mDataProp": 'process_as', "sClass": "" },
                { "mDataProp": 'criteria', "sClass": "" },
            ],
            fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                $('td:eq(1)', nRow).html('<a href="#">'+aData['name']+'</a>');

                var criteria = '';
                $.each(aData['criteria'], function(index, value) {
                    criteria += '<div>';
                    criteria += '<span class="label label-default">' + value['column'] + '</span> ';
                    criteria += '<span class="label label-default">' + value['condition'] + '</span> ';
                    criteria += '<span class="text-uppercase">' + value['value'] + '</span> ';
                    criteria += '</div>';
                });

                var options = '';
                options += '<div>';
                $.each(aData['options'], function(index, value) {
                    options += '<span class="label label-primary">' + index + ': ' + value + '</span> ';
                });
                options += '</div>';

                $('td:eq(4)', nRow).html(criteria + options);
            }
        });

        /*
        $('body').delegate('.accouting_add', 'click', function() {
            $("#modal_accouting_add").modal();
        });

        $('body').delegate('.banking_txn_sorting', 'click', function() {
            console.log('re drawing the table');
            var _url = $(this).data('ajax');
            dtable.ajax.url(_url).load();
        });
        */

        return dtable;

    }

    var criteria_add = function() {

        var template = $('#transaction_rule_criteria_fields');

        var key = $('.transaction_rule_criteria_fields').length; //console.log(key);

        var rg_clone = template.clone();

        //remove the item_row_template class
        rg_clone.removeAttr('id');
        rg_clone.removeClass('hidden');
        rg_clone.attr('data-key', 'row_'+key);

        rg_clone.find("select, input").each(function() {
            var _name = $(this).attr("name");
            $(this).attr("name", _name.replace("[_]", '['+key+']'));
        });

        $("#transaction_rule_criteria_add").before(rg_clone);

        rg_clone.find("select").select2({});

    }

    var form_ajax_submit = function (form_id, form_reset) {

        form_reset = typeof form_reset !== 'undefined' ? form_reset : true;

        console.log('Ajax processing form: ' + form_id + ', form_reset: ' + form_reset);

        var form = $(form_id);

        //Prepare the notification
        PNotify.removeAll();
        rg_pnotify = new PNotify(rg_pnotify_options.initiate);

        var data = form.serializeArray();

        $.ajax({
            url: form.attr('action'),
            method: form.attr('method'),
            data: data,
            dataType: "json",
            success: function(response, status, xhr, $form) {

                //Update the cross dite tocken
                //form.find('[name=ci_csrf_token]').val(Cookies.get('ci_csrf_token'));

                if (response.status === true) {

                    rg_pnotify_options.success.text = response.message;
                    rg_pnotify.update(rg_pnotify_options.success);

                    $('.dropdown-title:first').trigger('click'); //triggers redraw of the table

                    account_balance(); //show the new / updated account balance

                    if (form_reset === true) {
                        $('[name=_transaction_id]').val('');
                        form.trigger("reset");
                        form.find(".select-search, .select").val("").trigger('change');
                        $('.hide-sidebar-opposite').trigger('click'); //hide the right sidebar
                    }

                }
                else {

                    rg_pnotify_options.error.text = response.message;
                    rg_pnotify.update(rg_pnotify_options.error);
                }

            }
        });

    }

    var tax_calculation = function(taxable_amount, tax_value, tax_method) {

        //console.log('taxable_amount, tax_value, tax_method');
        //console.log(taxable_amount);
        //console.log(tax_value);
        //console.log(tax_method);

        if (typeof tax_value === 'undefined') return 0;

        tax_value = tax_value.toString();

        if (tax_value.substr(-1, 1) === '%') {

            var tax = tax_value.substr(0, tax_value.length-1);

            if ( isNaN(tax) ) {
                //console.log('tax is not a number');
                //console.log(tax);
                return 0;
            }

            if (tax_method === 'inclusive') {
                return (taxable_amount - (taxable_amount / (1 + (rg_number(tax) / 100)) ) );
            } else {
                return (taxable_amount * (rg_number(tax) / 100));
            }
        }
        else {
            return rg_number(tax_value);
        }

    }

    var account_balance = function() {

        //$('.account_balance').html('4500 UGX');
        var e = $('.account_balance');

        $.ajax({
            url: '/banking/balance/'+e.data('financial_account_code')+'/',
            method: 'POST',
            //data: { _financial_account_code: _this.data('financial_account_code'), _bank_transaction_id: _this.data('bank_transaction'), _transaction_id: _this.data('transaction') },
            dataType: "json",
            success: function(response, status, xhr, $form) {
                //console.log(response);
                if (response.status === true) {
                    e.html(response.message);
                } else {
                    PNotify.removeAll();
                    rg_pnotify = new PNotify(rg_pnotify_options.initiate);
                    rg_pnotify_options.error.text = response.message;
                    rg_pnotify.update(rg_pnotify_options.error);
                }
            }
        });

    }

    var init = function () {

        var jQ_body = $('body');

        //account_balance(); //displayed onload of page

        $('.bank_transaction li a').click(function (ev) {

            //ev.stopPropagation();
            ev.preventDefault();

            //Hide all the tabs
            $('.tabbable [id^=tabs_]').addClass('hidden');
            $('.tabbable #tabs_add_transaction').removeClass('hidden');
            $('.sidebar-opposite').removeClass('hidden');
            $('.sidebar-opposite .txn_form_panel').addClass('hidden');
            $($(this).data('panel')).removeClass('hidden');
            $($(this).data('panel')).find('.panel-heading').removeClass('hidden');
            $($(this).data('panel')).find('form').trigger("reset");
            $('.transactions_tax_form_fields').removeClass('hidden');
            $('#banking_category_money_out, #banking_category_money_in').addClass('hidden');
            $('.banking_item_rate').removeClass('text-danger').prop("readonly", false);
            $('[name=_transaction_id]').val('');
            $('[name=_transaction_status]').val('');
        });

        $('[name=banking_category_money_out], [name=banking_category_money_in]').change(function () {
            $('.txn_form_panel:not(.txn_category_panel)').addClass('hidden');
            $($(this).val()).removeClass('hidden');
            $($(this).val()).find('.panel-heading').addClass('hidden');
        });

        $('.hide-sidebar-opposite').click(function () {
            $('.sidebar-opposite').addClass('hidden');
            $('.sidebar-opposite .txn_form_panel').addClass('hidden');
        });

        $('.import_from_desktop').click(function () {
            console.log('Choose file to import');
            $('#file_to_import').click();
        });

        /*document.getElementById('file_to_import').onchange = function () {
            $('#file_to_import_name').html(this.value);
        };*/

        $('#transaction_rule_form [name=apply_to]').click(function() {
            var _this = $(this);
            $('#transaction_rule_deposit_process_as_row, #transaction_rule_withdraw_process_as_row').addClass('hidden');
            if(_this.is(':checked')) {
                $('#transaction_rule_'+_this.val()+'_process_as_row').removeClass('hidden');
            }
        });

        $('#file_to_import').change(function () {
            var n = $(this).val();
            n = n.replace(/.*[\/\\]/, '');
            $('#file_to_import_name').html(n);
        });

        jQ_body.delegate('#transaction_rule_deposit_process_as_field, #transaction_rule_withdraw_process_as_field', 'change', function () {
            var v = $(this).val();
            $("._options").addClass('hidden');

            if (rg_empty(v)) {
                $('._options').addClass('hidden');
            } else {
                $('#' + v + '_fields').toggleClass('hidden');
            }
        });

        jQ_body.delegate('#transaction_rule_criteria_add a', 'click', function () {
            criteria_add();
        });

        jQ_body.on( "mouseenter", '.banking_transactions_possible_matches button', function() {
            $(this).removeClass('btn-default').addClass('btn-success text-semibold');
        });

        jQ_body.on( "mouseleave", '.banking_transactions_possible_matches button', function() {
            $(this).removeClass('btn-success text-semibold').addClass('btn-default');
        });

        $(".dropdown .dropdown-menu").on('click', 'li a', function(){
            $(this).parents('.dropdown').find('.dropdown-title').html($(this).html()).data('ajax', $(this).data('ajax'));
        });

        jQ_body.on( "click", 'button.banking_transaction_match', function() {
            var _this = $(this);

            PNotify.removeAll();
            rg_pnotify = new PNotify(rg_pnotify_options.initiate);

            $.ajax({
                url: '/banking/transactions/'+_this.data('financial_account_code')+'/match/',
                method: 'POST',
                data: { _financial_account_code: _this.data('financial_account_code'), _bank_transaction_id: _this.data('bank_transaction'), _transaction_id: _this.data('transaction') },
                dataType: "json",
                success: function(response, status, xhr, $form) {
                    //console.log(response);
                    if (response.status === true) {
                        rg_pnotify_options.success.text = response.message;
                        rg_pnotify.update(rg_pnotify_options.success);
                        $('#transaction_matches tbody').html('');
                        $('.hide-sidebar-opposite').trigger('click'); //hide the right sidebar
                        $('.dropdown-title:first').trigger('click'); //triggers redraw of the table
                    } else {
                        rg_pnotify_options.error.text = response.message;
                        rg_pnotify.update(rg_pnotify_options.error);
                    }
                }
            });

        });

        jQ_body.on( "change keyup", '[name=_tax_id], .banking_item_rate, ._bank_charge_field, ._tax_base_field', function() {
            //console.log('change or keyup');
            var f = $(this).parents('form');
            var tax_base = f.find('._tax_base_field').is(':checked'); //f.find('._tax_base_field').val();
            var a = 0;
            if (tax_base) {
                a = f.find('._bank_charge_field').val();
            } else {
                a = f.find('.banking_item_rate').val();
            }
            //console.log('tax_base: ' + tax_base);
            //console.log(a);
            var v = f.find('[name=_tax_id]').find(':selected').data('value');
            //console.log(v);

            var m = f.find('[name=_tax_id]').find(':selected').data('method');
            //console.log(v);

            var t = tax_calculation(a, v, m);
            if (t > 0) {
                f.find('[name=_tax_amount]').val(rg_number_format(t, rg_decimal_places, '.', ''));
            } else {
                f.find('[name=_tax_amount]').val('');
            }
        });

        //$('[name=_tax_amount]').val('200'); alert('here');

        jQ_body.on('click', '.rg_ajax_bank_account_destroy', function (ev) {

            var _this = $(this);

            ev.stopPropagation();
            ev.preventDefault();

            method = typeof _this.data('method') !== 'undefined' ? _this.data('method') : 'POST';
            _method = typeof _this.data('_method') !== 'undefined' ? _this.data('_method') : 'POST';

            rutatiina.transaction_delete({
                datatable: null,
                url: _this.attr('href'),
                method: method,
                data: {_method: _method},

                onSuccessCallback: function(datatable) {
                    //redirect to banking index
                },
                onFailureCallback: function() {
                    //console.log('this is the failure callback');
                },

                title: "Are you sure?",
                text: "You will not be able to recover this Bank Account!",
                type: "warning",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel pls!"
            });

        });
    }

    return {
        // public functions
        init: function() {

            init();
            criteria_add(); //add the 1st criteria

            try {
                datatable_reconcile();
            } catch (e) {
                console.log(e);
            }

            try {
                datatable_transactions();
            } catch (e) {
                console.log(e);
            }

            try {
                datatable_bank_accounts();
            } catch (e) {
                console.log(e);
            }

            try {
                datatable_transaction_rules();
            } catch (e) {
                console.log(e);
            }

        },

        form_ajax_submit: function(form_id, form_reset) {
            form_ajax_submit(form_id, form_reset);
        }


    };

    }();
    
    jQuery(document).ready(function () {
    
        // Table setup
        // ------------------------------
    
        // Setting datatable defaults
        $.extend($.fn.dataTable.defaults, {
            autoWidth: false,
            columnDefs: [{
                orderable: false,
                width: '100px',
                targets: [5]
            }],
            //dom: '<"datatable-header"fl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
            dom: '<"datatable-scroll-wrap"t><"datatable-footer"ipr>',
            language: {
                search: '<span>Filter:</span> _INPUT_',
                searchPlaceholder: 'Type to filter...',
                lengthMenu: '<span>Show:</span> _MENU_',
                paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
            },
            drawCallback: function() {
                $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
            },
            preDrawCallback: function() {
                $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
            }
        });
    
        rg_banking.init();
    
    });
