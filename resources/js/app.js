import Vue from "vue";
import Admin from "./Admin";
import "./components.js";

import "./styles/admin.scss";
(function() {
  this.CreateVueAdmin = function(config) {
    return new Admin(config);
  };
}.call(window));
