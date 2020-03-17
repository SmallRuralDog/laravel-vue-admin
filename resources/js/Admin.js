import Vue from 'vue'
import VueBus from 'vue-bus';
import axios from './util/axios'
import lodash from 'lodash'
import router from '@/router'
import store from '@/store'
import {
    LoadingBar,
    Message,
    Drawer
} from 'view-design'
import 'view-design/dist/styles/iview.css';

import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
Vue.use(ElementUI, { size: 'small', zIndex: 3000 });
Vue.component('Drawer', Drawer);


Vue.prototype.$Loading = LoadingBar;
Vue.prototype.$Message = Message;
Vue.prototype.$http = axios;
Vue.prototype._ = lodash;
window._ = lodash;
Vue.use(VueBus);


import './styles/admin.scss';

export default class VueAdmin {
    constructor(config) {
        this.bootingCallbacks = [];
        this.config = config
    }

    booting(callback) {
        this.bootingCallbacks.push(callback)
    }

    boot() {
        this.bootingCallbacks.forEach(callback => callback(Vue, router));
        this.bootingCallbacks = []
    }

    liftOff() {
        let _this = this;
        this.boot();
        this.app = new Vue({
            el: '#vue-admin',
            store,
            router
        });
    }
}
