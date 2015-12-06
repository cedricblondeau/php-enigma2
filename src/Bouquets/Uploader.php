<?php
namespace CedricBlondeau\PhpEnigma2\Bouquets;

use CedricBlondeau\PhpEnigma2\Bouquets\Uploader\Transport;

/**
 * Class Uploader
 *
 * This proxy pattern implementation may not be required anymore...
 *
 * @package CedricBlondeau\PhpEnigma2\Bouquets
 */
class Uploader
{
    private $transport;

    /**
     * @param Transport $transport
     */
    function __construct(Transport $transport)
    {
        $this->transport = $transport;
    }

    /**
     * @param array $files
     */
    public function upload(array $files) {
        $this->transport->upload($files);
    }
}