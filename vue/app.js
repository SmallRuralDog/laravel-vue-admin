window.Vue = require('vue');

window._ = require('lodash');
import axios from 'axios'
import ViewUI from 'view-design';
import 'view-design/dist/styles/iview.css';
import './styles/admin.scss';

window.Vue.use(ViewUI);


axios.interceptors.response.use(
    ({data}) => {
        console.log(data)
        // 对响应数据做点什么
        switch (data.code) {
            case 400:
                ViewUI.Message.error({
                    content: data.message,
                    duration: 3
                });
                break;
            case 301:
                window.location.replace(data.data)
                break;
        }
        return data.data;
    },
    ({response}) => {
        console.log(response)
        // 对响应错误做点什么
        ViewUI.Notice.error({
            title: '请求错误',
            desc: response.data.message
        });
        return Promise.reject(response);
    }
);

Vue.prototype.$http = axios;


Vue.component('login', require('./components/Login').default);
Vue.component('content-layout', require('./components/layout/Content').default);
Vue.component('row-layout', require('./components/layout/Row').default);
Vue.component('column-layout', require('./components/layout/Column').default);
Vue.component('table-grid', require('./components/grid/Table').default);

new window.Vue(
    {
        el: '#app',
    }
);
