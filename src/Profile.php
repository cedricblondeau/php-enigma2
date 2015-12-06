<?php
namespace CedricBlondeau\PhpEnigma2;

class Profile
{
    /**
     * @var string
     */
    private $host;

    /**
     * @var string
     */
    private $user;

    /**
     * @var string
     */
    private $password;

    /**
     * @param $host
     * @param $user
     * @param $password
     */
    public function __construct($host, $user, $password)
    {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * @param array $data
     * @return Profile
     * @throws \RuntimeException
     */
    public static function fromArray(array $data) {
        if (isset($data['host']) && $data['host']
            && isset($data['user']) && $data['user']) {
            $profile = new self($data['host'], $data['user'], $data['password']);
            return $profile;
        } else {
            throw new \InvalidArgumentException("Invalid array");
        }
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
}