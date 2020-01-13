import Vue from 'vue';
import Admin from './Admin';
import './components.js';
; (function () {
    this.CreateVueAdmin = function (config) {
        return new Admin(config)
    }
}.call(window));
