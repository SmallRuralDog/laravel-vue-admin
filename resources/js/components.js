import Vue from 'vue'

import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import './styles/admin.scss';


Vue.use(ElementUI);

Vue.component('login', require('./components/Login').default);
Vue.component('content-layout', require('./components/layout/Content').default);
Vue.component('row-layout', require('./components/layout/Row').default);
Vue.component('column-layout', require('./components/layout/Column').default);
Vue.component('table-grid', require('./components/grid/Table').default);
Vue.component('base-form', require('./components/form/BaseForm').default);


Vue.component('Input', require('./components/widgets/Input').default);
Vue.component('RadioGroup', require('./components/widgets/RadioGroup').default);
Vue.component('Checkbox', require('./components/widgets/Checkbox').default);
Vue.component('CheckboxGroup', require('./components/widgets/CheckboxGroup').default);
Vue.component('InputNumber', require('./components/widgets/InputNumber').default);
Vue.component('Select', require('./components/widgets/Select').default);
Vue.component('Cascader', require('./components/widgets/Cascader').default);
Vue.component('CSwitch', require('./components/widgets/Switch').default);
Vue.component('Slider', require('./components/widgets/Slider').default);
Vue.component('Transfer', require('./components/widgets/Transfer').default);

Vue.component('Avatar', require('./components/widgets/Avatar').default);
Vue.component('Tag', require('./components/widgets/Tag').default);

Vue.component('Link', require('./components/widgets/Link').default);
