<?php
/**
 * Created by PhpStorm.
 * User: Glenn
 * Date: 2016-05-27
 * Time: 11:22 AM
 */
include "/../vendor/autoload.php";

use \ParagonIE\Halite\KeyFactory;

// Generate a new random encryption key:
$encryptionKey = KeyFactory::generateEncryptionKey();

// Saving a key to a file:
KeyFactory::save($encryptionKey, './sec/encryption.key');