<?php

namespace Controller;

class GetUnitOptions extends JSONController
{

    protected function getJsonData()
    {
        $unit = new \Model\Unit();

        return $this->getOptions($unit->loadAll(), 'getName');
    }
}