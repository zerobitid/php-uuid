<?php

use Faker\Factory as Faker;
use Zerobit\UUID\UUID;
use Zerobit\UUID\UUIDException;

class UUIDTest extends PHPUnit\Framework\TestCase
{
    private $faker;

    protected function setup()
    {
        $this->faker = Faker::create();
    }

    /** @test */
    public function shouldFailCreateUUID()
    {
        $this->expectException(UUIDException::class);
        $uuid = new UUID($this->faker->word);
    }

    /** @test */
    public function shouldGenerateDifferentId()
    {
        $uuid1 = UUID::newV4();
        $uuid2= UUID::newV4();

        $this->assertNotEquals($uuid1, $uuid2);
    }

    /** @test */
    public function shouldConvertToString()
    {
        $uuid = UUID::newV4();
        $this->assertEquals($uuid->getUuidStr(), (string)$uuid);
    }
}

