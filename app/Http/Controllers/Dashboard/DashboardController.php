<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Models\GroupChat;
use App\Models\PlaneAssign;
use App\Models\PlanePayments;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
      
        $user = Auth::user();
        $users = User::where('type','user');
        $groups = GroupChat::latest();
        return view('dashboard.home.index',compact('user','groups','users'));
    }
}
