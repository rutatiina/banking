
import AccountsRouter from './components/l-limitless-bs4/accounts/Router'
import BanksRouter from './components/l-limitless-bs4/banks/Router'

const Accounts = () => import('./components/l-limitless-bs4/accounts/Index')

let routes = [

    {
        path: '/banking',
        redirect: '/banking/accounts'
    }

]

routes = routes.concat(
    routes,
    BanksRouter,
    AccountsRouter
)

export default routes
