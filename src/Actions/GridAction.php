<?php


namespace SmallRuralDog\Admin\Actions;


class GridAction extends Action
{


    public function getResource()
    {
        return url(request()->getPathInfo());
    }

    public function getRoutePath()
    {
        return "{{route.path}}";
    }
}
