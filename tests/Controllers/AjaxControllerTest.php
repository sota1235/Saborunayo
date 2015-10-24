<?php
/**
 * Test file for App\Http\Controllers\AjaxController
 */

use Illuminate\Foundation\Testing\WithoutMiddleware;

/**
 * Test class for App\Http\Controllers\AjaxController
 */
class AjaxControllerTest extends TestCase
{
    use WithoutMiddleware;

    public function setUp()
    {
        parent::setUp();
    }

    /**
     * test method for checkGitHubName
     * return success status
     */
    public function testCheckGitHubName()
    {
        // replace GitHubService with MockClass
        $this->app->bind('App\Interfaces\Services\GitHubServiceInterface', 'testCheckGitHubName');
        // assertion
        $this->post('/check/git', ['git_name' => 'sota'])
             ->seeJson([
                 'status' => 'success',
             ]);
    }

    /**
     * test method for checkGitHubName
     * return failed status
     */
    public function testCheckGitHubNameFailed()
    {
        // replace GitHubService with MockClass
        $this->app->bind('App\Interfaces\Services\GitHubServiceInterface', 'testCheckGitHubNameFailed');
        // assertion
        $this->post('/check/git', ['git_name' => 'soke'])
             ->seeJson([
                 'status' => 'failed',
             ]);
    }

    /**
     * test method for registerUser
     * return success status
     */
    public function testRegisterUser()
    {
        // replace GitHubService with MockClass
        $this->app->bind('App\Interfaces\Services\UserServiceInterface',
            'testRegisterUserUser'
        );
        $this->app->bind('App\Interfaces\Services\YoServiceInterface',
            'testRegisterUserYo'
        );
        // assertion
        $this->post('/register/user', ['git_name' => 'sota', 'yo_name' => 'hoge'])
             ->seeJson([
                 'status' => 'success',
             ]);
    }

    /**
     * test method for registerUser
     * return failed status
     */
    public function testRegisterUserFailed()
    {
        /* case 1: add yo user success */
        // replace GitHubService with MockClass
        $this->app->bind('App\Interfaces\Services\UserServiceInterface',
            'testRegisterUserFailedUser'
        );
        $this->app->bind('App\Interfaces\Services\YoServiceInterface',
            'testRegisterUserYo'
        );
        // assertion
        $this->post('/register/user', ['git_name' => 'sota', 'yo_name' => 'hoge'])
             ->seeJson([
                 'status' => 'failed',
             ]);

        /* case 2: all process failed */
        // replace GitHubService with MockClass
        $this->app->bind('App\Interfaces\Services\YoServiceInterface',
            'testRegisterUserFailedYo'
        );
        // assertion
        $this->post('/register/user', ['git_name' => 'sota', 'yo_name' => 'hoge'])
             ->seeJson([
                 'status' => 'failed',
             ]);
    }
}

abstract class GitHubServiceMock implements \App\Interfaces\Services\GitHubServiceInterface
{
    public function isExist($userName) {}
    public function checkContribution($userName) {}
}

abstract class UserServiceMock implements \App\Interfaces\Services\UserServiceInterface
{
    public function registerUser($gitHubName, $yoName) {}
    public function dropUser($gitHubName) {}
}

abstract class YoServiceMock implements \App\Interfaces\Services\YoServiceInterface
{
    public function sendYo() {}
    public function addUser($userName) {}
    public function dropUser($userName) {}
    public function isExist($userName) {}
}

class testCheckGitHubName extends GitHubServiceMock
{
    public function isExist($userName) { return true; }
}

class testCheckGitHubNameFailed extends GitHubServiceMock
{
    public function isExist($userName) { return false; }
}

class testRegisterUserUser extends UserServiceMock
{
    public function registerUser($gitHubName, $yoName) { return true; }
}

class testRegisterUserYo extends YoServiceMock
{
    public function addUser($yoName) { return true; }
}

class testRegisterUserFailedUser extends UserServiceMock
{
    public function registerUser($gitHubName, $yoName) { return false; }
}

class testRegisterUserFailedYo extends YoServiceMock
{
    public function addUser($yoName) { return false; }
}
