<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use Spatie\Analytics\AnalyticsFacade as Analytics;
use Spatie\Analytics\Period;

class TotalVisitorAndPage
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
    {

        $day = 30;
        //fetch visitors and page views for the past week
        //fetch visitors and page views for the past week
        $fetchTotalVisitorsAndPageViews = Analytics::fetchTotalVisitorsAndPageViews(Period::days($day));

        $dates = array();
        $visitors = array();
        $pageViews = array();
        foreach($fetchTotalVisitorsAndPageViews as $item){
            $date = Carbon::parse($item['date']);
            array_push($dates,$date->isoFormat('dddd D'));
            array_push($visitors,$item['visitors']);
            array_push($pageViews,$item['pageViews']);
        }

        return $this->chart->horizontalBarChart()
            ->setTitle('Total Vistors and page views')
            ->setSubtitle('In Previews '.$day.' days')
            ->setColors(['#ef233c', '#457b9d'])
            ->addData('Visitors',  $visitors)
            ->addData('Page Views', $pageViews)
            ->setXAxis($dates);
    }
}
