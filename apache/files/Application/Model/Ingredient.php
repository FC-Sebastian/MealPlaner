<?php

namespace Model;

class Ingredient extends BaseModel
{
    protected $tablename = 'ingredients';

    public function getBuyOptions()
    {
        $ingredient2amount = new Ingredient2amount();
        return $ingredient2amount->loadByColumnValue('ingredient_id', $this->getId());
    }
}