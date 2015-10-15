<?php
/**
 * Test file for App\Services\Service
 */

// for making Guzzle mock
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

/**
 * Test class for App\Services\YoService
 */
class ServiceTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * test method for getHttpClient
     */
    public function testGetHttpClient()
    {
        $service = $this->getMockForAbstractClass('App\Services\Service');
        // assertion
        $this->assertInstanceOf('\GuzzleHttp\Client', $service->getHttpClient());
    }
}
