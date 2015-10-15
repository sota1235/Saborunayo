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
}

abstract class GitHubServiceMock implements \App\Interfaces\Services\GitHubServiceInterface
{
    public function isExist($userName) {}
    public function checkContribution($userName) {}
}

class testCheckGitHubName extends GitHubServiceMock
{
    public function isExist($userName) { return true; }
}

class testCheckGitHubNameFailed extends GitHubServiceMock
{
    public function isExist($userName) { return false; }
}
