<?php

namespace SmallRuralDog\Admin\Controllers;

use DateTime;
use Illuminate\Routing\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use SmallRuralDog\Admin\Admin;

class ScriptController extends Controller
{
    public function show($script)
    {
        $path = Arr::get(Admin::scripts(), $script);

        abort_if(is_null($path), 404);

        return response(
            file_get_contents($path),
            200,
            [
                'Content-Type' => 'application/javascript',
            ]
        )->setLastModified(DateTime::createFromFormat('U', filemtime($path)));
    }
}
