<?php namespace Easyshop\Services;

use ApiType as ApiType;
use Easyshop\ModelRepositories\DeviceTokenRepository as DeviceTokenRepository;

class MobileNotificationService
{   
    /**
     * message to be sending into notification
     * @var string
     */
    private $message;

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

    public function __construct(DeviceTokenRepository $deviceTokenRepository,
                                $pushNotification)
    {
        $this->deviceTokenRepository = $deviceTokenRepository;
        $this->pushNotification = $pushNotification;
    }

    public function notifyMobileAppUser($message, $apiType)
    {
        $this->message = $message;

        $deviceTokens = $this->deviceTokenRepository->getActiveDeviceTokens($apiType);

        $tokenList = [];
        foreach ($deviceTokens as $token) {
            $tokenList[] = $token->device_token;
        }

        if( (int) $apiType === ApiType::TYPE_IOS){
            $this->__sendIOSNotification($tokenList);
        }
        elseif( (int) $apiType === ApiType::TYPE_ANDROID){
            $this->__sendAndroidNotification($tokenList);
        }
    }

    private function __sendIOSNotification($deviceToken = [])
    {
        $this->pushNotification->app('PushNotif')
                                ->to("fa354d6f863f1577df2f955e87ee77c35b1ec6c72683d8396c66ef07eab875b5")
                                ->send('Hello World, i`m a push message');
    }

    private function __sendAndroidNotification($deviceToken = [])
    {

    }
}