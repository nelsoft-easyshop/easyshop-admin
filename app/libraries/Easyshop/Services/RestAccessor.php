<?php 

namespace Easyshop\Services;

/**
 * Class to Access RESTful APIs
 *
 * @author Sam Gavinio <samgavinio@easyshop.ph>
 */
class RESTAccessor
{
    /**
     * Application Environment
     *
     * @var string
     */
    private $environment = 'development';

    /**
     * Initialize the class
     *
     * @param string $environment
     */
    public function __construct($environment = "")
    {
        if($environment !== ""){
            $this->environment = strtolower($environment);
        }
    }

    /**
     * Gets the content of a webpage
     *
     * @param string $url
     * @return string
     */
    public function get($url) 
    {
        $options = [
            CURLOPT_RETURNTRANSFER => true,   // return web page
            CURLOPT_HEADER         => false,  // don't return headers
            CURLOPT_FOLLOWLOCATION => true,   // follow redirects
            CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
            CURLOPT_ENCODING       => "",     // handle compressed
            CURLOPT_USERAGENT      => "test", // name of client
            CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
            CURLOPT_TIMEOUT        => 120,    // time-out on response
        ]; 

        $ch = curl_init($url);
        curl_setopt_array($ch, $options);

        if($this->environment !== 'production'){
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        }
        $content  = curl_exec($ch);
        curl_close($ch);

        return trim($content);
    }

}

