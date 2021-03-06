@extends('accounting::layouts.layout_2.LTR.layout_navbar_sidebar_fixed')

@section('title', 'Banking :: Bank Account :: Create')

@section('head')
    {{--<script src="{{ mix('/template/limitless/layout_2/LTR/default/assets/mix/txn.js') }}"></script>--}}
@endsection

@section('content')
    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Page header -->
        <div class="page-header" style="border-bottom: 1px solid #ddd;">
            <div class="page-header-content">
                <div class="page-title clearfix">
                    <h1 class="pull-left no-margin text-light">
                        <i class="icon-file-plus position-left"></i> Bank or Credit / Debit Card
                        <small>Manage bank account</small>
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

                            <form id="bank_account_form" action="{{route('banking.accounts.store')}}" method="post" class="form-horizontal">
                                @csrf
                                @method('POST')

                                <input type="hidden" name="submit" value="1" />

                                <fieldset class="">

                                    <div class="form-group">
                                        <label class="control-label col-sm-3">
                                            Account type:
                                        </label>
                                        <div class="col-sm-7">

                                            <label class="radio-inline">
                                                <input type="radio" name="type" value="bank_account" checked>
                                                Bank
                                            </label>

                                            <label class="radio-inline">
                                                <input type="radio" name="type" value="card">
                                                Credit / Debit Card
                                            </label>

                                        </div>
                                    </div>

                                </fieldset>
                                <fieldset class="">

                                    <div class="form-group">

                                        <label class="col-lg-3 control-label">
                                            Account name:
                                        </label>
                                        <div class="col-lg-7">
                                            <input type="text" name="name" value="" class="form-control input-roundless" placeholder="Account name">
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">
                                            Account code :
                                        </label>
                                        <div class="col-lg-7">
                                            <input type="text" name="code" value="" class="form-control input-roundless" placeholder="Account code">
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">
                                            Currency :
                                        </label>
                                        <div class="col-lg-7">
                                            <select name="currency" class="select-search input-roundless">
                                                @foreach ($currencies as $currency_code => $currency_name)
                                                    @continue($currency_code != 'UGX')
                                                    <option value="{{$currency_code}}" {{ $currency_code == old('currency') ? 'selected' : ''}}>{{$currency_code}} - {{$currency_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">
                                            Account number :
                                        </label>
                                        <div class="col-lg-7">
                                            <input type="text" name="number" value="" class="form-control input-roundless" placeholder="Account number">
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">
                                            Bank name :
                                        </label>
                                        <div class="col-lg-7">
                                            <select name="bank_id" class="select-search input-roundless" data-tags="true" data-allow-clear="true">
                                                @foreach ($banks as $bank)
                                                    <option value="{{$bank->id}}" {{ $bank->id == old('bank_id') ? 'selected' : ''}}>{{$bank->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <label class="col-lg-3 control-label">
                                            Description :
                                        </label>
                                        <div class="col-lg-7">
                                            <textarea name="description" class="form-control input-roundless" placeholder="Description"></textarea>
                                        </div>

                                    </div>


                                    <div class="form-group">
                                        <label class="col-lg-3 control-label"> </label>
                                        <div class="col-lg-7">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="primary" value="1">
                                                    Set as primary Bank account
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                </fieldset>

                                <hr class="">

                                <div class="row text-left">
                                    <label class="col-lg-3 control-label"></label>
                                    <button type="button" onclick="rutatiina.form_ajax_submit('#bank_account_form', false);" class="btn btn-danger"><i class="icon-check"></i>Save Bank Account</button>
                                    <button class="btn btn-default" data-dismiss="modal"><i class="icon-cross"></i> Reset</button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /content area -->

    </div>
    <!-- /main content -->
@endsection

