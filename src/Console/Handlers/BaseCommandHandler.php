<?php
namespace CedricBlondeau\PhpEnigma2\Console\Handlers;

use Webmozart\Console\Api\IO\IO;
use CedricBlondeau\PhpEnigma2\Profile;
use Symfony\Component\Yaml\Yaml;

abstract class BaseCommandHandler
{
    protected $profile;

    /**
     * @param IO $io
     */
    protected function parseConfig(IO $io)
    {
        $configFile = __DIR__ . '/../../../etc/config.yml';
        if (file_exists($configFile) && is_file($configFile)) {
            $config = Yaml::parse(file_get_contents($configFile));
            try {
                $this->profile = Profile::fromArray($config);
            } catch (\RuntimeException $e) {
                $io->errorLine("Invalid config.yml file");
                exit();
            }
        } else {
            $io->errorLine("No config.yml file");
            exit();
        }
    }
}