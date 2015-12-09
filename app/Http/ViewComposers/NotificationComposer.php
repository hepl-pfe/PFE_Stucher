<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use \App\Notification;

class NotificationComposer
{
    public function compose(View $view)
    {	
    	$notifications = Notification::where( 'for', '=', \Auth::user()->id )->get();
    	$from = $notifications
    	$returnNotif = []
    	
    	if( \Auth::check() ){
 	       $view->with('notifications', Notification::where( 'for', '=', \Auth::user()->id )->get());
 	    }

    }
}