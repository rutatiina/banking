<!-- Main content -->
<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header" style="border-bottom: 1px solid #ddd;">
        <div class="page-header-content">
            <div class="page-title clearfix">
                <h1 class="pull-left no-margin text-light">
                    <i class="icon-file-plus position-left"></i> Bank
                    <small>Manage bank</small>
                </h1>

                <div class="pull-right">
                    <button type="button" class="btn btn-danger btn-labeled add_bank"><b><i class="icon-plus22"></i></b> New Bank </button>
                </div>
                
            </div>
        </div>

    </div>
    <!-- /page header -->

    <!-- Content area -->
    <div class="content">

        <div class="row mt-20">

            <div class="panel panel-flat no-border no-shadow">
                <div class="panel-body no-padding">

                    <table id="rg_datatable_banks" class="table datatable-pagination">
                        <thead>
                        <tr>
                            <th class="" width="12"></th>
                            <th>LOGO</th>
                            <th>BANK NAME</th>
                            <th>SWIFT CODE</th>
                            <th>COUNTRY</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                </div>
            </div>

        </div>

    </div>
    <!-- /content area -->

</div>
<!-- /main content -->


<!-- Opposite sidebar -->
<div id="bank_form_sidebar" class="sidebar sidebar-opposite sidebar-default hidden" style="width:550px;">
    <div class="sidebar-content">

        <div class="panel panel-flat no-border no-shadow ">

            <div class="panel-heading">
                <h4 class="panel-title">Add a bank</h4>
            </div>

            <div class="panel-body">

                <form id="bank_form" action="/banking/banks/" method="post" class="form-horizontal">

                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                    <input type="hidden" name="submit" value="1" />
                    <input type="hidden" name="id" value="<?php echo @$bank_account['id']; ?>" />

                    <fieldset class="">

                        <div class="form-group">

                            <label class="col-lg-3 control-label">Bank name:</label>
                            <div class="col-lg-9">
                                <input type="text" name="name" value="<?php echo @$bank_account['name']; ?>" class="form-control input-roundless" placeholder="Bank name">
                            </div>

                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Swift code :</label>
                            <div class="col-lg-9">
                                <input type="text" name="swift_code" value="<?php echo @$bank_account['code']; ?>" class="form-control input-roundless" placeholder="Swift code">
                            </div>

                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Country :</label>
                            <div class="col-lg-9">
                                <select name="country_code" data-placeholder="Select country" class="select-search">
                                    <option></option>
                                    <?php

                                    $countries = config_item('address.countries');

                                    foreach ($countries as $countryIso => $country) {
                                        $selected = ($countryIso == @$current_client->country) ? 'selected' : '';
                                        echo '<option value="'.$countryIso.'" '.$selected.'>'.$country['printable'].'</option>';
                                    }

                                    ?>
                                </select>
                            </div>

                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Login url :</label>
                            <div class="col-lg-9">
                                <input type="text" name="login_url" value="<?php echo @$bank_account['login_url']; ?>" class="form-control input-roundless" placeholder="Login url">
                            </div>

                        </div>

                        <div class="form-group">

                            <label class="col-lg-3 control-label">Description :</label>
                            <div class="col-lg-9">
                                <textarea name="description" class="form-control input-roundless" placeholder="Description"><?php echo @$bank_account['description']; ?></textarea>
                            </div>

                        </div>

                        <div class="form-group">

                            <label class="col-lg-3 control-label">Logo :</label>
                            <div class="col-lg-9">
                                <input type="file" name="file" class="form-control">
                            </div>

                        </div>

                        <div class="form-group">

                            <label class="col-lg-3 control-label"> </label>
                            <div class="col-lg-9">
                                <button type="button" onclick="rutatiina.form_ajax_submit('#bank_form', false);" class="btn btn-danger"><i class="icon-check"></i>
                                    <?php if (isset($bank_account['id'])) { echo 'Update'; } else { echo 'Save bank'; } ?>
                                </button>
                            </div>

                        </div>

                    </fieldset>

                </form>

            </div>
        </div>

    </div>
</div>
<!-- /opposite sidebar -->



