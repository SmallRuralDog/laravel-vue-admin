<template>
  <div>
    <el-container class="admin-layout">
      <el-aside
        ref="contentSide"
        class="content-side"
        :class="{'content-side-fixed':fixedSide,'side-dark':isDark}"
        :width="isCollapsed?'64px':'200px'"
      >
        <div class="content-side-logo">
          <template v-if="!isCollapsed">
            <img :src="page_data.logo" v-if="!isDark" />
            <img :src="page_data.logoDark" v-else />
          </template>

          <img :src="page_data.logoMini" v-else />
        </div>
        <el-scrollbar wrap-class="scrollbar-wrapper">
          <el-menu
            :default-active="route"
            :collapse="isCollapsed"
            :background-color="isDark?'#1d1e23':''"
            :text-color="isDark?'#ffffff':''"
            :collapse-transition="false"
            :router="true"
            unique-opened
          >
            <template v-for="menu in page_data.menu">
              <el-submenu
                :show-timeout="1"
                :hide-timeout="1"
                :index="menu.route"
                v-if="menu.children && menu.children.length>0"
                :key="menu.id"
              >
                <template slot="title">
                  <i :class="menu.icon" size="16"></i>
                  <span>{{menu.title}}</span>
                </template>
                <a :data-href="sub_menu.url" v-for="sub_menu in menu.children" :key="sub_menu.id">
                  <el-menu-item :index="sub_menu.route" :route="sub_menu.route">
                    <i v-show="isCollapsed" :class="sub_menu.icon"></i>
                    <span slot="title">{{sub_menu.title}}</span>
                  </el-menu-item>
                </a>
              </el-submenu>
              <a :data-href="menu.url" v-else :key="menu.id">
                <el-menu-item :index="menu.route" :route="menu.route">
                  <i :class="menu.icon" size="16"></i>
                  <span slot="title">{{menu.title}}</span>
                </el-menu-item>
              </a>
            </template>
          </el-menu>
        </el-scrollbar>
      </el-aside>
      <el-container
        :class="{'el-container-fixed':fixedSide,'el-container-fixed-collapsed':isCollapsed}"
      >
        <el-header
          :style="{padding: 0}"
          class="layout-header-bar"
          :class="{'layout-header-bar-dark':isDarkHeader,'layout-header-bar-fixed':fixedHeader,'layout-header-bar-fixed-collapsed':isCollapsed}"
          height="55px"
        >
          <div class="layout-header-l">
            <div class="layout-header-trigger hover" @click="collapsedSide">
              <i class="el-icon-s-fold fs-20 menu-icon" :class="{'rotate-icon':isCollapsed}" />
            </div>
            <div class="layout-header-breadcrumb">
              <el-breadcrumb separator="/">
                <el-breadcrumb-item :to="{ path: '/' }">首页</el-breadcrumb-item>
                <template v-for="menu in page_data.menuList">
                  <el-breadcrumb-item v-if="menu.route==route" :key="menu.route">{{menu.title}}</el-breadcrumb-item>
                </template>
              </el-breadcrumb>
            </div>
          </div>
          <div class="layout-header-r">
            <div class="layout-header-trigger layout-header-trigger-min hover">
              <el-dropdown>
                <div class="layout-header-user">
                  <el-avatar :src="page_data.user.avatar" :size="25" />
                  <span class="layout-header-user-name">{{page_data.user.name}}</span>
                </div>
                <el-dropdown-menu slot="dropdown">
                  <a>
                    <el-dropdown-item>
                      <i class="el-icon-setting" size="18" />
                      <span>个人设置</span>
                    </el-dropdown-item>
                  </a>
                  <a @click="onLogout">
                    <el-dropdown-item>
                      <i class="el-icon-right" size="18" />
                      <span>退出登陆</span>
                    </el-dropdown-item>
                  </a>
                </el-dropdown-menu>
              </el-dropdown>
            </div>
            <div
              @click="showAdminSet=true"
              class="layout-header-trigger layout-header-trigger-min hover"
            >
              <i class="el-icon-setting icon-btn"></i>
            </div>
          </div>
        </el-header>
        <el-main :class="{'el-main-fixed':fixedHeader}">
          <div class="layout-content-main">
            <transition name="fade-transform" mode="out-in">
              <router-view></router-view>
            </transition>
          </div>
        </el-main>
        <el-footer class="admin-footer">
          <div class="footer-links">
            <el-link
              v-for="(item,index) in page_data.footerLinks"
              :key="index"
              type="text"
              :href="item.href"
              target="_blank"
              :underline="false"
            >{{item.title}}</el-link>
          </div>
          <div v-html="page_data.copyright"></div>
        </el-footer>
      </el-container>
    </el-container>
    <el-backtop></el-backtop>
    <Drawer v-model="showAdminSet">
      <div style="height:5px;"></div>
      <el-divider>主题风格</el-divider>
      <div>
        <el-badge type="success" is-dot :hidden="isDark">
          <div>
            <el-tooltip content="亮色菜单风格" placement="top">
              <el-image
                @click="isDark=false"
                class="hover"
                src="https://gw.alipayobjects.com/zos/antfincdn/NQ%24zoisaD2/jpRkZQMyYRryryPNtyIC.svg"
              />
            </el-tooltip>
          </div>
        </el-badge>
        <el-badge type="success" is-dot :hidden="!isDark">
          <div class="ml-20">
            <el-tooltip content="暗色菜单风格" placement="top">
              <el-image
                @click="isDark=true"
                class="hover"
                src="https://gw.alipayobjects.com/zos/antfincdn/XwFOFbLkSM/LCkqqYNmvBEbokSDscrm.svg"
              />
            </el-tooltip>
          </div>
        </el-badge>
      </div>
      <div class="mt-30">
        <el-badge type="success" is-dot :hidden="isDarkHeader">
          <div @click="isDarkHeader=false">
            <el-tooltip content="亮色顶栏风格" placement="top">
              <el-image
                class="hover"
                src="https://file.iviewui.com/admin-pro-dist/img/nav-theme-dark.da07f9c2.svg"
              />
            </el-tooltip>
          </div>
        </el-badge>
        <el-badge type="success" is-dot :hidden="!isDarkHeader">
          <div class="ml-20" @click="isDarkHeader=true">
            <el-tooltip content="暗色顶栏风格" placement="top">
              <el-image
                class="hover"
                src="https://file.iviewui.com/admin-pro-dist/img/header-theme-dark.1606ed02.svg"
              />
            </el-tooltip>
          </div>
        </el-badge>
      </div>
      <el-divider>导航设置</el-divider>

      <div class="setting-item">
        <span>固定顶栏</span>
        <span>
          <el-switch v-model="fixedHeader"></el-switch>
        </span>
      </div>
      <div class="setting-item">
        <span>固定侧边栏</span>
        <span>
          <el-switch v-model="fixedSide"></el-switch>
        </span>
      </div>
    </Drawer>
  </div>
</template>

<script>
import { flattenDeepChild } from "../utils";
export default {
  props: {
    page_data: Object
  },
  data() {
    return {
      fixedSide: localStorage.getItem("fixedSide")
        ? localStorage.getItem("fixedSide") == "true"
        : true,
      fixedHeader: localStorage.getItem("fixedHeader")
        ? localStorage.getItem("fixedHeader") == "true"
        : true,
      isCollapsed: localStorage.getItem("isCollapsed")
        ? localStorage.getItem("isCollapsed") == "true"
        : false,
      isDark: localStorage.getItem("isDark")
        ? localStorage.getItem("isDark") == "true"
        : true,
      isDarkHeader: localStorage.getItem("isDarkHeader")
        ? localStorage.getItem("isDarkHeader") == "true"
        : false,
      showAdminSet: false,
      route: "/"
    };
  },
  mounted() {
    this.$bus.on("route-after", to => {
      this.route = to.path;
      this.menuRoutes.map(item => {
        if (to.path.indexOf(item) >= 0) {
          this.route = item;
        }
      });
    });
  },
  computed: {
    menuitemClasses() {
      return ["menu-item", this.isCollapsed ? "collapsed-menu" : ""];
    },
    menuRoutes() {
      return flattenDeepChild(this.page_data.menu, "children", "route");
    }
  },
  methods: {
    collapsedSide() {
      this.isCollapsed = !this.isCollapsed;
    },
    onLogout() {
      this.$confirm("您确定退出登录当前账户吗？", "退出登陆确认").then(() => {
        window.location.href = this.page_data.url.logout;
      });
    }
  },
  watch: {
    fixedSide(val) {
      localStorage.setItem("fixedSide", val);
    },
    fixedHeader(val) {
      localStorage.setItem("fixedHeader", val);
    },
    isCollapsed(val) {
      localStorage.setItem("isCollapsed", val);
    },
    isDark(val) {
      localStorage.setItem("isDark", val);
    },
    isDarkHeader(val) {
      localStorage.setItem("isDarkHeader", val);
    }
  }
};
</script>

<style lang="scss" >
$header-bar-height: 55px;
.admin-layout {
  min-height: 100vh;
}
.ivu-layout-sider {
  min-height: 100vh;

  .ivu-layout-sider-children {
    height: 100%;
    padding-top: 0.1px;
    margin-top: -0.1px;
  }
}
.content-side {
  min-height: 100vh;
  background: #fff;
  box-shadow: 2px 0 8px 0 rgba(29, 35, 41, 0.05);
  position: relative;
  transition: all 0.3s ease-in-out;
  z-index: 13;
  display: flex;
  flex-direction: column;
  .el-menu {
    border-right: none;
  }
  .content-side-logo {
    height: $header-bar-height;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    img {
      height: 80%;
      object-fit: cover;
      vertical-align: middle;
    }
  }
  .el-scrollbar {
    flex: 1;
    .scrollbar-wrapper {
      overflow-x: hidden;
    }
  }
}
.content-side-fixed {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
}
.el-container-fixed {
  margin-left: 200px;
  transition: all 0.3s ease-in-out;
}
.el-container-fixed-collapsed {
  margin-left: 60px;
}

.side-dark {
  background: #1d1e23;
  box-shadow: 2px 0 6px rgba(0, 21, 41, 0.35);
}
.layout-header-bar {
  width: 100%;
  background: #fff;
  padding: 0;
  box-shadow: 0 1px 4px rgba(0, 21, 41, 0.08);
  transition: all 0.3s ease-in-out;
  z-index: 3;
  display: flex;
  align-items: center;
  justify-content: space-between;
  height: $header-bar-height;
  line-height: $header-bar-height;

  .hover {
    &:hover {
      background-color: #f7f7f7;
    }
  }

  .layout-header-l {
    display: flex;
    height: $header-bar-height;

    .layout-header-trigger {
      width: $header-bar-height;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;

      .menu-icon {
        transition-duration: 0.3s;
        transform: rotate(0deg);
      }

      .rotate-icon {
        transform: rotate(180deg);
      }
    }

    .layout-header-breadcrumb {
      margin-left: 10px;
      display: flex;
      align-items: center;
    }
  }

  .layout-header-r {
    height: $header-bar-height;
    display: flex;
    align-items: center;
    .layout-header-trigger {
      width: $header-bar-height;
      height: $header-bar-height;
      cursor: pointer;
      transition: all 0.3s ease-in-out;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .layout-header-trigger-min {
      width: auto;
      padding: 0 12px;
    }
    .layout-header-user {
      display: flex;
      align-items: center;
      .layout-header-user-name {
        margin-left: 5px;
      }
    }
    .icon-btn {
      font-size: 18px;
    }
    .icon-btn-mini {
      font-size: 14px;
    }
  }
}
.layout-header-bar-dark {
  background: #1d1e23;
  color: white;
  .el-dropdown {
    color: white;
  }
  .el-breadcrumb__inner {
    color: #ffffffb3;
  }
  .el-breadcrumb__item:last-child .el-breadcrumb__inner {
    color: white;
  }
  .hover {
    &:hover {
      background-color: #1d1e23;
    }
  }
}
.layout-header-bar-fixed {
  position: fixed;
  right: 0;
  top: 0;
  left: 200px;
  width: auto;
  transition: all 0.3s ease-in-out;
}
.layout-header-bar-fixed-collapsed {
  left: 60px;
}
.el-main {
  padding: 0;
}
.el-main-fixed {
  margin-top: $header-bar-height;
}
.layout-content-main {
  margin: 15px;

  .layout-page-header {
    margin: -15px -15px 0;
    padding: 15px 15px 0 15px;
    margin-bottom: 15px;
    background: #fff;
    border-bottom: 1px solid #e8eaec;

    .layout-page-header-title {
      color: #17233d;
      font-weight: 500;
      font-size: 20px;
      margin-bottom: 8px;
    }

    .layout-page-header-description {
      font-size: 14px;
      margin-bottom: 15px;
    }
  }
}
.admin-footer {
  text-align: center;
  color: #808695;
  margin: 30px 0;
  .footer-links {
    a {
      color: unset;
      span {
        margin: 5px 20px;
      }
    }
  }
}
.setting-item {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 12px 0;
}
</style>
