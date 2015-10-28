<?php
namespace CedricBlondeau\PhpEnigma2\Http;

use CedricBlondeau\PhpEnigma2\Profile;

class HttpClient
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
        $this->execute("servicelistreload?mode=0");
    }
}