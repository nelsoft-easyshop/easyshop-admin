<?php

return array(
    'IOS_PushNotif_dev'     => array(
        'environment' =>'development',
        'certificate' => app_path().'/certificates/mobile_pushnotification/ckdev.pem',
        'passPhrase'  =>'easyshoppush',
        'service'     =>'apns'
    ),
    'IOS_PushNotif_prod'     => array(
        'environment' =>'production',
        'certificate' => app_path().'/certificates/mobile_pushnotification/ckprod.pem',
        'passPhrase'  =>'easyshoppush',
        'service'     =>'apns'
    ),
    'ANDROID_PushNotif' => array(
        'environment' =>'environment',
        'apiKey'      =>'AIzaSyBxOFqbxRC5SY5zzKs5zAESfPlliiMaYc0',
        'service'     =>'gcm'
    )
);

