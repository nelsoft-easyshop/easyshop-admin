<?php namespace Easyshop\Services;

use Illuminate\Support\Facades\Mail;

class EmailService{
    
   /**
    * Send email for sellers that have been paid
    *
    * @param Entity $member
    * @param Entity[] $orderProducts
    * @param string $accountName
    * @param string $accountNumber
    * @param string $bankName 
    * @param Carbon $dateFrom
    * @param Carbon $dateTo
    *
    */
    public function sendPaymentNotice($member, $orderProducts, $accountName, $accountNumber,$bankName, $dateFrom, $dateTo)
    {    
        $data = array(
            'recipient' => $member->username,
            'startPayOutDate' => $dateFrom,
            'endPayOutDate' => $dateTo,
            'orderProducts' => $orderProducts,
            'accountName' => $accountName,
            'accountNumber' => $accountNumber,
            'bankName' => $bankName,
        );

        Mail::send('emails.sellerpaid', $data, function($message) use ($member)
        {
            $message->to($member->email, isset($member->fullname) ? $member->fullname : $member->username )
                ->subject('Easyshop.ph - Payment for your sales.');
        });
    }
    

}