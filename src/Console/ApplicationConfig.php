<?php
namespace CedricBlondeau\PhpEnigma2\Console;

use Webmozart\Console\Config\DefaultApplicationConfig;
use Webmozart\Console\Api\Args\Format\Argument;
use CedricBlondeau\PhpEnigma2\Console\Handlers\UploadCommandHandler;
use CedricBlondeau\PhpEnigma2\Console\Handlers\DownloadCommandHandler;
use CedricBlondeau\PhpEnigma2\Console\Handlers\ReloadCommandHandler;

class ApplicationConfig extends DefaultApplicationConfig
{
    protected function configure()
    {
        parent::configure();

        $this->setName('php-enigma2')
            ->setVersion('1.0.0')

            ->beginCommand('upload')
            ->setDescription('Upload bouquets files')
            ->setHandler(new UploadCommandHandler())
            ->addArgument('path', Argument::REQUIRED, 'Path')
            ->end()

            ->beginCommand('download')
            ->setDescription('Download and extract bouquets file')
            ->setHandler(new DownloadCommandHandler())
            ->addArgument('url', Argument::REQUIRED, 'Url')
            ->end()

            ->beginCommand('reload')
            ->setDescription('Reload bouquets')
            ->setHandler(new ReloadCommandHandler())
            ->end();
    }
}
