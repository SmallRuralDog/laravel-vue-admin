window.Vue = require('vue');
import VueBus from 'vue-bus';
import axios from 'axios'
import lodash from 'lodash'
import {
    LoadingBar,
    Message,
    Notice
} from 'view-design'
import 'view-design/dist/styles/iview.css';


import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import './styles/admin.scss';

window.Vue.use(ElementUI);

Vue.prototype.$Loading = LoadingBar;
Vue.prototype.$Message = Message;


axios.interceptors.request.use(config => {
    config.headers['X-Requested-With'] = 'XMLHttpRequest'
    return config
}, error => {
    Promise.reject(error)
})
axios.interceptors.response.use(
    ({
        data
    }) => {
        // 对响应数据做点什么
        switch (data.code) {
            case 400:
                Message.error({
                    content: data.message,
                    duration: 3
                });
                break;
            case 301:
                window.location.replace(data.data)
                break;
            case 200:
                data.message && Message.success({
                    content: data.message,
                    duration: 3
                });
                break;
        }
        return data
    },
    ({
        response
    }) => {
        console.log(response)
        // 对响应错误做点什么
        Notice.error({
            title: '请求错误',
            desc: response.data.message
        });
        return Promise.reject(response);
    }
);

Vue.prototype.$http = axios;
Vue.prototype._ = lodash;
window._ = lodash;
Vue.use(VueBus);


Vue.component('login', require('./components/Login').default);
Vue.component('content-layout', require('./components/layout/Content').default);
Vue.component('row-layout', require('./components/layout/Row').default);
Vue.component('column-layout', require('./components/layout/Column').default);
Vue.component('table-grid', require('./components/grid/Table').default);
Vue.component('base-form', require('./components/form/BaseForm').default);
//Vue.component('InputNumber', require('./components/widgets/InputNumber').default);

new window.Vue({
    el: '#app',
});
