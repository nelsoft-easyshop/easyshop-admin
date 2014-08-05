<?php namespace Easyshop\Services;

class DataFormatterService
{
    public function location($listOfLoc)
    {
        $formattedListOfLocation = array();
        foreach($listOfLoc as $location){
            if($location['type'] == 0){
                $formattedListOfLocation['country_name'] = $location['location'];
                $formattedListOfLocation['country_id'] = $location['id_location'];
            }else if($location['type'] == 3) {
                $formattedListOfLocation['stateregion_lookup'][$location['id_location']] = $location['location'];
            }else if($location['type'] == 4) {
                $formattedListOfLocation['city_lookup'][$location['parent_id']][$location['id_location']] = $location['location'];
            }
        }

        $formattedListOfLocation['json_city'] = json_encode($formattedListOfLocation['city_lookup'], JSON_FORCE_OBJECT);

        return $formattedListOfLocation;
    }

    /**
     * Returns format needed for list of location
     *
     * @param $listOfLoc array
     * @return array
     */
}
