import Base from '../components/layout/Base'
import Page404 from '../components/404'
export default [
    {
        name: 'Page404',
        path: '/404',
        component: Page404
    },
    {
        name: 'home',
        path: '/*',
        component: Base
    },

]