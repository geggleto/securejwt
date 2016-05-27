# Encrypt your JSON Web Tokens


## Pre-Req

Libsodium is installed and configured in your environment. Our friends over at ParagonIE have a wonderful document to 
help you out. [Read it here](https://paragonie.com/book/pecl-libsodium/read/00-intro.md#installing-libsodium).

## Installation
```php
composer require geggleto/securejwt
```

## Usage

1. Generate a security key [a script has been provided scripts/generateSecretKey.php] 

2. Encrypting your Tokens

```php

    $config = new \Lcobucci\JWT\Builder(); // This object helps to simplify the creation of the dependencies
    // instead of using "?:" on constructors.

    $token = $config->setIssuer('http://example.com') // Configures the issuer (iss claim)
        ->setAudience('http://example.org') // Configures the audience (aud claim)
        ->setId('4f1g23a12aa', true) // Configures the id (jti claim), replicating as a header item
        ->setIssuedAt(time()) // Configures the time that the token was issue (iat claim)
        ->setNotBefore(time() + 60) // Configures the time that the token can be used (nbf claim)
        ->setExpiration(time() + 3600) // Configures the expiration time of the token (exp claim)
        ->set('uid', 1) // Configures a new claim, called "uid"
        ->getToken(); // Retrieves the generated token

    $secureJwt = new \SecureJwt\SecureJwt('./sec/encryption.key');

    $securedToken = $secureJwt->encryptToken((string)$token); //<--- This is the encrypted token

```

3. Decrypting your tokens

```php
    $tokenString = $secureJwt->decryptToken($securedToken);

    $newToken = (new \Lcobucci\JWT\Parser())->parse($tokenString);

```
