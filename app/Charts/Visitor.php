<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Spatie\Analytics\AnalyticsFacade as Analytics;
use Spatie\Analytics\Period;

class Visitor
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
    {
         $day = 30;
       
        $fetchUserTypes = Analytics::fetchUserTypes(Period::days($day));


        $labels = array();
        $datas = array();
        foreach($fetchUserTypes as $item){
           array_push($labels,$item['type']);
           array_push($datas,$item['sessions']);
        }

        return $this->chart->donutChart()
            ->setTitle('Visitors')
            ->setSubtitle('In Previews '.$day.' days')
            ->addData($datas)
            ->setLabels($labels);
    }
}
