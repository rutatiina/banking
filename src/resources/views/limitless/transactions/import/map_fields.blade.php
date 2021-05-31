@extends('accounting::layouts.layout_2.LTR.layout_navbar_sidebar_fixed')

@section('title', 'Banking :: Bank Account :: Map fields')

@section('bodyClass', 'sidebar-xs sidebar-opposite-visible')

@section('head')
    <script src="{{ mix('/template/limitless/layout_2/LTR/default/assets/mix/banking.js') }}"></script>
@endsection

@section('content')
    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Page header -->
        <div class="page-header" style="border-bottom: 1px solid #ddd;">
            <div class="page-header-content">
                <div class="page-title clearfix">
                    <h1 class="pull-left no-margin text-light">
                        Map fields
                        <small>Map import fields</small>
                    </h1>

                </div>
            </div>

        </div>
        <!-- /page header -->

        <!-- Content area -->
        <div class="content">

            @include('limitless.basic_alerts')

            <div class="row mt-20">
                <div class="col-md-6">
                    <div class="panel panel-flat no-border no-shadow ">

                        <div class="panel-body">

                            <p>File name: <code>{{$statement['file_name']}}</code></p>
                            <p>The auto seleted matches by the system are;</p>

                            <form action="{{url('banking/accounts/'.$financial_account_code.'/transactions/import')}}" method="post" class="form-horizontal mt-20">
                                @csrf
                                @method('POST')

                                <input type="hidden" name="submit" value="1" />
                                <input type="hidden" name="id" value="{{$statement->id}}" />

                                <fieldset class="">

                                    <div class="form-group">
                                        <div class="col-lg-3 text-muted">System fields:</div>
                                        <div class="col-lg-4 text-muted">Imported field headers</div>
                                    </div>

                                    <div class="form-group" title="Transaction effect column i.e. column showing if record is a debit or credit">
                                        <label class="col-lg-3 control-label">Transaction Effect column:</label>
                                        <div class="col-lg-4">
                                            <select name="mapping[effect_column]" class="select input-roundless" >
                                                @foreach ($statement->file_columns as $key => $value)
                                                    <option value="{{$key}}" {{($key == 'X') ? 'selected' : ''}}>{{$value}}</option>
                                                @endforeach
                                                <option value="" selected>None</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Date:</label>
                                        <div class="col-lg-4">
                                            <select name="mapping[date_column]" class="select input-roundless" >
                                                @foreach ($statement->file_columns as $key => $value)
                                                    <option value="{{$key}}" {{($key == '0') ? 'selected' : ''}}>{{$value}}</option>
                                                @endforeach
                                                <option value="">None</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-4">
                                            <select name="mapping[date_format]" class="select input-roundless" >
                                                <option value="yyyy/MM/dd">yyyy/MM/dd</option>
                                                <option value="dd.MM.yy">dd.MM.yy</option>
                                                <option value="MM/dd/yyyy">MM/dd/yyyy</option>
                                                <option value="dd.MM.yyyy">dd.MM.yyyy</option>
                                                <option value="MM.dd.yy">MM.dd.yy</option>
                                                <option value="MM-dd-yyyy">MM-dd-yyyy</option>
                                                <option value="yyyy.MM.dd">yyyy.MM.dd</option>
                                                <option value="dd/MM/yyyy" selected>dd/MM/yyyy</option>
                                                <option value="MM.dd.yyyy">MM.dd.yyyy</option>
                                                <option value="dd-MM-yyyy">dd-MM-yyyy</option>
                                                <option value="dd/MM/yy">dd/MM/yy</option>
                                                <option value="yyyy-MM-dd">yyyy-MM-dd</option>
                                                <option value="MM/dd/yy">MM/dd/yy</option>
                                                <option value="yy.MM.dd">yy.MM.dd</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Description:</label>
                                        <div class="col-lg-4">
                                            <select name="mapping[description_column]" class="select input-roundless" >
                                                @foreach ($statement->file_columns as $key => $value)
                                                    <option value="{{$key}}" {{($key == '4') ? 'selected' : ''}}>{{$value}}</option>
                                                @endforeach
                                                <option value="">None</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Payee:</label>
                                        <div class="col-lg-4">
                                            <select name="mapping[contact_column]" class="select input-roundless" >
                                                @foreach ($statement->file_columns as $key => $value)
                                                    <option value="{{$key}}" {{($key == '3') ? 'selected' : ''}}>{{$value}}</option>
                                                @endforeach
                                                <option value="">None</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Reference Number:</label>
                                        <div class="col-lg-4">
                                            <select name="mapping[reference_column]" class="select input-roundless" >
                                                @foreach ($statement->file_columns as $key => $value)
                                                    <option value="{{$key}}" {{($key == '5') ? 'selected' : ''}}>{{$value}}</option>
                                                @endforeach
                                                <option value="">None</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Withdraws / Credit:</label>
                                        <div class="col-lg-4">
                                            <select name="mapping[credit_column]" class="select input-roundless" >
                                                @foreach ($statement->file_columns as $key => $value)
                                                    <option value="{{$key}}" {{($key == '1') ? 'selected' : ''}}>{{$value}}</option>
                                                @endforeach
                                                <option value="">None</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-4">
                                            <select name="mapping[credit_format]" class="select input-roundless" >
                                                <option value=".|">1234567.89</option>
                                                <option value=".|-">-1234567.89</option>
                                                <option value=".|()">(1234567.89)</option>

                                                <option value=".|">1,234,567.89</option>
                                                <option value=".|-">-1,234,567.89</option>
                                                <option value=".|()">(1,234,567.89)</option>

                                                <option value=".|">1 234 567.89</option>
                                                <option value=".|-">-1 234 567.89</option>
                                                <option value=".|()">(1 234 567.89)</option>

                                                <option value=",|">1234567,89</option>
                                                <option value=",|-">-1234567,89</option>
                                                <option value=",|()">(1234567,89)</option>

                                                <option value=",|">1.234.567,89</option>
                                                <option value=",|-">-1.234.567,89</option>
                                                <option value=",|()">(1.234.567,89)</option>

                                                <option value=",|">1 234 567,89</option>
                                                <option value=",|-">-1 234 567,89</option>
                                                <option value=",|()">(1 234 567,89)</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Deposit / Debit:</label>
                                        <div class="col-lg-4">
                                            <select name="mapping[debit_column]" class="select input-roundless" >
                                                @foreach ($statement['file_columns'] as $key => $value)
                                                    <option value="{{$key}}" {{($key == '2') ? 'selected' : ''}}>{{$value}}</option>
                                                @endforeach
                                                <option value="">None</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-4">
                                            <select name="mapping[debit_format]" class="select input-roundless" >
                                                <option value=".|">1234567.89</option>
                                                <option value=".|-">-1234567.89</option>
                                                <option value=".|()">(1234567.89)</option>

                                                <option value=".|">1,234,567.89</option>
                                                <option value=".|-">-1,234,567.89</option>
                                                <option value=".|()">(1,234,567.89)</option>

                                                <option value=".|">1 234 567.89</option>
                                                <option value=".|-">-1 234 567.89</option>
                                                <option value=".|()">(1 234 567.89)</option>

                                                <option value=",|">1234567,89</option>
                                                <option value=",|-">-1234567,89</option>
                                                <option value=",|()">(1234567,89)</option>

                                                <option value=",|">1.234.567,89</option>
                                                <option value=",|-">-1.234.567,89</option>
                                                <option value=",|()">(1.234.567,89)</option>

                                                <option value=",|">1 234 567,89</option>
                                                <option value=",|-">-1 234 567,89</option>
                                                <option value=",|()">(1 234 567,89)</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-3">
                                            <a href="/banking/transactions/{{$financial_account_code}}/file/" class="btn btn-default"> Previous </a>
                                        </label>
                                        <div class="col-lg-7">
                                            <button type="submit" class="btn btn-success btn-labeled"><b><i class="icon-chevron-right"></i></b> Continue</button>
                                            <a href="/banking/transactions/{{$financial_account_code}}/file/cancel/" class="btn btn-default ml-10"> Cancel </a>
                                        </div>
                                    </div>

                                </fieldset>


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

