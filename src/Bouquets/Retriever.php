<?php
namespace CedricBlondeau\PhpEnigma2\Bouquets;

use VIPSoft\Unzip\Unzip;

class Retriever
{
    private $tmpDir;
    private $tmpArchive;
    private $tmpBouquets;

    public function __construct()
    {
        $this->tmpDir = __DIR__ . '/../../tmp/';
        $this->tmpArchive = $this->tmpDir . 'tmp.zip';
        $this->tmpBouquets = $this->tmpDir . 'bouquets/';
        $this->clearTempFiles();
    }

    /**
     * Download the remote file and write it to the tmp directory
     *
     * @param string $url
     * @return string
     */
    public function download($url)
    {
        file_put_contents($this->tmpArchive, fopen($url, 'r'));
        return $this->tmpArchive;
    }

    /**
     * Extract the downloaded archive from tmp directory, return the bouquet directory
     * If the file does not exist, throw an exception
     *
     * @param $file
     * @return string
     * @throws \Exception
     */
    public function extract($file)
    {
        if(file_exists($file)) {
            $unzip = new Unzip();
            $unzip->extract($file, $this->tmpDir);
            $this->renameDirectory();
            return $this->tmpBouquets;
        } else {
            throw new \RuntimeException("File not found");
        }
    }

    /**
     * Remove the tmp archive & tmp bouquets
     */
    public function clearTempFiles()
    {
        if(file_exists($this->tmpArchive)) {
            unlink($this->tmpArchive);
        }
        if(file_exists($this->tmpBouquets) && is_dir($this->tmpBouquets)) {
            $this->unlinkDirectory($this->tmpBouquets);
        }
    }

    /**
     * Rename the extracted directory
     */
    public function renameDirectory()
    {
        rename($this->tmpDir . $this->getExtractedDirectory(), $this->tmpBouquets);
    }

    /**
     * Get the extracted directory name
     *
     * @return string
     */
    public function getExtractedDirectory()
    {
        $files = scandir($this->tmpDir);
        foreach($files as $file) {
            if($file != '.' && $file != '..' && $file != 'tmp.zip') {
                return $file;
            }
        }
        return null;
    }

    /**
     * Remove the directory and his content
     *
     * @param string $directory
     */
    public function unlinkDirectory($directory)
    {
        $files = glob($directory . '*', GLOB_MARK);
        foreach($files as $file) {
            unlink($file);
        }
        rmdir($directory);
    }
}