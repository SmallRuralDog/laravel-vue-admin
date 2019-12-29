<template>

    <Layout>
        <Sider ref="contentSide" class="content-side side-dark" hide-trigger collapsible :collapsed-width="78"
               v-model="isCollapsed">
            <div class="content-side-logo">
                <img :src="page_data.logo" v-if="!isCollapsed">
                <img :src="page_data.logoMini" v-else>
            </div>
            <Menu :active-name="1" theme="dark" width="auto" :class="menuitemClasses" accordion>
                <template v-for="menu in page_data.menu">
                    <Submenu :name="menu.id" v-if="menu.children && menu.children.length>0" :key="menu.id">
                        <template slot="title">
                            <Icon type="ios-navigate" size="16"></Icon>
                            <span>{{menu.title}}</span>
                        </template>
                        <MenuItem :name="sub_menu.id" v-for="sub_menu in menu.children" :key="sub_menu.id">
                            <Icon v-if="false" type="ios-navigate"></Icon>
                            <span>{{sub_menu.title}}</span>
                        </MenuItem>
                    </Submenu>
                    <MenuItem :name="menu.id" v-else>
                        <Icon type="ios-navigate" size="16"></Icon>
                        <span>{{menu.title}}</span>
                    </MenuItem>
                </template>
            </Menu>
        </Sider>
        <Layout>
            <Header :style="{padding: 0}" class="layout-header-bar">
                <div class="layout-header-l">
                    <div class="layout-header-trigger hover" @click="collapsedSide">
                        <Icon type="md-menu menu-icon" size="25" :class="{'rotate-icon':isCollapsed}"/>
                    </div>
                    <div class="layout-header-breadcrumb">
                        <Breadcrumb>
                            <BreadcrumbItem>首页</BreadcrumbItem>
                        </Breadcrumb>
                    </div>
                </div>
                <div class="layout-header-r">
                    <span class="layout-header-trigger layout-header-trigger-min hover">
                        <Dropdown>
                            <div>
                                <Avatar :src="page_data.user.avatar"/>
                                <span class="layout-header-user-name">{{page_data.user.name}}</span>
                            </div>
                            <DropdownMenu slot="list">
                                <a>
                                <DropdownItem>
                                        <Icon type="ios-contact-outline" size="18"/>
                                        <span>个人中心</span>
                                </DropdownItem>
                                    </a>
                                <a :href="page_data.url.setting">
                                    <DropdownItem>
                                    <Icon type="ios-settings-outline" size="18"/>
                                    <span>设置</span>
                                </DropdownItem>
                                </a>
 <a @click="onLogout">
                                <DropdownItem divided>
                                     <Icon type="ios-log-out" size="18"/>
                                    <span>退出登陆</span>
                                </DropdownItem>
     </a>
                            </DropdownMenu>
                        </Dropdown>
                    </span>
                </div>
            </Header>
            <Content>
                <div class="layout-content-main">
                    <div class="layout-page-header" v-if="page_data.showPageHeader">
                        <div class="layout-page-header-title">{{page_data.title}}</div>
                        <div class="layout-page-header-description">{{page_data.description}}</div>
                    </div>
                    <slot></slot>
                </div>

            </Content>
        </Layout>
    </Layout>

</template>

<script>
    export default {
        props: {
            page_data: Object
        },
        data() {
            return {
                isCollapsed: false
            }
        },
        computed: {
            menuitemClasses() {
                return [
                    'menu-item',
                    this.isCollapsed ? 'collapsed-menu' : ''
                ]
            }
        },
        methods: {
            collapsedSide() {
                this.$refs.contentSide.toggleCollapse();
            },
            onLogout() {
                this.$Modal.confirm({
                    title: '退出登陆确认',
                    content: '您确定退出登录当前账户吗？',
                    onOk: () => {
                        window.location.href = this.page_data.url.logout
                    }
                })
            }
        }
    }
</script>

<style lang="scss">
    .ivu-layout-sider {
        min-height: 100vh;

        .ivu-layout-sider-children {
            height: 100%;
            padding-top: .1px;
            margin-top: -.1px;
        }
    }


    .layout-header-bar {
        width: 100%;
        background: #fff;
        padding: 0;
        box-shadow: 0 1px 4px rgba(0, 21, 41, .08);
        transition: all .2s ease-in-out;
        z-index: 3;
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 54px;
        line-height: 54px;

        .hover {
            &:hover {
                background-color: #f7f7f7;
            }
        }

        .layout-header-l {
            display: flex;
            height: 54px;

            .layout-header-trigger {
                width: 54px;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;

                .menu-icon {
                    transition-duration: 0.5s;
                }

                .rotate-icon {
                    transform: rotate(90deg);
                }
            }

            .layout-header-breadcrumb {
                margin-left: 10px;

                .ivu-breadcrumb {
                    font-size: 12px;

                }

                .ivu-breadcrumb-item-separator {
                    margin: 0 4px;
                }
            }
        }

        .layout-header-r {
            height: 54px;

            .layout-header-trigger {
                display: inline-block;
                width: 54px;
                height: 54px;
                text-align: center;
                cursor: pointer;
                transition: all .2s ease-in-out;
            }

            .layout-header-trigger-min {
                width: auto;
                padding: 0 12px;
            }

            .layout-header-user-name {
                margin-left: 5px;
            }

            .ivu-dropdown-item {
                font-size: 14px !important;
                text-align: left;
            }
        }
    }

    .layout-content-main {
        margin: 24px;

        .layout-page-header {
            margin: -24px -24px 0;
            padding: 16px 32px 0 32px;
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
