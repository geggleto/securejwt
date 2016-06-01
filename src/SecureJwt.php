<?php
/**
 * Created by PhpStorm.
 * User: Glenn
 * Date: 2016-05-27
 * Time: 11:26 AM
 */

namespace SecureJwt;

use ParagonIE\Halite\KeyFactory;
use \ParagonIE\Halite\Symmetric\Crypto as Symmetric;


class SecureJwt
{
    /**
     * @var \ParagonIE\Halite\Symmetric\EncryptionKey
     */
    private $key;

    /**
     * SecureJwt constructor.
     *
     * @param string $keyFile
     */
    public function __construct($keyFile = '')
    {
        $this->key = KeyFactory::loadEncryptionKey($keyFile);
    }

    /**
     * @param string $token
     *
     * @return string
     *
     * @throws \ParagonIE\Halite\Alerts\InvalidKey
     * @throws \ParagonIE\Halite\Alerts\InvalidType
     */
    public function encryptToken($token = '') {
        $encrypted = Symmetric::encrypt($token, $this->key);

        return $encrypted;
    }

    /**
     * @param string $token
     *
     * @return string
     *
     * @throws \ParagonIE\Halite\Alerts\InvalidKey
     * @throws \ParagonIE\Halite\Alerts\InvalidMessage
     * @throws \ParagonIE\Halite\Alerts\InvalidType
     */
    public function decryptToken($token = '') {
        $decyrpted = Symmetric::decrypt($token, $this->key);
        
        return $decyrpted;
    }
}