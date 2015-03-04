<?php

class MobileNotificationController extends BaseController
{
    /**
     * Show push notification view
     * @return view
     */
    public function showPushNotificationView()
    {
        return View::make('pages.mobile-push-notification');
    }

    public function notifyUser()
    { 
        $mobileNotificationService = App::make('MobileNotificationService');
        $mobileNotificationService->notifyMobileAppUser("HAHAHA", 1);
    }
}