import Vue from 'vue'
import VueBus from 'vue-bus';
import axios from './util/axios'
import lodash from 'lodash'
import router from '@/router'
import store from '@/store'


import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
Vue.use(ElementUI, { size: 'small' });

import VueProgressBar from 'vue-progressbar'

const options = {
    color: "#409EFF",
    failedColor:"#F56C6C",
    thickness: '4px',
    autoFinish:false,
}

Vue.use(VueProgressBar, options);







Vue.prototype.$http = axios;
Vue.prototype.axios = axios;
Vue.prototype._ = lodash;
window._ = lodash;
Vue.use(VueBus);



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
            el: '#app',
            store,
            router
        });
    }
}
