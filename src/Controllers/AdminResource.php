<?php


namespace SmallRuralDog\Admin\Controllers;


interface AdminResource
{
    public function grid();

    public function form($isEdit = false, $isDialog = false);

}
