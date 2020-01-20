<?php

namespace SmallRuralDog\Admin\Controllers;

use DateTime;
use Illuminate\Routing\Controller;
use Illuminate\Support\Arr;
use SmallRuralDog\Admin\Admin;

class StyleController extends Controller
{

    public function show($style)
    {
        $path = Arr::get(Admin::styles(), $style);
        abort_if(is_null($path), 404);
        return response(
            file_get_contents($path),
            200,
            [
                'Content-Type' => 'text/css',
            ]
        )->setLastModified(DateTime::createFromFormat('U', filemtime($path)));
    }
}
