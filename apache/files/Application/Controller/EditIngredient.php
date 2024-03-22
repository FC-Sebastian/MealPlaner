<?php

namespace Controller;

class EditIngredient extends BaseController
{
    protected $view = 'ingredient/edit';
    protected $title = 'Zutat bearbeiten';

    public $edit = null;

    public function save()
    {
        $ingredient = new \Model\Ingredient();
        if ($id = $this->getRequestParameter('id') !== false) {
            $ingredient->setId($id);
        }
        $ingredient->setIngredient($this->getRequestParameter('ingredient'));
        $ingredient->save();

        $this->edit = $ingredient;

        if (!$id) {
            $id = $ingredient->getIdByName('name');
        }

        $buyOptions = $this->getRequestParameter('buyOption');

        foreach ($buyOptions as $buyOption) {
            $ingredient2amount = new \Model\Ingredient2amount();

            $data = ['ingredient_id' => $ingredient->getId(), 'price' => $buyOption['price'], 'amount' => $buyOption['amount'], 'unit' => $buyOption['unit']];
            if (isset($buyOption['id'])) {
                $data['id'] = $buyOption['id'];
            }
            $ingredient2amount->assign($data);
            $ingredient2amount->save();
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