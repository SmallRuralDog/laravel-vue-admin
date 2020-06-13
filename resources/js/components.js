import Vue from "vue";

Vue.component("login", require("@/components/Login").default);
Vue.component("Root", require("@/components/Root").default);
Vue.component("Content", require("@/components/layout/Content").default);
Vue.component("Row", require("@/components/layout/Row").default);
Vue.component("Column", require("@/components/layout/Column").default);
Vue.component("Grid", require("@/components/grid/Table").default);
Vue.component("Tree", require("@/components/grid/Tree").default);
Vue.component("Form", require("@/components/form/Form").default);
Vue.component("BaseForm", require("@/components/form/BaseForm").default);
Vue.component("MenuItem", require("@/components/layout/MenuItem").default);

//Form
Vue.component("Input", require("@/components/widgets/Form/Input").default);
Vue.component(
  "RadioGroup",
  require("@/components/widgets/Form/RadioGroup").default
);
Vue.component(
  "Checkbox",
  require("@/components/widgets/Form/Checkbox").default
);
Vue.component(
  "CheckboxGroup",
  require("@/components/widgets/Form/CheckboxGroup").default
);
Vue.component(
  "InputNumber",
  require("@/components/widgets/Form/InputNumber").default
);
Vue.component("Select", require("@/components/widgets/Form/Select").default);
Vue.component(
  "Cascader",
  require("@/components/widgets/Form/Cascader").default
);
Vue.component("CSwitch", require("@/components/widgets/Form/Switch").default);
Vue.component("Slider", require("@/components/widgets/Form/Slider").default);
Vue.component(
  "Transfer",
  require("@/components/widgets/Form/Transfer").default
);
Vue.component("Upload", require("@/components/widgets/Form/Upload").default);
Vue.component(
  "ColorPicker",
  require("@/components/widgets/Form/ColorPicker").default
);
Vue.component(
  "TimePicker",
  require("@/components/widgets/Form/TimePicker").default
);
Vue.component(
  "DatePicker",
  require("@/components/widgets/Form/DatePicker").default
);
Vue.component(
  "DateTimePicker",
  require("@/components/widgets/Form/DateTimePicker").default
);
Vue.component("WangEditor", () =>
  import("@/components/widgets/Form/WangEditor")
);
Vue.component(
  "ItemSelect",
  require("@/components/widgets/Form/ItemSelect").default
);
Vue.component(
  "IconChoose",
  require("./components/widgets/Form/IconChoose").default
);

//Grid
Vue.component("Avatar", require("./components/widgets/Grid/Avatar").default);
Vue.component("Tag", require("./components/widgets/Grid/Tag").default);
Vue.component("Link", require("./components/widgets/Grid/Link").default);
Vue.component("IText", require("./components/widgets/Text").default);
Vue.component("IImage", require("./components/widgets/Grid/Image").default);
Vue.component("Icon", require("./components/widgets/Grid/Icon").default);
Vue.component("Boole", require("./components/widgets/Grid/Boole").default);

//Actions
Vue.component(
  "EditAction",
  require("@/components/widgets/Actions/EditAction").default
);
Vue.component(
  "DeleteAction",
  require("@/components/widgets/Actions/DeleteAction").default
);
Vue.component(
  "VueRouteAction",
  require("@/components/widgets/Actions/VueRouteAction").default
);
Vue.component(
  "ActionButton",
  require("@/components/widgets/Actions/ActionButton").default
);

//BatchAction
Vue.component(
  "BatchAction",
  require("@/components/widgets/BatchActions/BatchAction").default
);

//Tools
Vue.component(
  "GridCreateButton",
  require("@/components/widgets/Tools/Create").default
);
Vue.component(
  "ToolButton",
  require("@/components/widgets/Tools/ToolButton").default
);

//Widget
Vue.component("Divider", require("@/components/widgets/Divider").default);
Vue.component("Card", require("@/components/widgets/Card").default);
Vue.component("Steps", require("@/components/widgets/Steps").default);
Vue.component("Html", require("@/components/widgets/Html").default);
Vue.component("Alert", require("@/components/widgets/Alert").default);
Vue.component(
  "DialogButton",
  require("@/components/widgets/DialogButton").default
);
Vue.component("Tooltip", require("@/components/widgets/Tooltip").default);

//antv
Vue.component("AntvLine", () => import("@/components/antv/AntvLine"));
Vue.component("AntvArea", () => import("@/components/antv/AntvArea"));
Vue.component("AntvStepLine", () => import("@/components/antv/AntvStepLine"));
Vue.component("AntvColumn", () => import("@/components/antv/AntvColumn"));
