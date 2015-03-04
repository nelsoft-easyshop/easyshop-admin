<?php namespace Easyshop\Services;

use ApiType as ApiType;
use Easyshop\ModelRepositories\DeviceTokenRepository as DeviceTokenRepository;

class MobileNotificationService
{   
    /**
     * app name of the notification app
     * @var string
     */ 
    private $appName;

    /**
     * DeviceToken Repository
     * @var DeviceTokenRepository
     */
    private $deviceTokenRepository;


    /**
     * Push Notification Class
     * @var Davibennun\LaravelPushNotification\Facades\PushNotification
     */
    private $pushNotification;

    /**
     * Constructor 
     */
    public function __construct(DeviceTokenRepository $deviceTokenRepository,
                                $pushNotification)
    {
        $this->deviceTokenRepository = $deviceTokenRepository;
        $this->pushNotification = $pushNotification;
    }

    /**
     * Function for notifying mobile application of easyshop
     * @param  string  $message
     * @param  integer $apiType 
     */
    public function notifyMobileAppUser($message, $apiType)
    {
        $deviceTokens = $this->deviceTokenRepository->getActiveDeviceTokens($apiType);

        if( (int) $apiType === ApiType::TYPE_IOS){
            $this->appName = "IOS_PushNotif";
        }
        elseif( (int) $apiType === ApiType::TYPE_ANDROID){
            $this->appName = "ANDROID_appNameAndroid";
        }

        $tokenList = [];
        foreach ($deviceTokens as $token) { 
            $tokenList[] = $this->pushNotification->Device($token->device_token);
        }
        $devices = $this->pushNotification->DeviceCollection($tokenList);
        $this->pushNotification->app($this->appName)
                               ->to($devices)
                               ->send($message);
    }
}