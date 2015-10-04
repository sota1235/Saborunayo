<?php
/**
 * ajax通信の受け口を管理
 */
namespace App\Http\Controllers;

use App\Interfaces\Services\GitHubServiceInterface as GitHubService;

/**
 * ajaxによるリクエストをさばく
 */
class AjaxController extends Controller
{
    /** @var App\Interfaces\Services\GitHubServiceInteface */
    protected $gitHubService;

    /**
     * constructor
     */
    public function __construct(GitHubService $gitHubService)
    {
        $this->gitHubService = $gitHubService;
    }

    /**
     * GitHubにユーザアカウントが存在するかを返す
     *
     * @return json
     */
    public function checkGitHubName()
    {
        $userName = \Input::get('git_name');

        // judge user name exists in github
        $isExist = $this->gitHubService->isExist($userName);
        $status = $isExist ? 'success' : 'failed';

        // GitHubにアカウントが存在するかをjsonでreturn
        return response()->json([
            'status' => $status
        ]);
    }
}
