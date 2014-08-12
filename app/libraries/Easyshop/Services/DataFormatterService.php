<?php namespace Easyshop\Services;

class DataFormatterService
{
    /**
     * Returns format needed for list of location
     *
     * @param $listOfLoc array
     * @return array
     */
    public function location($listOfLoc)
    {
        $type = array(
            'country' => 0,
            'state' => 3,
            'city' => 4,
        );
        $formattedListOfLocation = array();
        foreach($listOfLoc as $location){
            if($location['type'] == $type['country']){
                $formattedListOfLocation['country_name'] = $location['location'];
                $formattedListOfLocation['country_id'] = $location['id_location'];
            }else if($location['type'] == $type['state']) {
                $formattedListOfLocation['stateregion_lookup'][$location['id_location']] = $location['location'];
            }else if($location['type'] == $type['city']) {
                $formattedListOfLocation['city_lookup'][$location['parent_id']][$location['id_location']] = $location['location'];
            }
        }
        $formattedListOfLocation['json_city'] = json_encode($formattedListOfLocation['city_lookup'], JSON_FORCE_OBJECT);

        return $formattedListOfLocation;
    }

}
