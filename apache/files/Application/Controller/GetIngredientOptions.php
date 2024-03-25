<?php

namespace Controller;

class GetIngredientOptions extends JSONController
{

    protected function getJsonData()
    {
        $ingredient = new \Model\Ingredient;

        return $this->getOptions($ingredient->loadAll(), 'getIngredient');
    }
}