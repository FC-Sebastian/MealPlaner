<?php

namespace Controller;

class GetIngredientOptions extends JSONController
{

    protected function getJsonData()
    {
        $ingredientCount = $this->getRequestParameter('count');

        return $this->getIngredientsCheck($ingredientCount);
    }

    protected function getIngredientsCheck($ingredientCount)
    {
        $ingredient = new \Model\Ingredient;
        $ingredients = $ingredient->loadAll();

        $return = [];
        for ($i = 0; $i < count($ingredients); $i++) {
            $return[] = "<div class='bg-dark text-center rounded my-2 mx-1 p-2'><img class='rounded h-6rem d-block mb-2' src='{$this->getUrl("img/giphy.gif")}'><input class='btn-check' type='radio' name='ingredient[{$ingredientCount}][ingredient]' id='ingredient[{$ingredientCount}][ingredient]{$i}' value='{$ingredients[$i]->getId()}'><label class='btn btn-outline-primary' for='ingredient[{$ingredientCount}][ingredient]{$i}'>{$ingredients[$i]->getIngredient()}</label></div>";
        }
        return $return;
    }
}