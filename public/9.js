(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[9],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/widgets/Form/WangEditor.vue?vue&type=script&lang=js&":
/*!**********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/widgets/Form/WangEditor.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var wangeditor__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! wangeditor */ "./node_modules/wangeditor/release/wangEditor.js");
/* harmony import */ var wangeditor__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(wangeditor__WEBPACK_IMPORTED_MODULE_0__);
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  props: ["value", "attrs", "form_data", "form_items"],
  model: {
    prop: "value",
    event: "change"
  },
  data: function data() {
    return {
      editor: null,
      initHtml: false
    };
  },
  mounted: function mounted() {
    var _this = this;

    this.editor = new wangeditor__WEBPACK_IMPORTED_MODULE_0___default.a(this.$refs.editor);
    this.editor.customConfig.menus = this.attrs.menus;
    this.editor.customConfig.zIndex = this.attrs.zIndex;
    this.editor.customConfig.uploadImgShowBase64 = this.attrs.uploadImgShowBase64;
    if (this.attrs.uploadImgServer) this.editor.customConfig.uploadImgServer = this.attrs.uploadImgServer;

    this.editor.customConfig.onchange = function (html) {
      _this.onChange(html);
    };

    this.editor.create();
  },
  watch: {
    value: function value(html) {
      if (!this.initHtml) {
        this.initHtml = true;
        this.editor.txt.html(html);
      }
    }
  },
  methods: {
    onChange: function onChange(value) {
      this.$emit("change", value);
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/widgets/Form/WangEditor.vue?vue&type=template&id=422d3620&":
/*!**************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/widgets/Form/WangEditor.vue?vue&type=template&id=422d3620& ***!
  \**************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", {
    ref: "editor",
    class: _vm.attrs.className,
    style: _vm.attrs.style
  })
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/widgets/Form/WangEditor.vue":
/*!*************************************************************!*\
  !*** ./resources/js/components/widgets/Form/WangEditor.vue ***!
  \*************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _WangEditor_vue_vue_type_template_id_422d3620___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./WangEditor.vue?vue&type=template&id=422d3620& */ "./resources/js/components/widgets/Form/WangEditor.vue?vue&type=template&id=422d3620&");
/* harmony import */ var _WangEditor_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./WangEditor.vue?vue&type=script&lang=js& */ "./resources/js/components/widgets/Form/WangEditor.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _WangEditor_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _WangEditor_vue_vue_type_template_id_422d3620___WEBPACK_IMPORTED_MODULE_0__["render"],
  _WangEditor_vue_vue_type_template_id_422d3620___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/widgets/Form/WangEditor.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/widgets/Form/WangEditor.vue?vue&type=script&lang=js&":
/*!**************************************************************************************!*\
  !*** ./resources/js/components/widgets/Form/WangEditor.vue?vue&type=script&lang=js& ***!
  \**************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_WangEditor_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./WangEditor.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/widgets/Form/WangEditor.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_WangEditor_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/widgets/Form/WangEditor.vue?vue&type=template&id=422d3620&":
/*!********************************************************************************************!*\
  !*** ./resources/js/components/widgets/Form/WangEditor.vue?vue&type=template&id=422d3620& ***!
  \********************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_WangEditor_vue_vue_type_template_id_422d3620___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./WangEditor.vue?vue&type=template&id=422d3620& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/widgets/Form/WangEditor.vue?vue&type=template&id=422d3620&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_WangEditor_vue_vue_type_template_id_422d3620___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_WangEditor_vue_vue_type_template_id_422d3620___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);