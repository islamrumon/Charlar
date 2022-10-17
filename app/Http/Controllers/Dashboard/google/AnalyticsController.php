<?php

namespace App\Http\Controllers\Dashboard\google;

use App\Charts\MostVisitedPages;
use App\Charts\TopBrowsers;
use App\Charts\TopReferrer;
use App\Charts\TotalVisitorAndPage;
use App\Charts\Visitor;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

use Spatie\Analytics\AnalyticsFacade as Analytics;
use Spatie\Analytics\Period;


class AnalyticsController extends Controller
{



    public function googleAnalytics()
    {
        return view('dashboard.google.analytics');
    }

    public function googleAnalyticsStore(Request $request)
    {


        overWriteEnvFile('ANALYTICS_VIEW_ID', $request->ANALYTICS_VIEW_ID);
        overWriteEnvFile('ANALYTICS_GTAG_ID', $request->ANALYTICS_GTAG_ID);
        setSystemSetting('google_analytics_active', $request->google_analytics_active);
        if ($request->hasFile('credentials_json')) {
            fileUploadWithName($request->credentials_json,  'google_analytics','json');
        }

        if ($request->hasFile('domain_verify')) {
            fileUploadWithName($request->credentials_json,  basename($request->credentials_json),'html');
        }

        return back()->with([
            'message' => translate('Google analytics successfully updated'),
            'type' => 'success',
            'title' => translate('Success')
        ]);
    }

    public function index(
        Visitor $visitorChart,
        TopReferrer $topReferrer,
        TopBrowsers $topBrowsers,
        TotalVisitorAndPage $totalVisitorAndPage
    ) {

        try{
            $day = 30;
            $fetchMostVisitedPages = Analytics::fetchMostVisitedPages(Period::days($day));
            $fetchTotalVisitorsAndPageViews = Analytics::fetchTotalVisitorsAndPageViews(Period::days($day));




            return view(
                'dashboard.analytics',
                [
                    'visitor' => $visitorChart->build(),
                    'fetchMostVisitedPages' => $fetchMostVisitedPages,
                    'fetchTotalVisitorsAndPageViews' => $fetchTotalVisitorsAndPageViews,
                    'totalVisitorAndPage' => $totalVisitorAndPage->build(),
                    'topBrowsers' => $topBrowsers->build(),
                    'topReffer' => $topReferrer->build()
                ]
            );
        }catch(Exception $exception){
            return view('dashboard.analytics',['no_data'=>'no_date']);
        }

    }
}
