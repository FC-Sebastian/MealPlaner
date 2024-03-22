<?php

namespace Controller;

class EditRecipe extends BaseController
{
    protected $view = 'recipe/edit';
    protected $title = 'Rezept bearbeiten';

    public function getIngredients()
    {
        $ingredient = new \Model\Ingredient();
        return $ingredient->loadAll();
    }
}