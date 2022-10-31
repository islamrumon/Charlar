<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Spatie\Analytics\AnalyticsFacade as Analytics;
use Spatie\Analytics\Period;

class TopReferrer
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
    {

        $day = 30;
        $fetchTopReferrers = Analytics::fetchTopReferrers(Period::days($day));

        $labels = array();
        $datas = array();
        foreach($fetchTopReferrers as $item){
             array_push($labels,$item['url']);
             array_push($datas,$item['pageViews']);
        }

        return $this->chart->pieChart()
            ->setTitle('Top Refferrer to access the web site.')
            ->setSubtitle('In Previews '.$day.' days')
            ->addData($datas)
            ->setLabels($labels);
    }
}
