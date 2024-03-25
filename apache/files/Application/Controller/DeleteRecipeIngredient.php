<?php

namespace Controller;

class DeleteRecipeIngredient extends AjaxSqlQueryController
{

    protected function executeSqlQuery()
    {
        $id = $this->getRequestParameter('id');
        if (!empty($id)) {
            $recipe2Ingredient = new \Model\Recipe2Ingredient();
            $recipe2Ingredient->delete($id);
        }
    }
}