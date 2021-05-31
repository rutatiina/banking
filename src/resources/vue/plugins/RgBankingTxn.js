export default {
    methods: {
        async fetchAccountTxnAttributes(data) {

            try {

                this.$root.loadingTxn = true

                return await axios.get('/banking/accounts/'+this.$route.params.id+'/transactions/create', {params: data})
                    .then(response => {
                        this.txnAttributes = response.data
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
        bankingTxnStore(e) {

            //banking/transactions
            //console.log('bankingTxnStore')

            e.preventDefault();

            PNotify.removeAll();

            let PNotifySettings = this.$root.PNotifySettings;

            let notice = new PNotify(PNotifySettings);

            //console.log(Object.assign({}, this.txnAttributes))

            let currentObj = this;

            let formData = this.txnFormData();

            for (let key in currentObj.$refs.filesAttached.files) {
                if (typeof currentObj.$refs.filesAttached.files[key].size !== 'undefined') {
                    //console.log('start: appending file')
                    //console.log(currentObj.$refs.filesAttached.files[key].size)
                    //console.log(currentObj.$refs.filesAttached.files[key])
                    //console.log('end: appending file')
                    formData.append('files[]', currentObj.$refs.filesAttached.files[key]);
                }

            }

            axios.post(
                '/banking/accounts/'+this.$route.params.id+'/transactions', //currentObj.txnUrlStore,
                formData,
                {
                    headers: {'Content-Type': 'multipart/form-data'}
                }
            )
                .then(function (response) {

                    //PNotify.removeAll();
                    //console.log(response.data);
                    //console.log(response.data.callback);

                    PNotifySettings.text = response.data.messages.join("\n");

                    if (response.data.status === true)
                    {
                        PNotifySettings.title = 'Success';
                        PNotifySettings.type = 'success';
                        PNotifySettings.addclass = 'bg-success-400 border-success-400';

                        currentObj.$router.push({ path: '' })

                        notice.update(PNotifySettings);

                        currentObj.$root.rgTableToRefresh = 'bank_account_transactions';
                    }
                    else
                    {
                        PNotifySettings.title = '! Error';
                        PNotifySettings.type = 'error';
                        PNotifySettings.addclass = 'bg-warning-400 border-warning-400';

                        notice.update(PNotifySettings);
                    }

                    notice.get().click(function () {
                        notice.remove();
                    });

                })
                .catch(function (error) {
                    //currentObj.response = error;
                });
        }
    }
}

