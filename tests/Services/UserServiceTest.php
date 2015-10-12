<?php
/**
 * Test file for App\Services\UserService
 */
use App\Services\UserService;

/**
 * Test class for App\Services\UserService
 */
class UserServiceTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * test method for registerUser()
     * user's registration successed
     */
    public function testRegisterUserSuccess()
    {
        $this->app->bind('App\Interfaces\Models\UserModelInterface', function () {
            return new TestRegisterUserSuccess();
        });
        $userService = new UserService($this->app->make('App\Interfaces\Models\UserModelInterface'));
        // assertion
        $this->assertTrue($userService->registerUser('hoge', 'moge'));
    }

    /**
     * test method for registerUser()
     * user's registration failed
     */
    public function testRegisterUserFailed()
    {
        $this->app->bind('App\Interfaces\Models\UserModelInterface', function () {
            return new TestRegisterUserFailed();
        });
        $userService = new UserService($this->app->make('App\Interfaces\Models\UserModelInterface'));
        // assertion
        $this->assertFalse($userService->registerUser('hoge', 'moge'));
    }
}

abstract class AbstractUserMockClass implements \App\Interfaces\Models\UserModelInterface
{
    public function insertUser($gitHubName, $yoName) {}
    public function deleteUser($userId) {}
    public function getIdByGitHubName($gitHubName) {}
}

class TestRegisterUserSuccess extends AbstractUserMockClass
{
    public function insertUser($gitHubName, $yoName) { return 1; }
}

class TestRegisterUserFailed extends AbstractUserMockClass
{
    public function insertUser($gitHubName, $yoName) { return 0; }
}
