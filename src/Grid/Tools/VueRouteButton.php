<?php


namespace SmallRuralDog\Admin\Grid\Tools;


use SmallRuralDog\Admin\Actions\BaseAction;
use SmallRuralDog\Admin\Components\Attrs\Button;

class VueRouteButton extends BaseAction
{
    use Button;

    protected $vueRoute;
    protected $componentName = "VueRouteButton";

    /**
     * VueRouteButton constructor.
     * @param $vueRoute
     * @param $content
     */
    public function __construct($vueRoute, $content)
    {
        $this->vueRoute = $vueRoute;
        $this->content = $content;
    }

    /**
     * @param $vueRoute
     * @param $content
     * @return VueRouteButton
     */
    public static function make($vueRoute, $content)
    {
        return new VueRouteButton($vueRoute, $content);
    }

}
