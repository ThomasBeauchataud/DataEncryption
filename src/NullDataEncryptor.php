<?php

/*
 * This file is part of the tbcd/data-encryption library.
 *
 * (c) Thomas Beauchataud <thomas.beauchataud@yahoo.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Author Thomas Beauchataud
 * From 13/06/2023
 */

namespace TBCD\DataEncryption;

/**
 * A basic Data Encryptor which does nothing
 */
final class NullDataEncryptor implements DataEncryptorInterface
{

    /**
     * @inheritDoc
     */
    public function encrypt(string $decryptedData): string
    {
        return $decryptedData;
    }

    /**
     * @inheritDoc
     */
    public function decrypt(string $encryptedData): string
    {
        return $encryptedData;
    }
}