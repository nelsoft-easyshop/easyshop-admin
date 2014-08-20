<?php namespace Easyshop\Services;

class LocationService
{

    /**
     * Returns format needed for list of location
     *
     * @param $listOfLoc array
     * @return array
     */
    public function location($listOfLoc)
    {
        $formattedListOfLocations = array(
            'country_name' => '',
            'country_id' => '',
            'stateregion_lookup' => array(),
            'city_lookup' => array(),
        );
        
        foreach($listOfLoc as $location){
            if($location['type'] == 0){
                $formattedListOfLocations['country_name'] = $location['location'];
                $formattedListOfLocations['country_id'] = $location['id_location'];
            }else if($location['type'] == 3) {
                $formattedListOfLocations['stateregion_lookup'][$location['id_location']] = $location['location'];
            }else if($location['type'] == 4) {
                $formattedListOfLocations['city_lookup'][$location['parent_id']][$location['id_location']] = $location['location'];
            }
        }


        $formattedListOfLocations['json_city'] = json_encode($formattedListOfLocations['city_lookup'], JSON_FORCE_OBJECT);

        return $formattedListOfLocations;
    }

}
