<?php
    
namespace Easyshop\Services;

use PointHistory, Member, PointType, Point;

/**
 * Point Tracker Class
 *
 */
class PointTracker
{   
    /**
     * Expiration of points in days
     */
    const POINT_DAYS_DURATION = 90;

    private $pointTypesForExpirationUpdate = [];

    public function __construct()
    {
        $this->pointTypesForExpirationUpdate = [
            PointType::POINT_TYPE_REGISTER,
            PointType::POINT_TYPE_LOGIN,
            PointType::POINT_TYPE_SHARE_PRODUCT,
            PointType::POINT_TYPE_PURCHASE,
            PointType::POINT_TYPE_TRANSACTION_FEEDBACK,
        ];
    }
    
    /**
     * Spend user point
     *
     * @param integer $userId
     * @param integer $typeId
     * @param string $customPoints
     * @return boolean
     */
    public function addUserPoint($userId, $typeId, $customPoints = null)
    {
        $member = Member::find($userId);
        $pointType = PointType::find($typeId);
        
        if($member === null || $pointType === null){
            return false;
        }
        
        $userPoint = Point::where('member_id', '=', $userId)
                          ->first();
        if ($customPoints !== null) {
            $addPoints = $customPoints;
        }
        else {
            $addPoints = $pointType->point;
        }

        $pointHistory = new PointHistory();
        $pointHistory->member_id = $userId;
        $pointHistory->date_added = date('Y-m-d H:i:s');
        $pointHistory->point = $addPoints;
        $pointHistory->type = $pointType->id;
        $pointHistory->save();
        
        $expirationDate = date_create(date("Y-m-d H:i:s", strtotime("+".self::POINT_DAYS_DURATION." days")));
        if ($userPoint !== null) {
            /**
             * Update existing user's point
             */
            $userPoint->point = bcadd($userPoint->point, $addPoints);
            if(in_array($pointType->id, $this->pointTypesForExpirationUpdate)){
                $userPoint->expiration_date = $expirationDate;
            }
            $userPoint->save();
        }
        else {
            /**
             * Insert new user point
             */
            $userPoint = new Point();
            $userPoint->member_id = $userId;
            $userPoint->expiration_date = $expirationDate;
            $userPoint->point = $addPoints;
            $userPoint->save();
        }    

        return true;
    }
    
}

