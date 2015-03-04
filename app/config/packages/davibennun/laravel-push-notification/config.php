<?php

return array(

    'PushNotif'     => array(
        'environment' =>'development',
        'certificate' => app_path().'/../ck.pem',
        'passPhrase'  =>'pusheasyshop',
        'service'     =>'apns'
    ),
    'appNameAndroid' => array(
        'environment' =>'development',
        'apiKey'      =>'yourAPIKey',
        'service'     =>'gcm'
    )

);