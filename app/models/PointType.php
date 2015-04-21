<?php

class PointType extends Eloquent 
{

    /**
     * Point type for registration
     *
     * @var integer
     */
    const POINT_TYPE_REGISTER = 1;
    
    /**
     * Point type for login
     *
     * @var integer
     */
    const POINT_TYPE_LOGIN = 2;
    
    /**
     * Point type for product sharing
     *
     * @var integer
     */
    const POINT_TYPE_SHARE_PRODUCT = 3;

    /**
     * Point type for purchase
     *
     * @var integer
     */
    const POINT_TYPE_PURCHASE = 4;

    /**
     * Point type for transaction feedback
     *
     * @var integer
     */
    const POINT_TYPE_TRANSACTION_FEEDBACK = 5;
    
    /**
     * Point type for revert
     *
     * @var integer
     */
    const POINT_TYPE_REVERT = 6;
    
    /**
     * Point type for expired
     *
     * @var integer
     */
    const POINT_TYPE_EXPIRED = 7;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'es_point_type';

    /**
     * The primary key of the table
     *
     * @var string
     */
    protected $primaryKey = 'id';
    
    /**
     * Disable table auto timestamping
     *
     * @var boolean
     */
    public $timestamps = false;   
       
}
