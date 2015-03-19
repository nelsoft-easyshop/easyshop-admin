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
     * @var Davibennun\LaravelPushNotification\PushNotification
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
     * @param  boolean $isProduction
     */
    public function notifyMobileAppUser($message, $apiType, $isProduction)
    {
        $deviceTokens = $this->deviceTokenRepository->getActiveDeviceTokens($apiType);

        if( (int) $apiType === ApiType::TYPE_IOS){
            if($isProduction){
                $this->appName = "IOS_PushNotif_prod";
            }
            else{ 
                $this->appName = "IOS_PushNotif_dev";
            } 
        }
        elseif( (int) $apiType === ApiType::TYPE_ANDROID){
            $this->appName = "ANDROID_PushNotif"; 
        }

        $tokenList = [];
        foreach ($deviceTokens as $token) {  
            if($this->supportDeviceToken($token->device_token, $apiType)){
                $tokenList[] = $this->pushNotification->Device($token->device_token);
            }
            else{
                $token->is_active = false;
                $token->save();
            }
        }

        $devices = $this->pushNotification->DeviceCollection($tokenList);
        $collection = $this->pushNotification->app($this->appName)
                                             ->to($devices)
                                             ->send($message);
    }

    /**
     * Validate of device token is valid
     * @param  string  $token 
     * @param  integer $apiType
     * @return boolean
     */
    private function supportDeviceToken($token, $apiType){
        if((int)$apiType === ApiType::TYPE_IOS){
            return (ctype_xdigit($token) && 64 === strlen($token));
        }
        elseif((int)$apiType === ApiType::TYPE_ANDROID){
            return (bool) preg_match('/^[0-9a-zA-Z\-\_]+$/i', $token);
        }
    }
}

