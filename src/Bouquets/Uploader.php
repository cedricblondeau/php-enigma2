<?php
namespace CedricBlondeau\PhpEnigma2\Bouquets;

use CedricBlondeau\PhpEnigma2\Bouquets\Uploader\Transport;

class Uploader
{
    private $transport;
    private $files;

    /**
     * @param Transport $transport
     * @param array $files
     */
    function __construct(Transport $transport, array $files)
    {
        $this->transport = $transport;
        $this->files = $files;
    }

    public function upload() {
        $this->transport->upload($this->files);
    }
}