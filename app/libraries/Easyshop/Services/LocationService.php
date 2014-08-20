<?php namespace Easyshop\Services;

use LocationLookUp;

class LocationService
{
    /**
     * Returns format needed for list of location
     *
     * @param $listOfLoc array
     * @return array
     */
    public function format($listOfLoc)
    {
        $formattedListOfLocation = array(
            'country_name' => '',
            'country_id' => '',
            'stateregion_lookup' => array(),
            'city_lookup' => array(),
        );

        foreach($listOfLoc as $location){
            if($location['type'] == LocationLookUp::$TYPE[0]){
                $formattedListOfLocation['country_name'] = $location['location'];
                $formattedListOfLocation['country_id'] = $location['id_location'];
            }else if($location['type'] == LocationLookUp::$TYPE[1]) {
                $formattedListOfLocation['stateregion_lookup'][$location['id_location']] = $location['location'];
            }else if($location['type'] ==  LocationLookUp::$TYPE[2]) {
                $formattedListOfLocation['city_lookup'][$location['parent_id']][$location['id_location']] = $location['location'];
            }
        }

        $formattedListOfLocation['json_city'] = json_encode($formattedListOfLocation['city_lookup'], JSON_FORCE_OBJECT);

        return $formattedListOfLocation;
    }

}
