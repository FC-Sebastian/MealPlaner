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

        $row = '<tr>';
        for ($i = 1; $i <= 7; $i++) {
            if ($i >= $day) {
                $row .= '<td class="h4rem"><input type="hidden" value="'.date('Y').'-'.date('m').'-'.date("d")+$dayCounter.'"></tdclas>';
                $dayCounter++;
            } else {
                $row .= '<td class="bg-dark bg-opacity-25"></td>';
            }
        }
        $row .= '</tr><tr>';
        for ($i = 1; $i <= 7; $i++) {
            $row .= '<td class="h4rem"><input type="hidden" value="'.date('Y').'-'.date('m').'-'.date("d")+$dayCounter.'"></td>';
            $dayCounter++;
        }
        $row .= '</tr>';
        $row .= '</tr><tr>';
        for ($i = 1; $i <= 7; $i++) {
            $row .= '<td class="h4rem"><input type="hidden" value="'.date('Y').'-'.date('m').'-'.date("d")+$dayCounter.'"></td>';
            $dayCounter++;
        }
        $row .= '</tr>';
        return $row;
    }
}