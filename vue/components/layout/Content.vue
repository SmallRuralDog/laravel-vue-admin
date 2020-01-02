<template>
  <el-container>
    <el-aside ref="contentSide" class="content-side side-dark" :width="isCollapsed?'64px':'200px'">
      <div class="content-side-logo">
        <img :src="page_data.logo" v-if="!isCollapsed" />
        <img :src="page_data.logoMini" v-else />
      </div>
      <el-scrollbar wrap-class="scrollbar-wrapper">
        <el-menu
          :default-active="page_data.url_current"
          :collapse="isCollapsed"
          background-color="#1d1e23"
          text-color="#fff"
          :collapse-transition="false"
          unique-opened
        >
          <template v-for="menu in page_data.menu">
            <el-submenu
              :index="menu.url"
              v-if="menu.children && menu.children.length>0"
              :key="menu.id"
            >
              <template slot="title">
                <i class="el-icon-setting" size="16"></i>
                <span>{{menu.title}}</span>
              </template>
              <a :href="sub_menu.url" v-for="sub_menu in menu.children" :key="sub_menu.id">
                <el-menu-item :index="sub_menu.url">
                  <i v-show="isCollapsed" class="el-icon-setting"></i>
                  <span slot="title">{{sub_menu.title}}</span>
                </el-menu-item>
              </a>
            </el-submenu>
            <a :href="menu.url" v-else :key="menu.id">
              <el-menu-item :index="menu.url">
                <i class="el-icon-setting" size="16"></i>
                <span slot="title">{{menu.title}}</span>
              </el-menu-item>
            </a>
          </template>
        </el-menu>
      </el-scrollbar>
    </el-aside>
    <el-container>
      <el-header :style="{padding: 0}" class="layout-header-bar" height="44px">
        <div class="layout-header-l">
          <div class="layout-header-trigger hover" @click="collapsedSide">
            <i class="el-icon-s-fold fs-20 menu-icon" :class="{'rotate-icon':isCollapsed}" />
          </div>
          <div class="layout-header-breadcrumb"></div>
        </div>
        <div class="layout-header-r">
          <span class="layout-header-trigger layout-header-trigger-min hover">
            <el-dropdown>
              <div class="layout-header-user">
                <el-avatar :src="page_data.user.avatar" :size="30" />
                <span class="layout-header-user-name">{{page_data.user.name}}</span>
              </div>
              <el-dropdown-menu slot="dropdown">
                <a>
                  <el-dropdown-item>
                    <i class="el-icon-user" size="18" />
                    <span>个人中心</span>
                  </el-dropdown-item>
                </a>
                <a :href="page_data.url.setting">
                  <el-dropdown-item>
                    <i class="el-icon-setting" size="18" />
                    <span>设置</span>
                  </el-dropdown-item>
                </a>
                <a @click="onLogout">
                  <el-dropdown-item divided>
                    <i class="el-icon-right" size="18" />
                    <span>退出登陆</span>
                  </el-dropdown-item>
                </a>
              </el-dropdown-menu>
            </el-dropdown>
          </span>
        </div>
      </el-header>
      <el-main>
        <div class="layout-content-main">
          <div class="layout-page-header" v-if="page_data.showPageHeader">
            <div class="layout-page-header-title">{{page_data.title}}</div>
            <div class="layout-page-header-description">{{page_data.description}}</div>
          </div>
          <slot></slot>
        </div>
      </el-main>
    </el-container>
  </el-container>
</template>

<script>
export default {
  props: {
    page_data: Object
  },
  data() {
    return {
      isCollapsed: false
    };
  },
  computed: {
    menuitemClasses() {
      return ["menu-item", this.isCollapsed ? "collapsed-menu" : ""];
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
  }
};
</script>

<style lang="scss" >
$header-bar-height:44px;
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
  transition: width 0.2s;
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

.side-dark {
  background: #1d1e23;
  box-shadow: 2px 0 6px rgba(0, 21, 41, 0.35);
}
.layout-header-bar {
  width: 100%;
  background: #fff;
  padding: 0;
  box-shadow: 0 1px 4px rgba(0, 21, 41, 0.08);
  transition: all 0.2s ease-in-out;
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
        transition-duration: 0.2s;
        transform: rotate(0deg);
      }

      .rotate-icon {
        transform: rotate(180deg);
      }
    }

    .layout-header-breadcrumb {
      margin-left: 10px;
    }
  }

  .layout-header-r {
    height: $header-bar-height;

    .layout-header-trigger {
      display: inline-block;
      width: $header-bar-height;
      height: $header-bar-height;
      text-align: center;
      cursor: pointer;
      transition: all 0.2s ease-in-out;
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
  }
}
.el-main {
  padding: 0;
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
</style>
