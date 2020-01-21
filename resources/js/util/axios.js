import axios from 'axios'
import router from '../router'
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
                try {
                    data.message && Message[data.data.type]({
                        content: data.message,
                        duration: 3
                    });

                    if (data.data.isVueRoute) {
                        router.replace(data.data.url)
                    } else {
                        window.location.href = data.data.url
                    }
                } catch (error) {
                    console.error("请返回 Admin::responseRedirect()");
                }
                break;
            case 200:
                data.message && Message.success({
                    content: data.message,
                    duration: 3
                });
                break;
        }
        return data;
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
