<?php
namespace SmallRuralDog\Admin\Controllers;


trait HasResourceActions
{

    public function update($id)
    {
        return $this->form(true)->update($id);
    }

    public function store()
    {
        return $this->form()->store();
    }

    public function destroy($id)
    {
        return $this->form()->destroy($id);
    }
}
