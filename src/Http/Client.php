<?php
namespace CedricBlondeau\PhpEnigma2\Http;

use CedricBlondeau\PhpEnigma2\Profile;

/**
 * Class Http/Client

 * Could be refactored to support different http client implementation
 * than curl but definitely not necessary right now.
 *
 * @package CedricBlondeau\PhpEnigma2\Http
 */
class Client
{
    /**
     * @var string
     */
    private $url;

    /**
     * @param Profile $profile
     */
    function __construct(Profile $profile)
    {
        $this->url = "http://" . $profile->getHost() . "/web/";
    }

    /**
     * @param $path
     * @return mixed
     */
    private function execute($path)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url . $path);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT , 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function reloadBouquets()
    {
        return $this->execute("servicelistreload?mode=0");
    }
}