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

    /**
     * route for notifying mobile application 
     */
    public function notifyUser()
    { 
        $message = trim(Input::has('message'));
        $apiType = trim(Input::has('api_type'));
        $mobileNotificationService = App::make('MobileNotificationService');
        $mobileNotificationService->notifyMobileAppUser($message, $apiType);
    }
}