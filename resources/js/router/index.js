import Vue from 'vue'
import Router from 'vue-router'



import routes from './routes'
Vue.use(Router)
const router = createRouter({ base: window.config.base })
export default router

function createRouter({ base }) {
    const router = new Router({
        base,
        //mode: 'history',
        mode: 'hash',
        routes,
    })
    router.beforeEach(beforeEach)
    router.afterEach(afterEach)
    return router
}

async function beforeEach(to, from, next) {



    const components = await resolveComponents(
        router.getMatchedComponents({ ...to })
    )
    if (components.length === 0) {
        return next()
    }
    if (components[components.length - 1].loading !== false) {
        router.app.$nextTick(() => {
            
        })
    }
    next()
}

async function afterEach(to, from, next) {
    await router.app.$nextTick()

   

    router.app.$bus.emit('route-after', to);
}

function resolveComponents(components) {
    return Promise.all(
        components.map(component => {
            return typeof component === 'function' ? component() : component
        })
    )
}

function scrollBehavior(to, from, savedPosition) {
    if (savedPosition) {
        return savedPosition
    }

    if (to.hash) {
        return { selector: to.hash }
    }

    const [component] = router.getMatchedComponents({ ...to }).slice(-1)

    if (component && component.scrollToTop === false) {
        return {}
    }

    return { x: 0, y: 0 }
}