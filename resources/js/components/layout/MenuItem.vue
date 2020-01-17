<template>
  <el-submenu :index="menu.route" v-if="menu.children && menu.children.length>0">
    <template slot="title">
      <i :class="menu.icon" size="16"></i>
      <span>{{menu.title}}</span>
    </template>
    <template v-for="children in menu.children">
      <menu-item-c :menu="children" :key="children.id" :is_collapsed="is_collapsed" />
    </template>
  </el-submenu>
  <a :data-href="menu.url" v-else>
    <el-menu-item :index="menu.route" :route="menu.route">
      <i :class="menu.icon" size="16"></i>
      <span slot="title">{{menu.title}}</span>
    </el-menu-item>
  </a>
</template>
<script>
export default {
  props: {
    menu: Object,
    is_collapsed: Boolean
  },
  name:"menu-item-c",
  mounted(){

  }
};
</script>