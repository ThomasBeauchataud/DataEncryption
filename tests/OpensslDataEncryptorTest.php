<?php

/*
 * This file is part of the tbcd/cas project.
 *
 * (c) Thomas Beauchataud <thomas.beauchataud@yahoo.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Author Thomas Beauchataud
 * From 13/06/2023
 */

namespace TBCD\DataEncryption\Tests;

use PHPUnit\Framework\TestCase;
use TBCD\DataEncryption\OpensslDataEncryptor;

class OpensslDataEncryptorTest extends TestCase
{

    public function test(): void
    {
        $secret = uniqid();
        $content = uniqid();
        $opensslDataEncryptor = new OpensslDataEncryptor($secret);
        $this->assertNotEmpty($content);
        $encryptedContent = $opensslDataEncryptor->encrypt($content);
        $this->assertNotEmpty($encryptedContent);
        $this->assertNotEquals($content, $encryptedContent);
        $decodedContent = $opensslDataEncryptor->decrypt($encryptedContent);
        $this->assertEquals($content, $decodedContent);
    }
}