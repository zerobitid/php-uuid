<?php
namespace Zerobit\UUID;

class UUID
{
    private $uuidStr;

    public function __construct($uuidStr)
    {
        $this->validate($uuidStr);
        $this->uuidStr = $uuidStr;
    }

    private function validate($uuidStr)
    {
        if (!$this->isValidV4($uuidStr)) {
            throw new UUIDException("Not supported UUID format");
        }
    }

    private function isValidV4($uuidStr)
    {
        preg_match(
            '/^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i',
            $uuidStr,
            $matches
        );
        if (empty($matches)) {
            return false;
        }
        return true;
    }

    public function getUuidStr()
    {
        return $this->uuidStr;
    }

    public function toString()
    {
        return $this->uuidStr;
    }

    public function __toString()
    {
        return $this->toString();
    }

    public static function newV4()
    {
        $original = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',

            // 32 bits for "time_low"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),

            // 16 bits for "time_mid"
            mt_rand(0, 0xffff),

            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand(0, 0x0fff) | 0x4000,

            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand(0, 0x3fff) | 0x8000,

            // 48 bits for "node"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );

        return new static($original);
    }
}
