<?php
namespace CedricBlondeau\PhpEnigma2\Bouquets\Files;

class Scanner
{
    const ENIGMA2_PATH = "/etc/enigma2/";
    const TUXBOX_PATH = "/etc/tuxbox/";
    private static $enigma2Files = array(
        "blacklist",
        "bouquets.radio",
        "bouquets.tv",
        "lamedb",
        "whitelist"
    );
    private static $tuxboxFiles = array(
        "satellites.xml"
    );
    private $path;

    /**
     * @param $path
     * @throws RuntimeException
     */
    function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * @return array
     */
    public function scan()
    {
        if (file_exists($this->path) && is_dir($this->path)) {
            $scannedFiles = scandir($this->path);
            if ($this->validate($scannedFiles)) {
                return $this->buildFilesArray($scannedFiles);
            } else {
                throw new \RuntimeException;
            }
        } else {
            throw new \RuntimeException;
        }
    }

    /**
     * @param array $scannedFiles
     * @return array
     */
    private function buildFilesArray(array $scannedFiles)
    {
        $files = array();
        foreach ($scannedFiles as $scannedFile) {
            if (in_array($scannedFile, self::$enigma2Files) || substr($scannedFile, 0, 12) == "userbouquet.") {
                $destination = self::ENIGMA2_PATH . $scannedFile;
                $files[] = new File(realpath($this->path . $scannedFile), $destination);
            } elseif (in_array($scannedFile, self::$tuxboxFiles)) {
                $destination = self::TUXBOX_PATH . $scannedFile;
                $files[] = new File(realpath($this->path . $scannedFile), $destination);
            }
        }
        return $files;
    }

    /**
     * @param array $files
     * @return bool
     */
    private function validate(array $files)
    {
        $enigma2Diff = array_diff(self::$enigma2Files, $files);
        $tuxboxDiff = array_diff(self::$tuxboxFiles, $files);
        if (count($enigma2Diff) == 0 && count($tuxboxDiff) == 0) {
            return true;
        } else {
            return false;
        }
    }
}