@extends('accounting::layouts.layout_2.LTR.layout_navbar_sidebar_fixed')

@section('title', 'Banking :: Bank Account :: Upload statement')

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
                        Import Statement - Select File
                    </h1>
                    <div class="pull-right">
                        <a href="{{url('banking/accounts/create')}}" type="button" class="btn btn-danger pr-20"><i class="icon-plus22"></i> New Bank Account</a>
                    </div>
                </div>
            </div>

        </div>
        <!-- /page header -->

        <!-- Content area -->
        <div class="content">

            <div class="panel panel-flat no-border no-shadow  col-md-7">

                <div class="panel-body">

                    @include('limitless.basic_alerts')

                    <p>Download a <a href="{{url('import_templates/sample_bankstatement.xlsx')}}">sample file</a> and compare it to your import file to ensure you have the file perfect for the import.</p>

                    <form  action="{{url('banking/accounts/'.$account->code.'/transactions/map-fields')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                        @csrf
                        @method('POST')

                        <input type="hidden" name="submit" value="1" />
                        <input type="hidden" name="financial_account_code" value="{{$account->code}}" />

                        <input type="file" name="file" value="" class="hidden" id="file_to_import" />

                        <fieldset class="content-group">

                            <div class="form-group">
                                <label class="control-label col-md-2">Choose upload file</label>
                                <div class="col-md-10">
                                    <div class="btn-group pull-left">
                                        <button type="button" class="btn bg-danger btn-labeled dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><b><i class="icon-reading"></i></b> Choose file <span class="caret"></span></button>
                                        <ul class="dropdown-menu dropdown-menu-left">
                                            <li><a href="{{url()->current()}}#" class="import_from_desktop"> Choose file from desktop</a></li>
                                            {{--<li><a href="#"><i class="icon-screen-full"></i> Choose file from documents</a></li>--}}
                                        </ul>
                                    </div>
                                    <div class="pull-left pt-10 pl-20" id="file_to_import_name"> No file selected</div>
                                    <div class="clearfix"></div>
                                    <div class="text-muted pt-10"><small>File format: CSV or TSV or OFX or QIF or CAMT.053</small></div>
                                </div>

                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-2">Character Encoding</label>
                                <div class="col-md-4">
                                    <select name="encoding" class="select-search input-roundless">
                                        <option value="UTF-8 (Unicode)">UTF-8 (Unicode)</option>
                                        {{--
                                        <option value="UTF-16 (Unicode)">UTF-16 (Unicode)</option>
                                        <option value="ISO-8859-1">ISO-8859-1</option>
                                        <option value="ISO-8859-2">ISO-8859-2</option>
                                        <option value="ISO-8859-9">ISO-8859-9 (Turkish)</option>
                                        <option value="GB2312">GB2312 (Simplified Chinese)</option>
                                        <option value="Big5">Big5 (Traditional Chinese)</option>
                                        <option value="Shift_JIS">Shift_JIS (Japanese)</option>
                                        --}}
                                    </select>
                                </div>
                            </div>

                            <hr>

                            <div class="form-group">
                                <label class="control-label col-lg-2"> </label>
                                <div class="col-lg-2">
                                    <button type="submit" class="btn btn-success btn-labeled"><b><i class="icon-chevron-right"></i></b> Continue</button>
                                </div>
                            </div>

                        </fieldset>


                    </form>

                </div>


            </div>

            <div class="panel panel-flat no-border no-shadow  col-md-5">

                <div class="panel-body">

                    <div class="import-help">
                        <h5 class="pl-20">Tip / Help</h5>
                        <ul>
                            <li>If you have files in other formats, please convert it to an accepted file format.</li>
                            <li>You can configure your import settings and save them for future too!</li>
                        </ul>
                    </div>

                </div>


            </div>


        </div>
        <!-- /content area -->

    </div>
    <!-- /main content -->
@endsection
