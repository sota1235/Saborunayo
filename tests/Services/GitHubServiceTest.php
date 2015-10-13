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
        $client = $this->guzzleMockFactory(new Response(200));

        $gitHubService->expects($this->once())
                      ->method('getHttpClient')
                      ->will($this->returnValue($client));
        // assertion
        $this->assertTrue($gitHubService->isExist('hoge'));
    }

    /**
     * test method for isExist
     * user is exist in GitHub
     */
    public function testIsExistFailed()
    {
        $gitHubService = $this->getMockBuilder('App\Services\GitHubService')
                              ->setMethods(['getHttpClient'])
                              ->getMock();
        // make guzzle mock
        $client = $this->guzzleMockFactory(new Response(404));

        $gitHubService->expects($this->once())
                      ->method('getHttpClient')
                      ->will($this->returnValue($client));
        // assertion
        $this->assertFalse($gitHubService->isExist('hoge'));
    }

    /**
     * make guzzle mock it returns specified Response
     *
     * @param Response $response
     *
     * @return Client
     */
    private function guzzleMockFactory(Response $response)
    {
        $mock    = new MockHandler([$response]);
        $handler = HandlerStack::create($mock);
        return new Client(['handler' => $handler]);
    }
}
