<?php
namespace CedricBlondeau\PhpEnigma2\Console\Handlers;

use CedricBlondeau\PhpEnigma2\Http\Client;
use Webmozart\Console\Api\Args\Args;
use Webmozart\Console\Api\IO\IO;

class ReloadCommandHandler extends BaseCommandHandler
{
    /**
     * @param Args $args
     * @param IO $io
     */
    public function handle(Args $args, IO $io)
    {
        parent::parseConfig($io);

        $httpClient = new Client($this->profile);
        $result = $httpClient->reloadBouquets();
        if ($result) {
            $io->writeLine("Reloaded");
        } else {
            $io->errorLine("Cannot send HTTP request, please check config file");
        }
    }
}