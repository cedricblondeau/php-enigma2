<?php
namespace CedricBlondeau\PhpEnigma2\Bouquets\Transport;

use CedricBlondeau\PhpEnigma2\Bouquets\Files;
use CedricBlondeau\PhpEnigma2\Profile;

class Ftp implements Transport
{
    private $host;
    private $user;
    private $password;

    /**
     * @param Profile $profile
     */
    function __construct(Profile $profile)
    {
        $this->host = $profile->getHost();
        $this->user = $profile->getUser();
        $this->password = $profile->getPassword();
    }

    /**
     * @param array $files
     */
    function upload(array $files)
    {
        $stream = ftp_connect($this->host, 21, 10);
        if ($stream) {
            $loggedIn = ftp_login($stream, $this->user, $this->password);
            if ($loggedIn) {
                foreach ($files as $file) {
                    if ($file instanceof Files\File) {
                        ftp_put($stream, $file->getDestination(), $file->getOrigin(), FTP_ASCII);
                    }
                }
            } else {
                throw new \RuntimeException("Cannot login to FTP");
            }
            ftp_close($stream);
        } else {
            throw new \RuntimeException("Cannot connect to FTP");
        }
    }
}