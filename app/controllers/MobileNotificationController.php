<?php

use ApiType as ApiType;

class MobileNotificationController extends BaseController
{
    /**
     * Show push notification view
     * @return view
     */
    public function showPushNotificationView()
    {
        return View::make('pages.mobile-push-notification')
                    ->with('androidType', ApiType::TYPE_ANDROID)
                    ->with('iosType', ApiType::TYPE_IOS);
    }

    /**
     * route for notifying mobile application 
     */
    public function notifyUser()
    {   
        $message = trim(Input::get('message'));
        $apiType = trim(Input::get('apiType'));
        $mobileNotificationService = App::make('MobileNotificationService');
        $mobileNotificationService->notifyMobileAppUser($message, $apiType, App::environment('production')); 
    }
}

