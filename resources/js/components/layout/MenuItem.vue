<template>
    <el-submenu
      :index="menu.route"
      v-if="menu.children && menu.children.length > 0"
    >
      <template slot="title">
        <i :class="menu.icon" v-if="menu.icon" size="16"></i>
        <span slot="title">{{ menu.title }}</span>
      </template>
      <template v-for="children in menu.children">
        <MenuItem
          :menu="children"
          :key="children.id"
          :is_collapsed="is_collapsed"
        />
      </template>
    </el-submenu>
    <el-menu-item :index="menu.route" :route="menu.route" v-else>
      <i :class="menu.icon" v-if="menu.icon" size="16"></i>
      <span slot="title">{{ menu.title }}</span>
    </el-menu-item>
</template>
<script>
export default {
  props: {
    menu: Object,
    is_collapsed: Boolean,
  },
};
</script>
