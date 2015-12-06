<?php
namespace CedricBlondeau\PhpEnigma2\Console\Handlers;

use CedricBlondeau\PhpEnigma2\Bouquets\Files;
use CedricBlondeau\PhpEnigma2\Bouquets\Retriever;
use Webmozart\Console\Api\Args\Args;
use Webmozart\Console\Api\IO\IO;

class DownloadCommandHandler extends BaseCommandHandler
{
    /**
     * @param Args $args
     * @param IO $io
     */
    public function handle(Args $args, IO $io)
    {
        parent::parseConfig($io);

        try {
            $retriever = new Retriever();
            $file = $retriever->download($args->getArgument('path'));
            $retriever->extract($file);
            $io->writeLine("Extracted");
        } catch (\RuntimeException $e) {
            $io->errorLine("Invalid path");
            exit();
        }
    }
}