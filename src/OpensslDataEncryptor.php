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
 * Data Encryptor based on php openssl encryption
 */
final class OpensslDataEncryptor implements DataEncryptorAwareInterface
{

    private const encryption_prefix = "<encrypt>";
    private const encryption_suffix = "</encrypt>";

    /**
     * @var string
     */
    private string $secret;

    /**
     * @var string
     */
    private string $algorithm;

    /**
     * @var int
     */
    private int $options;

    /**
     * @var string
     */
    private string $vector;

    /**
     * @param string $secret
     * @param string $algorithm
     * @param int $options
     * @param string $vector
     */
    public function __construct(string $secret, string $algorithm = 'aes-256-cfb', int $options = 0, string $vector = 'c5196cc421d04a04')
    {
        $this->secret = $secret;
        $this->algorithm = $algorithm;
        $this->options = $options;
        $this->vector = $vector;
    }


    /**
     * @inheritDoc
     */
    public function encrypt(string $decryptedData): string
    {
        if ($this->isEncrypted($decryptedData)) {
            return $decryptedData;
        }

        $encryptedData = openssl_encrypt($decryptedData, $this->algorithm, $this->secret, $this->options, $this->vector);
        return $this->wrapEncryptedData($encryptedData);
    }

    /**
     * @inheritDoc
     */
    public function decrypt(string $encryptedData): string
    {
        if (false === $this->isEncrypted($encryptedData)) {
            return $encryptedData;
        }

        $encryptedData = $this->unwrapEncryptedData($encryptedData);
        return openssl_decrypt($encryptedData, $this->algorithm, $this->secret, $this->options, $this->vector);
    }

    /**
     * @inheritDoc
     */
    public function isEncrypted(string $data): bool
    {
        return str_starts_with($data, self::encryption_prefix) && str_ends_with($data, self::encryption_suffix);
    }

    /**
     * @param string $encryptedData
     * @return string
     */
    private function wrapEncryptedData(string $encryptedData): string
    {
        return self::encryption_prefix . $encryptedData . self::encryption_suffix;
    }

    /**
     * @param string $encryptedData
     * @return string
     */
    private function unwrapEncryptedData(string $encryptedData): string
    {
        $encryptedData = substr($encryptedData, strlen(self::encryption_prefix));
        return substr($encryptedData, 0, -strlen(self::encryption_suffix));
    }
}