<?php

/**
 * Helper Class for formatting number
 */

class NumberFormatter{

   /**
    *  Adds ordinal suffix to end fo numbers.
    * 
    *  @param integer
    *  @return string
    */

    public static function addOrdinalNumberSuffix($num) {
        if (!in_array(($num % 100),array(11,12,13))){
            switch ($num % 10) {
                // Handle 1st, 2nd, 3rd
                case 1:  return $num.'st';
                case 2:  return $num.'nd';
                case 3:  return $num.'rd';
            }
        }
        return $num.'th';
    }

}