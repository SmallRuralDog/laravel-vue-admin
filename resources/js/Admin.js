import Vue from 'vue'
import VueBus from 'vue-bus';
import axios from './util/axios'
import lodash from 'lodash'
import {
    LoadingBar,
    Message,
    Notice
} from 'view-design'
import 'view-design/dist/styles/iview.css';
Vue.prototype.$Loading = LoadingBar;
Vue.prototype.$Message = Message;
Vue.prototype.$http = axios;
Vue.prototype._ = lodash;
window._ = lodash;
Vue.use(VueBus);

export default class Admin {
    constructor(config) {
        this.bus = new Vue();
        this.bootingCallbacks = [];
        this.config = config
    }

    booting(callback) {
        this.bootingCallbacks.push(callback)
    }

    boot() {
        this.bootingCallbacks.forEach(callback => callback(Vue));
        this.bootingCallbacks = []
    }

    liftOff() {
        let _this = this;
        this.boot();
        this.app = new Vue({
            el: '#app',
        });
    }
}
