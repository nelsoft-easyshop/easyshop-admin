<?php

class WebserviceController extends BaseController
{
    /**
     * Generate the hash for any string using SHA1
     *
     * @return string
     */
    public function generateHash()
    {
        $fields = Input::get();
        $accumulatedString = "";
        foreach($fields as $field){
            $accumulatedString .= $field;
        }
        
        $accumulatedString .= Auth::user()->password;

        echo json_encode(sha1($accumulatedString));
    }

}
