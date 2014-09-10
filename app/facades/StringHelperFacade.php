<?php

use Illuminate\Support\Facades\Facade;

class StringHelperFacade extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() {
        return 'StringHelper';
    }

}
