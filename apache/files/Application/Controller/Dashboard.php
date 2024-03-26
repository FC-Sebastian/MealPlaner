<?php

namespace Controller;

class Dashboard extends BaseController
{
    protected $view = 'dashboard/index';
    protected $title = 'Dashboard';
    protected $activeHeader = 'dash';

    public function getRecipes()
    {
        $recipe = new \Model\Recipe();
        return $recipe->loadAll();
    }

    public function getDays()
    {

        $day = date('w');
        $dayCounter = 0;

        $row = '<div class="col-12 d-flex justify-content-around">';
        for ($i = 1; $i <= 7; $i++) {
            if ($i >= $day) {
                $row .= '<div class="h-4rem bg-light flex-fill border"><input type="hidden" value="'.date('Y').'-'.date('m').'-'.date("d")+$dayCounter.'"></div>';
                $dayCounter++;
            } else {
                $row .= '<div class="bg-secondary h-4rem flex-fill border"></div>';
            }
        }
        $row .= '</div><div class="col-12 d-flex justify-content-around">';
        for ($i = 1; $i <= 7; $i++) {
            $row .= '<div class="h-4rem bg-light flex-fill border"><input type="hidden" value="'.date('Y').'-'.date('m').'-'.date("d")+$dayCounter.'"></div>';
            $dayCounter++;
        }
        $row .= '</div>';
        return $row;
    }
}