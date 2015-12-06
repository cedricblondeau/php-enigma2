<?php
namespace CedricBlondeau\PhpEnigma2\Bouquets\Uploader;

use CedricBlondeau\PhpEnigma2\Bouquets\Files;

interface Transport
{
    /**
     * @param array $files
     */
    public function upload(array $files);
}