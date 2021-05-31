<!-- Main content -->
<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header" style="border-bottom: 1px solid #ddd;">
        <div class="page-header-content">
            <div class="page-title clearfix">
                <h1 class="pull-left no-margin text-light">
                    <i class="icon-file-plus position-left"></i> Connet to your bank
                    <!--<small>Manage bank account</small>-->
                </h1>
                
            </div>
        </div>

    </div>
    <!-- /page header -->

    <!-- Content area -->
    <div class="content">

        <div class="row mt-20">
            <div class="col-md-6">
                <div class="panel panel-flat no-border no-shadow ">

                    <div class="panel-body">

                        <form action="/banking/account/" method="post" class=" form-horizontal">

                            <div id="add_bank_step1" class="hidden">

                                <select name="bank_id" class="select-search input-roundless" data-live-search="true" data-placeholder="Select a bank">
                                    <?php

                                    foreach ($banks as $bank) {
                                        echo '<option value="'.$bank['id'].'">'.$bank['name'].' ('.$bank['country_code'].')</option>';
                                    }

                                    ?>
                                </select>

                                <!-- Inline user card -->
                                <div class="panel panel-body no-border no-shadow col-md-4 no-margin-bottom no-padding-bottom">
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="assets/images/placeholder.jpg">
                                                <img src="/themes/a/assets/images/placeholder.jpg" class="img-lg" alt="">
                                            </a>
                                        </div>

                                        <div class="media-body">
                                            <h6 class="media-heading">Bank name</h6>
                                            <span class="text-muted">Country</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- /inline user card -->

                                <!-- Inline user card -->
                                <div class="panel panel-body no-border no-shadow col-md-4 no-margin-bottom no-padding-bottom">
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="assets/images/placeholder.jpg">
                                                <img src="/themes/a/assets/images/placeholder.jpg" class="img-lg" alt="">
                                            </a>
                                        </div>

                                        <div class="media-body">
                                            <h6 class="media-heading">Bank name</h6>
                                            <span class="text-muted">Country</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- /inline user card -->

                                <!-- Inline user card -->
                                <div class="panel panel-body no-border no-shadow col-md-4 no-margin-bottom no-padding-bottom">
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="assets/images/placeholder.jpg">
                                                <img src="/themes/a/assets/images/placeholder.jpg" class="img-lg" alt="">
                                            </a>
                                        </div>

                                        <div class="media-body">
                                            <h6 class="media-heading">Bank name</h6>
                                            <span class="text-muted">Country</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- /inline user card -->

                                <!-- Inline user card -->
                                <div class="panel panel-body no-border no-shadow col-md-4 no-margin-bottom no-padding-bottom">
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="assets/images/placeholder.jpg">
                                                <img src="/themes/a/assets/images/placeholder.jpg" class="img-lg" alt="">
                                            </a>
                                        </div>

                                        <div class="media-body">
                                            <h6 class="media-heading">Bank name</h6>
                                            <span class="text-muted">Country</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- /inline user card -->

                            </div>

                            <div class="clearfix"></div>

                            <div id="add_bank_step2">

                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                <input type="hidden" name="submit" value="1" />
                                <input type="hidden" name="id" value="<?php echo @$bank_account['id']; ?>" />

                                <fieldset class="">

                                    <div class="form-group">

                                        <label class="col-lg-3 control-label"> </label>
                                        <div class="col-lg-7"><h5 class="no-padding no-margin">Bank name</h5></div>

                                    </div>

                                    <div class="form-group">

                                        <label class="col-lg-3 control-label">Login link:</label>
                                        <div class="col-lg-7 pt-10"><a href="">https://maccounts.local/banking/bank_list</a></div>

                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">
                                            User ID :
                                        </label>
                                        <div class="col-lg-7">
                                            <input type="text" name="code" value="" class="form-control input-roundless">
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">
                                            PIN :
                                        </label>
                                        <div class="col-lg-7">
                                            <input type="text" name="number" value="" class="form-control input-roundless">
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">
                                            Veriyfy PIN :
                                        </label>
                                        <div class="col-lg-7">
                                            <input type="text" name="bank" value="" class="form-control input-roundless">
                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <label class="col-lg-3 control-label"> </label>
                                        <div class="col-lg-7">
                                            <button type="button" onclick="$('#add_bank_step1').toggleClass('hidden');$('#add_bank_step2').toggleClass('hidden');" class="btn btn-danger"><i class="icon-arrow-left7"></i> Back</button>
                                            <button type="button" onclick="rutatiina.form_ajax_submit('#bank_account_form', false);" class="btn btn-success"><i class="icon-check"></i>Save account</button>
                                        </div>

                                    </div>

                                </fieldset>

                            </div>

                        </form>

                        <div class="clearfix"></div>
                        <hr>

                        <a href="/banking/account/" type="button" class="btn btn-danger btn-labeled add_bank"><b><i class="icon-plus22"></i></b> New Bank account manually </a>



                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /content area -->

</div>
<!-- /main content -->


