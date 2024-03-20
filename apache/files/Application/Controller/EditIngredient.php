<?php

namespace Controller;

class EditIngredient extends BaseController
{
    protected $view = 'ingredient/edit';
    protected $title = 'Zutat bearbeiten';

    public function getUnits()
    {
        $unit = new \Model\Unit();
        return $unit->loadAll();
    }
}