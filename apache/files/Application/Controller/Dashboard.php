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
            $sBorderClass = '';
            if ($i === 1) {
                $sBorderClass = 'border-start-0';
            } elseif ($i === 7) {
                $sBorderClass = 'border-end-0';
            }
            if ($i >= $day) {
                $row .= '<div class="h-4rem bg-light flex-fill border '. $sBorderClass .'"><input type="hidden" value="'.date('Y').'-'.date('m').'-'.date("d")+$dayCounter.'"></div>';
                $dayCounter++;
            } else {
                $row .= '<div class="bg-secondary h-4rem flex-fill border '. $sBorderClass .'"></div>';
            }
        }
        $row .= '</div><div class="col-12 d-flex justify-content-around">';
        for ($i = 1; $i <= 7; $i++) {
            $sBorderClass = '';
            if ($i === 1) {
                $sBorderClass = 'border-start-0';
            } elseif ($i === 7) {
                $sBorderClass = 'border-end-0';
            }
            $row .= '<div class="h-4rem bg-light flex-fill border border-bottom-0 '. $sBorderClass .'"><input type="hidden" value="'.date('Y').'-'.date('m').'-'.date("d")+$dayCounter.'"></div>';
            $dayCounter++;
        }
        $row .= '</div>';
        return $row;
    }
}