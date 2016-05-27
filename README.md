# Encrypt your JSON Web Tokens


## Pre-Req

Libsodium is installed and configured in your environment. Our friends over at Paragoonie have a wonderful document to 
help you out. https://paragonie.com/book/pecl-libsodium/read/00-intro.md#installing-libsodium

## Installation
```php
composer require geggleto/securejwt
```

## Usage

1. Generate a security key [a script has been provided scripts/generateSecretKey.php] 

2. Encrypting your Tokens

```php

// Construct your JWT and get the token string

use Lcobucci\JWT\Configuration;

$config = new Configuration(); // This object helps to simplify the creation of the dependencies
                               // instead of using "?:" on constructors.

$token = $config->createBuilder()->setIssuer('http://example.com') // Configures the issuer (iss claim)
                                 ->setAudience('http://example.org') // Configures the audience (aud claim)
                                 ->setId('4f1g23a12aa', true) // Configures the id (jti claim), replicating as a header item
                                 ->setIssuedAt(time()) // Configures the time that the token was issue (iat claim)
                                 ->setNotBefore(time() + 60) // Configures the time that the token can be used (nbf claim)
                                 ->setExpiration(time() + 3600) // Configures the expiration time of the token (exp claim)
                                 ->set('uid', 1) // Configures a new claim, called "uid"
                                 ->getToken(); // Retrieves the generated token


// Initialize SecureJWT
$secureJwt = new SecureJwt('/path/to/your/key/file.key');

$securedJWT = $secureJwt->encryptToken($token);

```

3. Decrypting your tokens

```php
//assumed $securedJwt is the secured token

$secureJwt = new SecureJwt('/path/to/your/key/file.key');

$token = $secureJwt->decryptToken($securedJwt); 

use Lcobucci\JWT\Configuration;

$config = new Configuration();
$token = $config->getParser()->parse((string) $token); // Parses from a string
// ^ JWT :)

```