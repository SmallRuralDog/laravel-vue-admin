import axios from 'axios'
import {
    LoadingBar,
    Message,
    Notice
} from 'view-design'

axios.interceptors.request.use(config => {
    config.headers['X-Requested-With'] = 'XMLHttpRequest';
    return config
}, error => {
    Promise.reject(error)
});
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

export default axios
