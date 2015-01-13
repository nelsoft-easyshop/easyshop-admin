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
    * @param Bool $isRefund
    *
    */
    public function sendPaymentNotice($member, $orderProducts, $accountName, $accountNumber,$bankName, $dateFrom, $dateTo, $isRefund = false)
    {    
        $storename = $member->getStoreName();

        $data = [
            'recipient' => $storename . ($member->username === $storename ? '/'.$member->username : ''),
            'startPayOutDate' => $dateFrom,
            'endPayOutDate' => $dateTo,
            'orderProducts' => $orderProducts,
            'accountName' => $accountName,
            'accountNumber' => $accountNumber,
            'bankName' => $bankName,
            'isRefund' => $isRefund,
        ];

        $subject = $isRefund ? 'Fund transfer for Refund Request' : 'Payment for you sales';

        Mail::send('emails.payment', $data, function($message) use ($member, $subject)
        {
            $message->to($member->email, isset($member->fullname) ? $member->fullname : $member->username )
                ->subject('Easyshop.ph - '.$subject);
        });
    }
    

}