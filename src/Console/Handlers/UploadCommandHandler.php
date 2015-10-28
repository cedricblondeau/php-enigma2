<?php
namespace CedricBlondeau\PhpEnigma2\Console\Handlers;

use CedricBlondeau\PhpEnigma2\Bouquets\Files;
use CedricBlondeau\PhpEnigma2\Bouquets\Transport\Ftp;
use CedricBlondeau\PhpEnigma2\Bouquets\Uploader;
use Webmozart\Console\Api\Args\Args;
use Webmozart\Console\Api\Command\Command;
use Webmozart\Console\Api\IO\IO;

class UploadCommandHandler extends BaseCommandHandler
{
    /**
     * @param Args $args
     * @param IO $io
     * @param Command $command
     */
    public function handle(Args $args, IO $io, Command $command)
    {
        parent::handle($args, $io, $command);

        try {
            $filesScanner = new Files\Scanner($args->getArgument('path'));
            $files = $filesScanner->scan();
        } catch (\RuntimeException $e) {
            $io->errorLine("Invalid path");
            exit();
        }

        try {
            $transport = new Ftp($this->profile);
            $uploader = new Uploader($transport, $files);
            $uploader->upload();
            $io->writeLine("Uploaded");
        } catch (\RuntimeException $e) {
            $io->errorLine($e->getMessage());
            exit();
        }
    }
}