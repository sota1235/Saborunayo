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
        $this->serviceName = '\App\Interfaces\Services\GitHubServiceInterface';
    }

    /**
     * test method for isExist
     * user is exist in GitHub
     */
    public function testIsExistSuccess()
    {
        // replace class with mock
        $this->app->bind($this->serviceName, 'TestIsExistSuccess');
        // assertion
        $gitHubService = $this->app->make($this->serviceName);
        $this->assertTrue($gitHubService->isExist('hoge'));
    }

    /**
     * test method for isExist
     * user is exist in GitHub
     */
    public function testIsExistFailed()
    {
        // replace class with mock
        $this->app->bind($this->serviceName, 'TestIsExistFailed');
        // assertion
        $gitHubService = $this->app->make($this->serviceName);
        $this->assertFalse($gitHubService->isExist('hoge'));
    }

    /**
     * test method for getGitHubUrl
     */
    public function testGitHubUrlTest()
    {
        $gitHubService = $this->app->make($this->serviceName);
        $method = new ReflectionMethod($gitHubService, 'getGitHubUrl');
        $method->setAccessible(true);
        $this->assertEquals(
            'https://github.com/users/sota1235/contributions',
            $method->invoke($gitHubService, 'sota1235')
        );
    }
}

abstract class guzzleMockFactory extends \App\Services\GitHubService
{
    protected function getGuzzleMock(Response $response)
    {
        $mock    = new MockHandler([$response]);
        $handler = HandlerStack::create($mock);
        return new Client(['handler' => $handler]);
    }
}

class TestIsExistSuccess extends guzzleMockFactory
{
    public function getHttpClient()
    {
        return $this->getGuzzleMock(new Response(200));
    }
}
class TestIsExistFailed extends guzzleMockFactory
{
    public function getHttpClient()
    {
        return $this->getGuzzleMock(new Response(404));
    }
}
