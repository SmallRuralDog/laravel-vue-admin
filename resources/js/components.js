import Vue from 'vue'

import Login from './components/Login'
import Root from './components/Root'
import Content from './components/layout/Content'
import Row from './components/layout/Row'
import Column from './components/layout/Column'
import Table from './components/grid/Table'
import Tree from './components/grid/Tree'
import BaseForm from './components/form/BaseForm'

Vue.component('login', Login);
Vue.component('Root', Root);
Vue.component('Content', Content);
Vue.component('Row', Row);
Vue.component('Column', Column);
Vue.component('Grid', Table);
Vue.component('Tree', Tree);
Vue.component('Form', BaseForm);


import Input from './components/widgets/Input'
import RadioGroup from './components/widgets/RadioGroup'
import Checkbox from './components/widgets/Checkbox'
import CheckboxGroup from './components/widgets/CheckboxGroup'
import InputNumber from './components/widgets/InputNumber'
import Select from './components/widgets/Select'
import Cascader from './components/widgets/Cascader'
import Switch from './components/widgets/Switch'
import Slider from './components/widgets/Slider'
import Transfer from './components/widgets/Transfer'
import Upload from './components/widgets/Upload'
import ColorPicker from './components/widgets/ColorPicker'
import TimePicker from './components/widgets/TimePicker'
import DatePicker from './components/widgets/DatePicker'
import DateTimePicker from './components/widgets/DateTimePicker'



Vue.component('Input', Input);
Vue.component('RadioGroup', RadioGroup);
Vue.component('Checkbox', Checkbox);
Vue.component('CheckboxGroup', CheckboxGroup);
Vue.component('InputNumber', InputNumber);
Vue.component('Select', Select);
Vue.component('Cascader', Cascader);
Vue.component('CSwitch', Switch);
Vue.component('Slider', Slider);
Vue.component('Transfer', Transfer);
Vue.component('Upload', Upload);
Vue.component('ColorPicker', ColorPicker);
Vue.component('TimePicker', TimePicker);
Vue.component('DatePicker', DatePicker);
Vue.component('DateTimePicker', DateTimePicker);



import Avatar from './components/widgets/Avatar'
import Tag from './components/widgets/Tag'
import Link from './components/widgets/Link'
import Text from './components/widgets/Text'
import Image from './components/widgets/Image'
import Icon from './components/widgets/Icon'



Vue.component('Avatar', Avatar);
Vue.component('Tag', Tag);
Vue.component('Link', Link);
Vue.component('IText', Text);
Vue.component('IImage', Image);
Vue.component('Icon', Icon);



import MenuItem from './components/layout/MenuItem'
Vue.component('MenuItem', MenuItem);



//Actions
import EditAction from './components/widgets/Actions/EditAction'
import DeleteAction from './components/widgets/Actions/DeleteAction'
Vue.component('EditAction', EditAction);
Vue.component('DeleteAction', DeleteAction);

//Tools
import GridCreateButton from './components/widgets/Tools/Create'
import VueRouteButton from './components/widgets/Tools/VueRouteButton'
Vue.component('GridCreateButton', GridCreateButton);
Vue.component('VueRouteButton', VueRouteButton);