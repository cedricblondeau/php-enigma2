<?php
namespace CedricBlondeau\PhpEnigma2\Bouquets\Files;

class File
{
    private $origin;
    private $destination;

    /**
     * @param $origin
     * @param $destination
     */
    function __construct($origin, $destination)
    {
        $this->origin = $origin;
        $this->destination = $destination;
    }

    /**
     * @return mixed
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * @return mixed
     */
    public function getDestination()
    {
        return $this->destination;
    }
}