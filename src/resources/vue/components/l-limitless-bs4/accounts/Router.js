
const Form = () => import('./Form')
const Index = () => import('./Index')
const Show = () => import('./Show')
const SidebarRight = () => import('./SidebarRight')

const TransactionRulesIndex = () => import('./transations/Rules/Index')
const TransactionRulesForm = () => import('./transations/Rules/Form')
const TransactionUpload = () => import('./transations/Upload')

let routes = [

    {
        path: '/banking/accounts/create',
        components: {
            default: Form
        },
        meta: {
            title: 'Banking :: Account create',
            metaTags: [
                {
                    name: 'description',
                    content: 'Banking Account create'
                },
                {
                    property: 'og:description',
                    content: 'Banking Account create'
                }
            ]
        }
    },
    {
        path: '/banking/accounts',
        components: {
            default: Index
        },
        meta: {
            title: 'Banking :: Accounts',
            metaTags: [
                {
                    name: 'description',
                    content: 'Banking Accounts'
                },
                {
                    property: 'og:description',
                    content: 'Banking Accounts'
                }
            ]
        }
    },
    {
        path: '/banking/accounts/:id',
        components: {
            default: Show,
            'sidebar-right': SidebarRight
        },
        meta: {
            title: 'Banking :: Bank Account',
            metaTags: [
                {
                    name: 'description',
                    content: 'Bank Account'
                },
                {
                    property: 'og:description',
                    content: 'Bank Account'
                }
            ]
        }
    },
    {
        path: '/banking/accounts/:id/edit',
        components: {
            default: Form
        },
        meta: {
            title: 'Banking :: Account edit',
            metaTags: [
                {
                    name: 'description',
                    content: 'Banking Account edit'
                },
                {
                    property: 'og:description',
                    content: 'Banking Account edit'
                }
            ]
        }
    },
    {
        path: '/banking/accounts/:bank_account_id/transactions/rules',
        components: {
            default: TransactionRulesIndex,
            //'sidebar-right': SidebarRight
        },
        meta: {
            title: 'Banking :: Bank Account :: Transactions :: Rules',
            metaTags: [
                {
                    name: 'description',
                    content: 'Bank Account transaction rules'
                },
                {
                    property: 'og:description',
                    content: 'Bank Account transaction rules'
                }
            ]
        }
    },
    {
        path: '/banking/accounts/:bank_account_id/transactions/rules/create',
        components: {
            default: TransactionRulesForm,
            //'sidebar-right': SidebarRight
        },
        meta: {
            title: 'Banking :: Bank Account :: Transactions :: Rules :: Create',
            metaTags: [
                {
                    name: 'description',
                    content: 'Bank Account transaction rule create'
                },
                {
                    property: 'og:description',
                    content: 'Bank Account transaction rule create'
                }
            ]
        }
    },
    {
        path: '/banking/accounts/:bank_account_id/transactions/rules/:id/edit',
        components: {
            default: TransactionRulesForm,
            //'sidebar-right': SidebarRight
        },
        meta: {
            title: 'Banking :: Bank Account :: Transactions :: Rules :: Edit',
            metaTags: [
                {
                    name: 'description',
                    content: 'Bank Account transaction rule edit'
                },
                {
                    property: 'og:description',
                    content: 'Bank Account transaction rule edit'
                }
            ]
        }
    },
    {
        path: '/banking/accounts/:id/transactions/upload',
        components: {
            default: TransactionUpload,
            //'sidebar-right': SidebarRight
        },
        meta: {
            title: 'Banking :: Bank Account',
            metaTags: [
                {
                    name: 'description',
                    content: 'Bank Account'
                },
                {
                    property: 'og:description',
                    content: 'Bank Account'
                }
            ]
        }
    }

]

export default routes
