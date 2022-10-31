<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Spatie\Analytics\AnalyticsFacade as Analytics;
use Spatie\Analytics\Period;

class TopBrowsers
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
    {

        // Heatmap Chart
        // Horizontal Bar Chart
        $day = 30;
        $fetchTopBrowsers = Analytics::fetchTopBrowsers(Period::days($day));

        $labels = array();
        $datas = array();
        foreach($fetchTopBrowsers as $item){
           array_push($labels,$item['browser']);
           array_push($datas,$item['sessions']);
        }

        return $this->chart
            ->polarAreaChart()
            ->setTitle('Top Browser to browse the.',getSystemSetting('type_name'))
            ->setSubtitle('In Previews '.$day.' days')
            ->addData($datas)
            ->setLabels($labels);
    }
}
