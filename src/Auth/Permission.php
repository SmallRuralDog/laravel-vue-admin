<?php

namespace SmallRuralDog\Admin\Auth;


use SmallRuralDog\Admin\Facades\Admin;

class Permission
{
    /**
     * Check permission.
     *
     * @param $permission
     *
     * @return true
     */
    public static function check($permission)
    {
        if (static::isAdministrator()) {
            return true;
        }

        if (is_array($permission)) {
            collect($permission)->each(function ($permission) {
                call_user_func([self::class, 'check'], $permission);
            });

            return;
        }

        if (Admin::user()->cannot($permission)) {
            static::error();
        }
    }

    /**
     * Roles allowed to access.
     *
     * @param $roles
     *
     * @return true
     */
    public static function allow($roles)
    {
        if (static::isAdministrator()) {
            return true;
        }

        if (!Admin::user()->inRoles($roles)) {
            static::error();
        }
    }

    /**
     * Don't check permission.
     *
     * @return bool
     */
    public static function free()
    {
        return true;
    }

    /**
     * Roles denied to access.
     *
     * @param $roles
     *
     * @return true
     */
    public static function deny($roles)
    {
        if (static::isAdministrator()) {
            return true;
        }

        if (Admin::user()->inRoles($roles)) {
            static::error();
        }
    }

    /**
     * Send error response page.
     */
    public static function error()
    {


        if (!request()->pjax() && request()->ajax()) {
            abort(403, trans('admin.deny'));
        }

        // return Admin::responseError(trans('admin.deny'));


    }

    /**
     * If current user is administrator.
     *
     * @return mixed
     */
    public static function isAdministrator()
    {
        return Admin::user()->isRole('administrator');
    }
}
