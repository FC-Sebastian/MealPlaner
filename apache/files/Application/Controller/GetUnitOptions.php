<?php

namespace Controller;

class GetUnitOptions extends JSONController
{

    protected function getJsonData()
    {
        return $this->getUnitOption();
    }

    protected function getUnitOption()
    {
        $unit = new \Model\Unit();
        $return = [];

        foreach ($unit->loadAll() as $unt) {
            $return[] = "<option value='".$unt->getId()."'>".$unt->getName()."</option>";
        }
        return $return;
    }
}