<template>

    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Page header -->
        <div class="page-header page-header-light">
            <div class="page-header-content header-elements-md-inline">
                <div class="page-title d-flex">
                    <h4>
                        <i class="icon-file-upload mr-2"></i>
                        Upload Statement - Select File
                    </h4>
                </div>
            </div>

            <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                <div class="d-flex">
                    <div class="d-flex">
                        <div class="breadcrumb">
                            <a href="/" class="breadcrumb-item">
                                <i class="icon-home2 mr-2"></i>
                                <span class="badge badge-primary badge-pill font-weight-bold rg-breadcrumb-item-tenant-name"> {{this.$root.tenant.name | truncate(30) }} </span>
                            </a>
                            <span class="breadcrumb-item">Banking</span>
                            <span class="breadcrumb-item">Accounts</span>
                            <span class="breadcrumb-item active">Create</span>
                        </div>

                        <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                    </div>

                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>

                <div class="header-elements">
                    <div class="breadcrumb justify-content-center">
                        <router-link to="/banking" class=" btn btn-danger btn-sm rounded-round font-weight-bold">
                            <i class="icon-library2 mr-1"></i>
                            Bank Accounts
                        </router-link>
                    </div>
                </div>

            </div>

        </div>
        <!-- /page header -->

        <!-- Content area -->
        <div class="content border-0 padding-0">

            <div class="row">
                <div class="col-md-8">

                    <!-- upload file -->
                    <div v-if="uploadFile && !this.$root.loading" class="card shadow-none rounded-0 border-0">

                        <div class="card-body p-0">

                            <loading-animation></loading-animation>

                            <form @submit="formUploadFile"
                                  action="/banking/accounts/transactions/map-fields"
                                  method="post"
                                  enctype="multipart/form-data"
                                  autocomplete="off">

                                <input type="file" name="file" value="" class="d-none" id="file_to_import" />

                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2">Choose files to upload</label>
                                    <div class="col-lg-10">
                                        <input ref="filesAttached" type="file" class="form-control border-0 p-1 h-auto">
                                        <div class="text-muted pl-1"><small>File format: CSV or TSV or OFX or QIF or CAMT.053</small></div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Character Encoding</label>
                                    <div class="col-md-4">
                                        <model-list-select :list="encoding"
                                                           v-model="attributes.encoding"
                                                           option-value="value"
                                                           option-text="text"
                                                           class="form-control"
                                                           placeholder="Select encoding">
                                        </model-list-select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2"> </label>
                                    <div class="col-lg-10">
                                        <button type="submit" class="btn btn-danger btn-labeled btn-labeled-left font-weight-bold">
                                            <b><i class="icon-chevron-right"></i></b> Upload file & Continue</button>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                    <!-- /form horizontal -->

                    <!-- map fields -->
                    <div v-if="mapFields" class="card shadow-none rounded-0 border-0">

                        <div class="card-body p-0">

                            <loading-animation></loading-animation>

                            <form @submit="formMapFile"
                                  action="/banking/accounts/transactions/map-fields"
                                  method="post"
                                  enctype="multipart/form-data"
                                  autocomplete="off">

                                <p>File name: <code>{{statement.file_name}}</code></p>
                                <p>The auto seleted matches by the system are;</p>

                                <div class="form-group row">
                                    <div class="col-lg-3 text-muted">System fields:</div>
                                    <div class="col-lg-4 text-muted">Imported field headers</div>
                                </div>

                                <div class="form-group row" title="Transaction effect column i.e. column showing if record is a debit or credit">
                                    <label class="col-lg-3 col-form-label">Transaction Effect column:</label>
                                    <div class="col-lg-4">
                                        <model-list-select :list="fileColumns"
                                                           v-model="fileMapping.mapping.effect_column"
                                                           option-value="value"
                                                           option-text="text"
                                                           placeholder="Select encoding">
                                        </model-list-select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Date:</label>
                                    <div class="col-lg-4">
                                        <model-list-select :list="fileColumns"
                                                           v-model="fileMapping.mapping.date_column"
                                                           option-value="value"
                                                           option-text="text"
                                                           placeholder="Select encoding">
                                        </model-list-select>
                                    </div>
                                    <div class="col-lg-4">
                                        <model-list-select :list="dateFormat"
                                                           v-model="fileMapping.mapping.date_format"
                                                           option-value="value"
                                                           option-text="text"
                                                           placeholder="Select date format">
                                        </model-list-select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Description:</label>
                                    <div class="col-lg-4">
                                        <model-list-select :list="fileColumns"
                                                           v-model="fileMapping.mapping.description_column"
                                                           option-value="value"
                                                           option-text="text"
                                                           placeholder="Select encoding">
                                        </model-list-select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Payee:</label>
                                    <div class="col-lg-4">
                                        <model-list-select :list="fileColumns"
                                                           v-model="fileMapping.mapping.contact_column"
                                                           option-value="value"
                                                           option-text="text"
                                                           placeholder="Select encoding">
                                        </model-list-select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Reference Number:</label>
                                    <div class="col-lg-4">
                                        <model-list-select :list="fileColumns"
                                                           v-model="fileMapping.mapping.reference_column"
                                                           option-value="value"
                                                           option-text="text"
                                                           placeholder="Select encoding">
                                        </model-list-select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Withdraws / Credit:</label>
                                    <div class="col-lg-4">
                                        <model-list-select :list="fileColumns"
                                                           v-model="fileMapping.mapping.credit_column"
                                                           option-value="value"
                                                           option-text="text"
                                                           placeholder="Select encoding">
                                        </model-list-select>
                                    </div>
                                    <div class="col-lg-4">
                                        <model-list-select :list="numberFormat"
                                                           v-model="fileMapping.mapping.credit_format"
                                                           option-value="value"
                                                           option-text="text"
                                                           placeholder="Select credit format">
                                        </model-list-select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Deposit / Debit:</label>
                                    <div class="col-lg-4">
                                        <model-list-select :list="fileColumns"
                                                           v-model="fileMapping.mapping.debit_column"
                                                           option-value="value"
                                                           option-text="text"
                                                           placeholder="Select encoding">
                                        </model-list-select>
                                    </div>
                                    <div class="col-lg-4">
                                        <model-list-select :list="numberFormat"
                                                           v-model="fileMapping.mapping.debit_format"
                                                           option-value="value"
                                                           option-text="text"
                                                           placeholder="Select debit format">
                                        </model-list-select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"> </label>
                                    <div class="col-lg-7">
                                        <button type="submit" class="btn btn-danger btn-labeled btn-labeled-left font-weight-bold">
                                            <b><i class="icon-chevron-right"></i></b> Map fields Continue
                                        </button>
                                        <a href="/banking/transactions/file/cancel/" class="btn btn-light btn-labeled btn-labeled-left font-weight-bold ml-4">
                                            <b><i class="icon-cancel-circle2"></i></b> Cancel
                                        </a>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                    <!-- /map fields -->

                </div>

                <div class="col-md-3">
                    <div class="card shadow-none rounded-0 border-0">
                        <div class="card-body p-0">
                            <div class="import-help">
                                <h5 class="pl-3">Tip / Help</h5>
                                <ul>
                                    <li>Download a <a href="/import_templates/sample_bankstatement.xlsx">sample file</a> and compare it to your import file to ensure you have the file perfect for the import.</li>
                                    <li>If you have files in other formats, please convert it to an accepted file format.</li>
                                    <li>You can configure your import settings and save them for future too!</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!-- /content area -->

    </div>
    <!-- /main content -->

</template>

<script>

    export default {
        data() {
            return {
                pageTitle: 'Bank Account',
                urlPost: '/banking/accounts',

                uploadFile: true,
                mapFields: false,

                attributes: {
                    encoding: 'UTF-8 (Unicode)',
                    id: this.$route.params.id
                },
                encoding:[
                    {value: 'UTF-8 (Unicode)', text: 'UTF-8 (Unicode)'},
                    /*{value: "UTF-16 (Unicode)", text: "UTF-16 (Unicode)"},
                    {value: "ISO-8859-1", text: "ISO-8859-1"},
                    {value: "ISO-8859-2", text: "ISO-8859-2"},
                    {value: "ISO-8859-9", text: "ISO-8859-9 (Turkish)"},
                    {value: "GB2312", text: "GB2312 (Simplified Chinese)"},
                    {value: "Big5", text: "Big5 (Traditional Chinese)"},
                    {value: "Shift_JIS", text: "Shift_JIS (Japanese)"},*/
                ],

                statement: {},

                fileMapping: {
                    statement_id: null,
                    mapping: {
                        effect_column: '',
                        date_column: null, //'Date',
                        date_format: 'yyyy-MM-dd',
                        description_column: null, //'Description',
                        contact_column: null, //'Payee',
                        reference_column: null, //'Reference Number',
                        credit_column: null, //'Withdrawals',
                        credit_format: '.|',
                        debit_column: null, //'Deposits',
                        debit_format: '.|',
                    }
                },
                dateFormat:[
                    {value: "yyyy/MM/dd", text: "yyyy/MM/dd"},
                    {value: "dd.MM.yy", text: "dd.MM.yy"},
                    {value: "MM/dd/yyyy", text: "MM/dd/yyyy"},
                    {value: "dd.MM.yyyy", text: "dd.MM.yyyy"},
                    {value: "MM.dd.yy", text: "MM.dd.yy"},
                    {value: "MM-dd-yyyy", text: "MM-dd-yyyy"},
                    {value: "yyyy.MM.dd", text: "yyyy.MM.dd"},
                    {value: "dd/MM/yyyy", text: "dd/MM/yyyy"},
                    {value: "MM.dd.yyyy", text: "MM.dd.yyyy"},
                    {value: "dd-MM-yyyy", text: "dd-MM-yyyy"},
                    {value: "dd/MM/yy", text: "dd/MM/yy"},
                    {value: "yyyy-MM-dd", text: "yyyy-MM-dd"},
                    {value: "MM/dd/yy", text: "MM/dd/yy"},
                    {value: "yy.MM.dd", text: "yy.MM.dd"}
                ],
                numberFormat:[
                    {value: ".|", text: "1234567.89"},
                    {value: ".|-", text: "-1234567.89"},
                    {value: ".|()", text: "(1234567.89)"},

                    {value: ".|", text: "1,234,567.89"},
                    {value: ".|-", text: "-1,234,567.89"},
                    {value: ".|()", text: "(1,234,567.89)"},

                    {value: ".|", text: "1 234 567.89"},
                    {value: ".|-", text: "-1 234 567.89"},
                    {value: ".|()", text: "(1 234 567.89)"},

                    {value: ",|", text: "1234567,89"},
                    {value: ",|-", text: "-1234567,89"},
                    {value: ",|()", text: "(1234567,89)"},

                    {value: ",|", text: "1.234.567,89"},
                    {value: ",|-", text: "-1.234.567,89"},
                    {value: ",|()", text: "(1.234.567,89)"},

                    {value: ",|", text: "1 234 567,89"},
                    {value: ",|-", text: "-1 234 567,89"},
                    {value: ",|()", text: "(1 234 567,89)"},
                ],
                fileColumns:[
                    {value: 'Date', text: 'Date'},
                    {value: 'Withdrawals', text: 'Withdrawals'},
                    {value: 'Deposits', text: 'Deposits'},
                    {value: 'Payee', text: 'Payee'},
                    {value: 'Description', text: 'Description'},
                    {value: 'Reference Number', text: 'Reference Number'}
                ],
            }
        },
        mounted() {
            this.$root.appFetchGlobalsCurrencies()
            //this.fetchBanks('-initiate-')
            //this.fetchAttributes()
        },
        watch: {},
        methods: {
            async fetchAttributes() {
                //console.log('fetchAttributes')

                try {

                    return await axios.get(this.$route.fullPath)
                        .then(response => {

                            //this.pageTitle = response.data.pageTitle
                            //this.urlPost = response.data.urlPost
                            //this.attributes = response.data.attributes

                        })
                        .catch(function (error) {
                            // handle error
                            console.log(error); //test
                        })
                        .finally(function (response) {
                            // always executed this is supposed
                        })

                } catch (e) {
                    console.log(e); //test
                }
            },
            async fetchBanks(searchText) {

                if(!searchText) {
                    return false
                }

                searchText = (searchText === '-initiate-') ? '' : searchText

                let data = {
                    search: [
                        {
                            column: 'name',
                            value: searchText
                        }
                    ]
                }

                try {

                    return await axios.post(
                        '/banking/banks/search',
                        data
                    )
                        .then(response => {
                            this.banks = response.data.data
                        })
                        .catch(function (error) {
                            // handle error
                            console.log(error); //test
                        })
                        .finally(function (response) {
                            // always executed this is supposed
                        })

                } catch (e) {
                    console.log(e); //test
                }

            },
            formUploadFile(e) {

                e.preventDefault();

                let formData = new FormData()
                formData.append('file', this.$refs.filesAttached.files[0]);
                formData.append('id', this.attributes.id);
                formData.append('encoding', this.attributes.encoding);

                PNotify.removeAll();

                let PNotifySettings = this.$root.PNotifySettings

                let notice = new PNotify(PNotifySettings);

                axios.post(
                    '/banking/accounts/transactions/import',
                    formData,
                    {
                        headers: {'Content-Type': 'multipart/form-data'}
                    }
                )
                    .then( (response) => {

                        //PNotify.removeAll();

                        PNotifySettings.text = response.data.messages.join("\n");

                        if(response.data.status === true) {
                            PNotifySettings.title = 'Success'
                            PNotifySettings.type = 'success'
                            PNotifySettings.addclass = 'bg-success-400 border-success-400';

                            this.uploadFile = false
                            this.mapFields = true

                            this.fileColumns = response.data.file_columns
                            this.fileMapping.statement_id = response.data.statement.id
                            this.statement = response.data.statement

                        } else {
                            PNotifySettings.title = '! Error'
                            PNotifySettings.type = 'error'
                            PNotifySettings.addclass = 'bg-warning-400 border-warning-400'
                        }

                        notice.update(PNotifySettings)

                        notice.get().click(function() {
                            notice.remove()
                        })
                    })
            },
            formMapFile(e) {

                e.preventDefault()

                PNotify.removeAll()

                let PNotifySettings = this.$root.PNotifySettings

                let notice = new PNotify(PNotifySettings);

                axios.post('/banking/accounts/transactions/map-fields', this.fileMapping)
                    .then( (response) => {

                        PNotifySettings.text = response.data.messages.join("\n");

                        if(response.data.status === true) {

                            PNotifySettings.title = 'Success'
                            PNotifySettings.type = 'success'
                            PNotifySettings.addclass = 'bg-success-400 border-success-400';

                            this.$router.push({ path: '/banking/accounts/'+this.$route.params.id })

                        } else {

                            PNotifySettings.title = '! Error'
                            PNotifySettings.type = 'error'
                            PNotifySettings.addclass = 'bg-warning-400 border-warning-400'

                        }

                        notice.update(PNotifySettings)

                        notice.get().click(function() {
                            notice.remove()
                        })

                    })
            },
        }
    }
</script>
