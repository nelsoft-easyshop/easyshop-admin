<?php namespace Easyshop\Services;

class DataFormatterService
{
    public function location($listOfLoc)
    {
        $data = array();
        foreach($listOfLoc as $r){
            if($r['type'] == 0){
                $data['country_name'] = $r['location'];
                $data['country_id'] = $r['id_location'];
            }else if($r['type'] == 3) {
                $data['stateregion_lookup'][$r['id_location']] = $r['location'];
            }else if($r['type'] == 4) {
                $data['city_lookup'][$r['parent_id']][$r['id_location']] = $r['location'];
            }
        }

        $data['json_city'] = json_encode($data['city_lookup'], JSON_FORCE_OBJECT);

        return $data;
    }

    /**
     * Returns format needed for list of location
     *
     * @param $listOfLoc array
     * @return array
     */
}
