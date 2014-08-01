<?php

use Carbon\Carbon;

return array(
    'startOfOperation' => Carbon::createFromFormat('Y-m-d H:i:s', '2013-06-15 00:00:00'),
    
    'payOut' => array(
        ['day' => 5, 'rangeStart' => 16, 'rangeEnd' => 'END_OF_MONTH'],
        ['day' => 20, 'rangeStart' => 1, 'rangeEnd' => 15],
    ),

);

