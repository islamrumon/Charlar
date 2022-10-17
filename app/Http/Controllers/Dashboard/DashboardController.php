<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Models\PlaneAssign;
use App\Models\PlanePayments;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class DashboardController extends Controller
{
    public function index()
    {
      

        return view('dashboard.home.index');
    }
}
