<?php

return [
    'IOS_PushNotif_dev'     => [
        'environment' =>'development',
        'certificate' => app_path().'/certificates/mobile_pushnotification/ckdev.pem',
        'passPhrase'  =>'easyshoppush',
        'service'     =>'apns'
    ],
    'IOS_PushNotif_prod'     => [
        'environment' =>'production',
        'certificate' => app_path().'/certificates/mobile_pushnotification/ckprod.pem',
        'passPhrase'  =>'easyshoppush',
        'service'     =>'apns'
    ],
    'ANDROID_PushNotif' => [
        'environment' =>'environment',
        'apiKey'      =>'AIzaSyBxOFqbxRC5SY5zzKs5zAESfPlliiMaYc0',
        'service'     =>'gcm'
    ]
];

