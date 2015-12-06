<?php
namespace CedricBlondeau\PhpEnigma2\Bouquets\Uploader;

use CedricBlondeau\PhpEnigma2\Bouquets\Files;

interface Transport
{
    /**
     * @param array $files
     */
    function upload(array $files);
}