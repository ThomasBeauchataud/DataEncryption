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
 * From 17/09/2023
 */

namespace TBCD\DataEncryption;

interface DataEncryptorAwareInterface extends DataEncryptorInterface
{

    /**
     * @param string $data
     * @return bool
     */
    public function isEncrypted(string $data): bool;

}