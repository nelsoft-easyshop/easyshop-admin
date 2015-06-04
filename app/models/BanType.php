<?php

class BanType extends Eloquent
{
    const NOT_BANNED = 0;
    const BAN_TYPE_PAYPAL_DISPUTE = 1 ;
    const BAN_TYPE_INQUIRY_NONCOMPLIANCE = 2 ;
    const BAN_TYPE_IMPERSONATION = 3;
    const BAN_TYPE_EXCESSIVE_PERIOD_OF_INACTIVITY = 4;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'es_ban_type';
    protected $primaryKey = 'id_ban_type';
}

