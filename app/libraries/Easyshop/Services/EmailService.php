<?php namespace Easyshop\Services;

use Illuminate\Support\Facades\Mail;
use Easyshop\ModelRepositories\ProductImageRepository as ProductImageRepository;
use Easyshop\Services\RestAccessor as RestAccessor;

class EmailService{
    
    /**
     * Product Image Repository
     *
     * @var Easyshop\ModelRepositories\ProductImageRepository
     */
    private $productImageRepository;

    /**
     * RESTful API Accessor
     *
     * @var Easyshop\Services\RestAccessor
     */
    private $restAccessor;
    
    public function __construct(ProductImageRepository $productImageRepository, RestAccessor $restAccessor)
    {
        $this->productImageRepository = $productImageRepository;
        $this->restAccessor = $restAccessor;
    }
    
   /**
    * Send email for sellers that have been paid
    *
    * @param Entity $member
    * @param Entity[] $orderProducts
    * @param string $accountName
    * @param string $accountNumber
    * @param string $bankName 
    * @param Bool $isRefund
    *
    */
    public function sendPaymentNotice($member, $orderProducts, $accountName, $accountNumber,$bankName, $isRefund = false)
    {                    
        $assetsGetUrl = \Config::get('easyshop/webservice.assetsLink');
        $easyshopLink = \Config::get('easyshop/webservice.easyShopLink');
        $assetsLink = $this->restAccessor->get($assetsGetUrl);
        $assetsLink = $assetsLink === "/" ? $easyshopLink : $assetsLink;

        foreach($orderProducts as $key => $orderProduct){
            $productImage =  $this->productImageRepository
                                  ->getDefaultProductImage($orderProduct->product->id_product);
            $orderProducts[$key]->defaultImage = $productImage;
        }

        $data = [
            'recipient' => $member->username,
            'orderProducts' => $orderProducts,
            'accountName' => $accountName,
            'accountNumber' => $accountNumber,
            'bankName' => $bankName,
            'isRefund' => $isRefund,
            'easyshopLink' => $easyshopLink,
            'assetsLink' => $assetsLink,
            'facebook' => \Config::get('easyshop/social-media-links.facebook'),
            'twitter' => \Config::get('easyshop/social-media-links.twitter'),
        ];

        $subject = $isRefund ? 'Fund transfer for Refund Request' : 'Payment for your sales';
        Mail::send('emails.payment', $data, function($message) use ($member, $subject)
        {
            $message->to($member->email, isset($member->fullname) ? $member->fullname : $member->username )
                    ->subject('Easyshop.ph - '.$subject);
        });
    }
    

}