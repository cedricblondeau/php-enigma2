<?php
namespace CedricBlondeau\PhpEnigma2\Console\Handlers;

use CedricBlondeau\PhpEnigma2\Http\HttpClient;
use Webmozart\Console\Api\Args\Args;
use Webmozart\Console\Api\Command\Command;
use Webmozart\Console\Api\IO\IO;

class ReloadCommandHandler extends BaseCommandHandler
{
    /**
     * @param Args $args
     * @param IO $io
     * @param Command $command
     */
    public function handle(Args $args, IO $io, Command $command)
    {
        parent::handle($args, $io, $command);

        $httpClient = new HttpClient($this->profile);
        $result = $httpClient->reloadBouquets();
        if ($result) {
            $io->writeLine("Reloaded");
        } else {
            $io->errorLine("Cannot send HTTP request, please check config file");
        }
    }
}