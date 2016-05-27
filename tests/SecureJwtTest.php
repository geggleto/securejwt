<?php

/**
 * Created by PhpStorm.
 * User: Glenn
 * Date: 2016-05-27
 * Time: 11:41 AM
 */
class SecureJwtTest extends PHPUnit_Framework_TestCase
{
    public function testEncrypt() {

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

        $securedToken = $secureJwt->encryptToken((string)$token);

        $tokenString = $secureJwt->decryptToken($securedToken);

        $newToken = (new \Lcobucci\JWT\Parser())->parse($tokenString);
        $this->assertEquals($token->getClaim('uid'), $newToken->getClaim('uid'));
    }
}