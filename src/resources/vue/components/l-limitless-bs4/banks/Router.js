
const Form = () => import('./Form')
const Index = () => import('./Index')

let routes = [

    {
        path: '/banking/banks/create',
        components: {
            default: Form
        },
        meta: {
            title: 'Banking :: Bank create',
            metaTags: [
                {
                    name: 'description',
                    content: 'Banking : Bank create'
                },
                {
                    property: 'og:description',
                    content: 'Banking : Bank create'
                }
            ]
        }
    },
    {
        path: '/banking/banks',
        components: {
            default: Index
        },
        meta: {
            title: 'Banking :: Banks',
            metaTags: [
                {
                    name: 'description',
                    content: 'Banking Banks'
                },
                {
                    property: 'og:description',
                    content: 'Banking : Banks'
                }
            ]
        }
    }

]

export default routes
