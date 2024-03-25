<?php

namespace Controller;

class EditRecipe extends BaseController
{
    protected $view = 'recipe/edit';
    protected $title = 'Rezept bearbeiten';

    public $edit = null;

    public function getIngredients()
    {
        $ingredient = new \Model\Ingredient();
        return $ingredient->loadAll();
    }

    public function save()
    {
        $recipe = new \Model\Recipe();
        if ($id = $this->getRequestParameter('id') !== false) {
            $recipe->setId($id);
        }
        $recipe->setTitle($this->getRequestParameter('title'));
        $recipe->setRecipe($this->getRequestParameter('recipe'));
        $recipe->setPortions($this->getRequestParameter('portions'));
        $recipe->save();

        $this->edit = $recipe;

        $ingredients = $this->getRequestParameter('ingredient');

        foreach ($ingredients as $ingredient) {
            $recipe2Ingredient = new \Model\Recipe2Ingredient();

            $data = ['recipe_id' => $recipe->getId(), 'ingredient_id' => $ingredient['ingredient'], 'amount' => $ingredient['amount'], 'unit' => $ingredient['unit']];
            if (isset($ingredient['id'])) {
                $data['id'] = $ingredient['id'];
            }
            $recipe2Ingredient->assign($data);
            $recipe2Ingredient->save();
        }
    }

    public function render()
    {
        if ($id = $this->getRequestParameter('id')) {
            $ingredient = new \Model\Ingredient();
            $ingredient->load($id);

            $this->edit = $ingredient;
        }
        parent::render();
    }
}