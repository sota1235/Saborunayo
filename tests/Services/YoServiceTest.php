<?php
/**
 * Test file for App\Services\YoService
 */
use App\Services\YoService;
// for making Guzzle mock
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

/**
 * Test class for App\Services\YoService
 */
class YoServiceTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * test method for sendYoAll
     * yo successed
     */
    public function testSendYoSuccess()
    {
        // guzzle mock
        $client = $this->guzzleMockFactory(new Response(200));
        // self mock
        $yoService = $this->getMockBuilder('App\Services\YoService')
                          ->setMethods(['getHttpClient'])
                          ->getMock();
        $yoService->expects($this->once())
                  ->method('getHttpClient')
                  ->will($this->returnValue($client));
        // log settings
        $path = base_path('tests/storage/logs/yo.log');
        \Log::useFiles($path);
        // assertsion
        $this->assertTrue($yoService->sendYoAll());
        $this->assertFileExists($path);
        $this->assertNotFalse(strpos(file_get_contents($path), 'success'));
        // remove log
        $this->beforeApplicationDestroyed(function() use ($path) {
            \File::delete($path);
        });
    }

    /**
     * test method for sendYoAll
     * yo failed
     */
    public function testSendYoFailed()
    {
        // guzzle mock
        $client = $this->guzzleMockFactory(new Response(404));
        // self mock
        $yoService = $this->getMockBuilder('App\Services\YoService')
                          ->setMethods(['getHttpClient'])
                          ->getMock();
        $yoService->expects($this->once())
                  ->method('getHttpClient')
                  ->will($this->returnValue($client));
        // log settings
        $path = base_path('tests/storage/logs/yo.log');
        \Log::useFiles($path);
        // assertsion
        $this->assertFalse($yoService->sendYoAll());
        $this->assertFileExists($path);
        $this->assertNotFalse(strpos(file_get_contents($path), 'failed'));
        // remove log
        $this->beforeApplicationDestroyed(function() use ($path) {
            \File::delete($path);
        });
    }

    /**
     * test method for sendYo
     * yo successed
     */
    public function testAddUserSuccess()
    {
        // guzzle mock
        $client = $this->guzzleMockFactory(new Response(200));
        // self mock
        $yoService = $this->getMockBuilder('App\Services\YoService')
                          ->setMethods(['getHttpClient'])
                          ->getMock();
        $yoService->expects($this->once())
                  ->method('getHttpClient')
                  ->will($this->returnValue($client));
        // log settings
        $path = base_path('tests/storage/logs/yo.log');
        \Log::useFiles($path);
        // mock data
        $mockUser = 'udon';
        // assertsion
        $this->assertTrue($yoService->sendYo($mockUser));
        $this->assertFileExists($path);
        $log = file_get_contents($path);
        $this->assertNotFalse(strpos($log, $mockUser));
        $this->assertNotFalse(strpos($log, 'success'));
        // remove log
        $this->beforeApplicationDestroyed(function() use ($path) {
            \File::delete($path);
        });
    }

    /**
     * test method for sendYo
     * yo failed
     */
    public function testAddUserFailed()
    {
        // guzzle mock
        $client = $this->guzzleMockFactory(new Response(404));
        // self mock
        $yoService = $this->getMockBuilder('App\Services\YoService')
                          ->setMethods(['getHttpClient'])
                          ->getMock();
        $yoService->expects($this->once())
                  ->method('getHttpClient')
                  ->will($this->returnValue($client));
        // log settings
        $path = base_path('tests/storage/logs/yo.log');
        \Log::useFiles($path);
        // mock data
        $mockUser = 'udon';
        // assertsion
        $this->assertFalse($yoService->sendYo($mockUser));
        $this->assertFileExists($path);
        $log = file_get_contents($path);
        $this->assertNotFalse(strpos($log, $mockUser));
        $this->assertNotFalse(strpos($log, 'failed'));
        $this->assertNotFalse(strpos($log, 'error message'));
        // remove log
        $this->beforeApplicationDestroyed(function() use ($path) {
            \File::delete($path);
        });
    }

    /**
     * test method for isExist
     * yo account exist
     */
    public function testIsExistTrue()
    {
        // guzzle mock
        $mockRes = "{ \"exists\": true }";
        $client = $this->guzzleMockFactory(new Response(200, [], $mockRes));
        // self mock
        $yoService = $this->getMockBuilder('App\Services\YoService')
                          ->setMethods(['getHttpClient'])
                          ->getMock();
        $yoService->expects($this->once())
                  ->method('getHttpClient')
                  ->will($this->returnValue($client));
        // assertsion
        $this->assertTrue($yoService->isExist('hoge'));
    }

    /**
     * test method for isExist
     * yo account not exist
     */
    public function testIsExistFalse()
    {
        // guzzle mock
        $mockRes = "{ \"exists\": false }";
        $client = $this->guzzleMockFactory(new Response(200, [], $mockRes));
        // self mock
        $yoService = $this->getMockBuilder('App\Services\YoService')
                          ->setMethods(['getHttpClient'])
                          ->getMock();
        $yoService->expects($this->once())
                  ->method('getHttpClient')
                  ->will($this->returnValue($client));
        // assertsion
        $this->assertFalse($yoService->isExist('hoge'));
    }

    /**
     * test method for isExist
     * some http error
     */
    public function testIsExistHttpFailed()
    {
        // guzzle mock
        $client = $this->guzzleMockFactory(new Response(404));
        // self mock
        $yoService = $this->getMockBuilder('App\Services\YoService')
                          ->setMethods(['getHttpClient'])
                          ->getMock();
        $yoService->expects($this->once())
                  ->method('getHttpClient')
                  ->will($this->returnValue($client));
        // log settings
        $path = base_path('tests/storage/logs/yo.log');
        \Log::useFiles($path);
        // mock data
        $mockUser = 'udon2';
        // assertsion
        $this->assertFalse($yoService->isExist($mockUser));
        $this->assertFileExists($path);
        $log = file_get_contents($path);
        $this->assertNotFalse(strpos($log, $mockUser));
        $this->assertNotFalse(strpos($log, 'Checking Yo Account'));
        $this->assertNotFalse(strpos($log, 'error message'));
        // remove log
        $this->beforeApplicationDestroyed(function() use ($path) {
            \File::delete($path);
        });
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
