<?php

use Illuminate\Support\MessageBag;
use SmallRuralDog\Admin\Components\Widgets\Html;
use SmallRuralDog\Admin\Layout\Content;

if (!function_exists('admin_path')) {

    /**
     * Get admin path.
     *
     * @param string $path
     *
     * @return string
     */
    function admin_path($path = '')
    {
        return ucfirst(config('admin.directory')) . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}

if (!function_exists('admin_base_path')) {
    /**
     * Get admin url.
     *
     * @param string $path
     *
     * @return string
     */
    function admin_base_path($path = '')
    {
        $prefix = '/' . trim(config('admin.route.prefix'), '/');

        $prefix = ($prefix == '/') ? '' : $prefix;

        $path = trim($path, '/');

        if (is_null($path) || strlen($path) == 0) {
            return $prefix ?: '/';
        }

        return $prefix . '/' . $path;
    }
}

if (!function_exists('admin_api_base_path')) {
    /**
     * Get admin url.
     *
     * @param string $path
     *
     * @return string
     */
    function admin_api_base_path($path = '')
    {
        $prefix = '/' . trim(config('admin.route.prefix_api'), '/');

        $prefix = ($prefix == '/') ? '' : $prefix;

        $path = trim($path, '/');

        if (is_null($path) || strlen($path) == 0) {
            return $prefix ?: '/';
        }

        return $prefix . '/' . $path;
    }
}

if (!function_exists('admin_url')) {
    /**
     * Get admin url.
     *
     * @param string $path
     * @param mixed $parameters
     * @param bool $secure
     *
     * @return string
     */
    function admin_url($path = '', $parameters = [], $secure = null)
    {
        if (\Illuminate\Support\Facades\URL::isValidUrl($path)) {
            return $path;
        }
        $secure = $secure ?: (config('admin.https') || config('admin.secure'));
        return url(admin_base_path($path), $parameters, $secure);
    }
}

if (!function_exists('admin_api_url')) {
    /**
     * Get admin url.
     *
     * @param string $path
     * @param mixed $parameters
     * @param bool $secure
     *
     * @return string
     */
    function admin_api_url($path = '', $parameters = [], $secure = null)
    {
        if (\Illuminate\Support\Facades\URL::isValidUrl($path)) {
            return $path;
        }
        $secure = $secure ?: (config('admin.https') || config('admin.secure'));
        return url(admin_api_base_path($path), $parameters, $secure);
    }
}

if (!function_exists('admin_file_url')) {
    function admin_file_url($path)
    {
        if (\Illuminate\Support\Str::contains($path, "//")) {
            return $path;
        }

        return \Storage::disk(config('admin.upload.disk'))->url($path);
    }
}
;

if (!function_exists('admin_toastr')) {

    /**
     * Flash a toastr message bag to session.
     *
     * @param string $message
     * @param string $type
     * @param array $options
     */
    function admin_toastr($message = '', $type = 'success', $options = [])
    {
        $toastr = new MessageBag(get_defined_vars());

        session()->flash('toastr', $toastr);
    }
}

if (!function_exists('admin_asset')) {

    /**
     * @param $path
     *
     * @return string
     */
    function admin_asset($path)
    {
        return (config('admin.https') || config('admin.secure')) ? secure_asset($path) : asset($path);
    }
}
if (!function_exists('instance_content')) {

    function instance_content($content = '')
    {
        if (is_string($content)) {
            return Html::make()->html($content);
        } elseif ($content instanceof \Closure) {
            $c_content = new Content();
            call_user_func($content, $c_content);
            return $c_content;
        } else {
            return $content;
        }
    }
}
