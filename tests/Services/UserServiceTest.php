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

        $this->userModelName = 'App\Interfaces\Models\UserModelInterface';
    }

    /**
     * test method for registerUser()
     * user's registration successed
     */
    public function testRegisterUserSuccess()
    {
        $this->app->bind($this->userModelName, 'TestRegisterUserSuccess');
        $userService = new UserService($this->userModelFactory());
        // assertion
        $this->assertTrue($userService->registerUser('hoge', 'moge'));
    }

    /**
     * test method for registerUser()
     * user's registration failed
     */
    public function testRegisterUserFailed()
    {
        $this->app->bind($this->userModelName, 'TestRegisterUserFailed');
        $userService = new UserService($this->userModelFactory());
        // assertion
        $this->assertFalse($userService->registerUser('hoge', 'moge'));
    }

    /**
     * return UserModel instance from service container
     */
    private function userModelFactory()
    {
        return $this->app->make($this->userModelName);
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
