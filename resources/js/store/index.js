import Vue from 'vue'
import Vuex from 'vuex'
import getters from './getters'
import app from './modules/app'
import settings from './modules/settings'

Vue.use(Vuex);

import http from '@/util/axios'

const store = new Vuex.Store({
    strict: false,
    modules: {
        app,
        settings
    },
    state: {
        query: "",
        path: null,
        pages: {},
        contents: {},
        grids: {}
    },
    getters: {
        ...getters,
        thisPage: state => {
            return state.pages[state.path]
        }
    },
    mutations: {
        setPath(state, path) {
            state.path = path;
        },
        initPages(state, path) {
            state.pages[path] = {
                grids: {
                }
            }
        },
        registerCentent(state, path) {
            state.contents[path] = {}
        },
        setCenten(state, { data, path }) {
            state.contents[path] = data
        },
        setGridData(state, { key, data }) {
            state.pages[state.path].grids[key] = data;
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