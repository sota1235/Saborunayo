<?php
/**
 * Test file for App\Services\GitHubService
 */
use App\Services\GitHubService;
// for making Guzzle mock
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

/**
 * Test class for App\Services\GitHubService
 */
class GitHubServiceTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * test method for isExist
     * user is exist in GitHub
     */
    public function testIsExistSuccess()
    {
        $gitHubService = $this->getMockBuilder('App\Services\GitHubService')
                              ->setMethods(['getHttpClient'])
                              ->getMock();
        // make guzzle mock
        $mock = new MockHandler([
            new Response(200),
        ]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $gitHubService->expects($this->once())
                      ->method('getHttpClient')
                      ->will($this->returnValue($client));
        // assertion
        $this->assertTrue($gitHubService->isExist('hoge'));
    }
}
