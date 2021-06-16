<?php

namespace Tests\Unit;

use Dev\Domain\Service\DataProviderXService;
use Tests\TestCase;

class DataProviderXTest extends TestCase
{
    private $dataProviderXService;

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->dataProviderXService = app(DataProviderXService::class);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testGetData()
    {
        $data = $this->dataProviderXService->getData();
        $this->assertIsArray($data);
        if ($data) {
            $this->assertNotEmpty($data);
            $this->assertArrayHasKey('balance', $data[0]);
            $this->assertArrayHasKey('currency', $data[0]);
            $this->assertArrayHasKey('email', $data[0]);
            $this->assertArrayHasKey('status', $data[0]);
            $this->assertArrayHasKey('registration_date', $data[0]);
            $this->assertArrayHasKey('identification', $data[0]);
        }
    }
}
