<?php

return array(

    'IOS_PushNotif'     => array(
        'environment' =>'development',
        'certificate' => app_path().'/certificates/ck.pem',
        'passPhrase'  =>'pusheasyshop',
        'service'     =>'apns'
    ),
    'ANDROID_appNameAndroid' => array(
        'environment' =>'development',
        'apiKey'      =>'AIzaSyBxOFqbxRC5SY5zzKs5zAESfPlliiMaYc0',
        'service'     =>'gcm'
    )

);