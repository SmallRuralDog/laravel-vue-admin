<?php


namespace SmallRuralDog\Admin\Form;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use SmallRuralDog\Admin\Form;

class Model
{
    /**
     * Eloquent model instance of the grid model.
     *
     * @var EloquentModel|Builder
     */
    protected $model;

    /**
     * @var EloquentModel|Builder
     */
    protected $originalModel;

    /**
     * @var Form
     */
    protected $form;

    public function __construct(EloquentModel $model, Form $form = null)
    {
        $this->model = $model;
        $this->originalModel = $model;
        $this->form = $form;
    }


    public function editData(){


        return $this->model->findOrFail($this->form->getResourceId());
    }

}
