php-enigma2
---
A modern PHP library and CLI for updating Enigma2/Dreambox bouquets

## CLI Usage
```bash
./bin/console upload /path/to/bouquets
./bin/console reload
```

## PHP Usage
```php
// Parse bouquets files
$filesScanner = new Scanner("/path/to/bouquets/");
$files = $filesScanner->scan(); // Throws RuntimeException

// Create a dreambox/engima2 profile
$profile = new Profile("192.168.1.10", "user", "password");

// Upload files via FTP
$transport = new FTP($profile);
$uploader = new Uploader($transport, $files);
$uploader->upload(); // Throws RuntimeException

// Reload bouquets
$client = new HttpClient($profile);
$client->reloadBouquets();
```

## TODO
- Implement other transports (SFTP, SCP, Telnet)
