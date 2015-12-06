php-enigma2
---
A modern PHP library and CLI for updating Enigma2/Dreambox bouquets

## CLI Usage
```bash
cp etc/config.yml.example etc/config.yml
vi config.yml # edit config.yml
chmod +x ./bin/console
mkdir tmp/
./bin/console download "http://domain.tld/bouquets.zip"
./bin/console upload tmp/bouquets
./bin/console reload
```

## PHP Usage
```php
// Retrieve a bouquets archive (from vhannibal.net for example) and extract it
$retriever = new Retriever();
$directory = $retriever->download("http://domain.tld/bouquets.zip");

// Parse bouquets files
$filesScanner = new Scanner($directory);
$files = $filesScanner->scan(); // Throws RuntimeException if invalid directory

// Create a dreambox/engima2 profile
$profile = new Profile("192.168.1.10", "user", "password");

// Upload files via FTP
$ftp = new Ftp($profile);
$ftp->upload($files); // Throws RuntimeException if FTP error

// Reload bouquets
$client = new HttpClient($profile);
$client->reloadBouquets();
```