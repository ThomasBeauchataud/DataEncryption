<?php

/*
 * This file is part of the tbcd/ata-encryption library.
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

interface DataEncryptorInterface
{

    /**
     * @param string $decryptedData
     * @return string
     */
    public function encrypt(string $decryptedData): string;

    /**
     * @param string $encryptedData
     * @return string
     */
    public function decrypt(string $encryptedData): string;

}