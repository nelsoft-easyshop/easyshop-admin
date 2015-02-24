<?php

class BanType extends Eloquent
{
    public static $TITLE = [
        'Paypal Dispute' => 1,
        'Inquiry Non-compliance' => 2
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'es_ban_type';
    protected $primaryKey = 'id_ban_type';
}

