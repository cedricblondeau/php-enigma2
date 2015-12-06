php-enigma2
---
A modern PHP library and CLI for updating Enigma2/Dreambox bouquets

## CLI Usage
```bash
cp etc/config.yml.example etc/config.yml
vi config.yml # edit config.yml
chmod +x ./bin/console
./bin/console download "http://domain.tld/bouquets.zip"
./bin/console upload tmp/bouquets
./bin/console reload
```

## PHP Usage
```php
// Retrieve bouquets archive and extract it
$retriever = new Retriever();
$file = $retriever->download("http://domain.tld/bouquets.zip");
$directory = $retriever->extract($file);

// Parse bouquets files
$filesScanner = new Scanner($directory);
$files = $filesScanner->scan(); // Throws RuntimeException

// Create a dreambox/engima2 profile
$profile = new Profile("192.168.1.10", "user", "password");

// Upload files via FTP
$transport = new Ftp($profile);
$uploader = new Uploader($transport, $files);
$uploader->upload(); // Throws RuntimeException

// Reload bouquets
$client = new HttpClient($profile);
$client->reloadBouquets();

// Clear the tmp resources
$retriever->clearTempFiles();
```

## TODO
- Implement other transports (SFTP, SCP, Telnet)
