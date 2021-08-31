<?php

namespace App\Providers;

use App\CompanyInfo;
use App\Notification;
use App\SettingBanners;
use App\SettingSocialLink;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        return view()->composer('*', function ($view) {
            $companyData = CompanyInfo::find(1);
            $socialinks = SettingSocialLink::all();
            $bannerlist = SettingBanners::whereNotIn('banner', ['0'])->get();
            $view->with([
                'companyData' => $companyData,
                'socialinks' => $socialinks,
                'bannerlist' => $bannerlist,
            ]);
            if (Auth::check()) {
                $notifications = Notification::where('user_id', auth()->user()->id)->orderBy('seen')->get();
                $view->with([
                    'notifications' => $notifications,
                ]);
                
                // $userNotifications = Notification::join('request_details', 'request_details.id', '=', 'notifications.request_id')->join('users', 'users.id', '=', 'request_details.talent_id')->where('request_details.submit_by', auth()->user()->id)->whereIn('request_details.status', ['Submitted', 'Rejected'])
                //                 ->select('notifications.*', 'request_details.id as reqid', 'request_details.occasion as reqoccasion', 'request_details.status as reqstatus', 'users.name as tname', 'users.avatar as tavatar')->latest()->get();
        
                // $talentNotifications = Notification::join('request_details', 'request_details.id', '=', 'notifications.request_id')->join('users', 'users.id', '=', 'request_details.submit_by')->where('request_details.talent_id', auth()->user()->id)->where('request_details.status', 'Pending')
                //                 ->select('notifications.*', 'request_details.id as reqid', 'request_details.occasion as reqoccasion', 'request_details.status as reqstatus', 'users.name as uname', 'users.avatar as uavatar')->latest()->get();

                // if (auth()->user()->type > 0) {
                //     $view->with([
                //         'userNotifications' => $userNotifications,
                //         'talentNotifications' => $talentNotifications,
                //     ]);
                // } else {
                //     $view->with([
                //         'userNotifications' => $userNotifications,
                //     ]);
                // }
            }
        });
    }
}
