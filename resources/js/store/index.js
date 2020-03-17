import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex);

import http from '@/util/axios'

const store = new Vuex.Store({
    state: {
        contents: {}
    },
    mutations: {
        registerCentent(state, path) {
            state.contents[path] = {}
        },
        setCenten(state, { data, path }) {
            state.contents[path] = data
        }
    },
    actions: {
        getCenten(context, { path, contentUrl, params }) {

            return http.get(contentUrl, {
                params: params
            }).then(data => {
                context.commit('setCenten', { data: data, path: path });
                return Promise.resolve(data)
            }).catch(() => {
                return Promise.reject()
            });

        }
    }
})

export default store