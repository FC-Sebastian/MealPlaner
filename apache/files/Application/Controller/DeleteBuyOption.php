<?php

namespace Controller;

class DeleteBuyOption extends AjaxSqlQueryController
{

    protected function executeSqlQuery()
    {
        $id = $this->getRequestParameter('id');
        if (!empty($id)) {
            $ingredient2amount = new \Model\Ingredient2amount();
            $ingredient2amount->delete($id);
        }
    }
}