<template>

    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Page header -->
        <div class="page-header page-header-light">
            <div class="page-header-content header-elements-md-inline">
                <div class="page-title d-flex">
                    <h4>
                        <i class="icon-library2 mr-1"></i>
                        {{pageTitle}}
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
                            <span class="breadcrumb-item">Banks</span>
                            <span class="breadcrumb-item active">Create</span>
                        </div>

                        <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                    </div>

                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>

                <div class="header-elements">
                    <div class="breadcrumb justify-content-center">
                        <router-link to="/banking/banks" class=" btn btn-danger btn-sm rounded-round font-weight-bold">
                            <i class="icon-library2 mr-1"></i>
                            Banks
                        </router-link>
                    </div>
                </div>

            </div>

        </div>
        <!-- /page header -->

        <!-- Content area -->
        <div class="content border-0 padding-0">

            <!-- Form horizontal -->
            <div class="card shadow-none rounded-0 border-0">

                <div class="card-body p-0">

                    <loading-animation></loading-animation>

                    <form v-if="!this.$root.loading"
                          @submit="formSubmit"
                          action=""
                          method="post"
                          class="max-width-820"
                          style="margin-bottom: 100px;"
                          autocomplete="off">


                        <fieldset class="">

                            <div class="form-group row">

                                <label class="col-lg-2 col-form-label">
                                    Country
                                </label>
                                <div class="col-lg-10">
                                    <model-list-select :list="$root.globalsCountries"
                                                       v-model="attributes.country"
                                                       option-value="value"
                                                       option-text="text"
                                                       placeholder="Select Country">
                                    </model-list-select>
                                </div>

                            </div>

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">
                                    Name
                                </label>
                                <div class="col-lg-10">
                                        <input type="text" v-model="attributes.name" value="" class="form-control " placeholder="Name">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">
                                    Swift code
                                </label>
                                <div class="col-lg-10">
                                    <input type="text" v-model="attributes.swift_code" value="" class="form-control " placeholder="Swift code">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">
                                    Login url
                                </label>
                                <div class="col-lg-10">
                                    <input type="text" v-model="attributes.login_url" value="" class="form-control " placeholder="Login url">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">
                                    Description
                                </label>
                                <div class="col-lg-10">
                                    <input type="text" v-model="attributes.description" value="" class="form-control " placeholder="Description">
                                </div>
                            </div>


                        </fieldset>


                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label"> </label>
                            <div class="col-lg-10">
                                <button type="submit" class="btn btn-danger font-weight-bold">
                                    <i class="icon-library2 mr-1"></i> Create Bank
                                </button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
            <!-- /form horizontal -->


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
                urlPost: '/banking/banks',
                attributes: {},
            }
        },
        mounted() {
            this.$root.appMenu('accounting')
            this.$root.appFetchGlobalsCountries()

            //console.log('NetworkCreate: Component mounted');

            this.fetchAttributes()

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
                            this.attributes = response.data.attributes

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
            formSubmit(e) {

                e.preventDefault();

                let currentObj = this;

                PNotify.removeAll();

                let PNotifySettings = {
                    title: false, //'Processing',
                    text: 'Please wait as we do our thing',
                    addclass: 'bg-warning-400 border-warning-400',
                    hide: false,
                    buttons: {
                        closer: false,
                        sticker: false
                    }
                };

                let notice = new PNotify(PNotifySettings);

                axios.post(currentObj.urlPost, this.attributes)
                    .then(function (response) {

                        //PNotify.removeAll();

                        PNotifySettings.text = response.data.messages.join("\n");

                        if(response.data.status === true) {
                            PNotifySettings.title = 'Success';
                            PNotifySettings.type = 'success';
                            PNotifySettings.addclass = 'bg-success-400 border-success-400';

                            currentObj.attributes = {
                                name: '',
                                code: '',
                                country: '',
                            };

                        } else {
                            PNotifySettings.title = '! Error';
                            PNotifySettings.type = 'error';
                            PNotifySettings.addclass = 'bg-warning-400 border-warning-400';
                        }

                        //let notice = new PNotify(PNotifySettings);
                        notice.update(PNotifySettings);

                        notice.get().click(function() {
                            notice.remove();
                        });

                        //currentObj.response = response.data;
                    })
                    .catch(function (error) {
                        currentObj.response = error;
                    });
            },
        },
        ready:function(){

        },
        beforeUpdate: function () {
            //console.log('beforeUpdate')
        },
        updated: function () {
            //console.log('updated:: dom updated -')

        }
    }
</script>
