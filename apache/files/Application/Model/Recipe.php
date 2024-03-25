<?php

namespace Model;

class Recipe extends BaseModel
{
    protected $tablename = 'recipes';

    public function getIngredients()
    {
        $oRecipe2Ingredient = new Recipe2Ingredient();
        return $oRecipe2Ingredient->loadByColumnValue('recipe_id', $this->getId());
    }
}