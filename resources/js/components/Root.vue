<template>
  <div class="admin-main">
    <el-container class="admin-layout">
      <el-aside
        ref="contentSide"
        class="content-side"
        :class="{ 'content-side-fixed': fixedSide, 'side-dark': isDark }"
        :width="isCollapsed ? '64px' : '200px'"
      >
        <div class="content-side-logo">
          <template v-if="page_data.logoShow">
            <template v-if="isDark">
              <template v-if="page_data.logoLight">
                <img v-if="isCollapsed" :src="page_data.logoMiniLight" />
                <img :src="page_data.logoLight" />
              </template>
              <template v-else>
                <img v-if="isCollapsed" src="../assets/logo-mini-light.svg" />
                <img v-else src="../assets/logo-light.svg" />
              </template>
            </template>
            <template v-else>
              <template v-if="page_data.logo">
                <img v-if="isCollapsed" :src="page_data.logoMini" />
                <img :src="page_data.logo" />
              </template>
              <template v-else>
                <img v-if="isCollapsed" src="../assets/logo-mini.svg" />
                <img v-else src="../assets/logo.svg" />
              </template>
            </template>
          </template>
          <h1 v-if="!isCollapsed && page_data.name">{{ page_data.name }}</h1>
        </div>
        <el-scrollbar wrap-class="scrollbar-wrapper" wrap-style=" width: 0 ">
          <el-menu
            :default-active="route"
            :collapse="isCollapsed"
            :background-color="isDark ? '#1d1e23' : ''"
            :text-color="isDark ? '#ffffff' : ''"
            :collapse-transition="false"
            :router="true"
          >
            <template v-for="menu in page_data.menu">
              <MenuItem
                :menu="menu"
                :key="menu.id"
                :is_collapsed="isCollapsed"
              />
            </template>
          </el-menu>
        </el-scrollbar>
      </el-aside>
      <el-container
        :class="{
          'el-container-fixed': fixedSide,
          'el-container-fixed-collapsed': isCollapsed
        }"
      >
        <el-header
          :style="{ padding: 0 }"
          class="layout-header-bar"
          :class="{
            'layout-header-bar-dark': isDarkHeader,
            'layout-header-bar-fixed': fixedHeader,
            'layout-header-bar-fixed-collapsed': isCollapsed
          }"
          height="55px"
        >
          <div class="layout-header-l">
            <div class="layout-header-trigger hover" @click="collapsedSide">
              <i
                class="el-icon-s-fold fs-20 menu-icon"
                :class="{ 'rotate-icon': isCollapsed }"
              />
            </div>
            <div class="layout-header-breadcrumb">
              <el-breadcrumb separator="/">
                <el-breadcrumb-item :to="{ path: '/' }"
                  >首页</el-breadcrumb-item
                >
                <template v-for="menu in page_data.menuList">
                  <el-breadcrumb-item
                    v-if="menu.route == route"
                    :key="menu.route"
                    >{{ menu.title }}</el-breadcrumb-item
                  >
                </template>
              </el-breadcrumb>
            </div>
          </div>
          <div class="layout-header-r">
            <el-tooltip class="item" effect="dark" content="刷新">
              <div
                @click="pageReload"
                class="layout-header-trigger layout-header-trigger-min hover"
              >
                <i class="el-icon-refresh-right icon-btn"></i>
              </div>
            </el-tooltip>
            <div class="layout-header-trigger layout-header-trigger-min hover">
              <el-dropdown>
                <div class="layout-header-user">
                  <el-avatar :src="page_data.user.avatar" :size="25" />
                  <span class="layout-header-user-name">{{
                    page_data.user.name
                  }}</span>
                </div>
                <el-dropdown-menu slot="dropdown">
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
              @click="showAdminSet = true"
              class="layout-header-trigger layout-header-trigger-min hover"
            >
              <i class="el-icon-setting icon-btn"></i>
            </div>
          </div>
        </el-header>
        <el-main :class="{ 'el-main-fixed': fixedHeader }">
          <div class="layout-content-main">
            <router-view></router-view>
          </div>
        </el-main>
        <el-footer class="admin-footer">
          <div class="footer-links">
            <el-link
              v-for="(item, index) in page_data.footerLinks"
              :key="index"
              type="text"
              :href="item.href"
              target="_blank"
              :underline="false"
              >{{ item.title }}</el-link
            >
          </div>
          <div v-html="page_data.copyright"></div>
        </el-footer>
      </el-container>
    </el-container>
    <el-backtop></el-backtop>
    <el-drawer :visible.sync="showAdminSet" size="250px">
      <div style="padding:0 10px;">
        <el-divider>主题风格</el-divider>
        <div>
          <el-badge type="success" is-dot :hidden="isDark">
            <div>
              <el-tooltip content="亮色菜单风格" placement="top">
                <img
                  @click="isDark = false"
                  class="hover"
                  src="../assets/menu-light.svg"
                />
              </el-tooltip>
            </div>
          </el-badge>
          <el-badge type="success" is-dot :hidden="!isDark">
            <div class="ml-20">
              <el-tooltip content="暗色菜单风格" placement="top">
                <img
                  @click="isDark = true"
                  class="hover"
                  src="../assets/menu-dark.svg"
                />
              </el-tooltip>
            </div>
          </el-badge>
        </div>
        <div class="mt-30">
          <el-badge type="success" is-dot :hidden="isDarkHeader">
            <div @click="isDarkHeader = false">
              <el-tooltip content="亮色顶栏风格" placement="top">
                <img class="hover" src="../assets/nav-light.svg" />
              </el-tooltip>
            </div>
          </el-badge>
          <el-badge type="success" is-dot :hidden="!isDarkHeader">
            <div class="ml-20" @click="isDarkHeader = true">
              <el-tooltip content="暗色顶栏风格" placement="top">
                <img class="hover" src="../assets/nav-dark.svg" />
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
      </div>
    </el-drawer>
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
        : true,
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
  destroyed() {
    this.$bus.off("route-after");
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
    pageReload() {
      this.$bus.emit("pageReload");
    },
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

<style lang="scss">
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
      height: 30px;
      object-fit: cover;
      vertical-align: middle;
    }
    h1 {
      display: inline-block;
      margin: 0 0 0 5px;
      color: #666;
      font-weight: 600;
      font-size: 20px;
      vertical-align: middle;
      animation: fade-in;
      animation-duration: 0.3s;
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
  bottom: 0;
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
  .content-side-logo {
    h1 {
      color: #ffffff;
    }
  }
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
  z-index: 999;
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
  margin: 0px;

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
  margin: 10px 0;
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
.el-drawer__header {
  margin-bottom: 0;
}
</style>
