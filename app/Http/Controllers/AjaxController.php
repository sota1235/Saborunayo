<?php
/**
 * ajax通信の受け口を管理
 */
namespace App\Http\Controllers;

use App\Interfaces\Services\GitHubServiceInterface as GitHubService;
use App\Interfaces\Services\YoServiceInterface     as YoService;
use App\Interfaces\Services\UserServiceInterface   as UserService;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Http\Request;

/**
 * ajaxによるリクエストをさばく
 */
class AjaxController extends Controller
{
    /** @var App\Interfaces\Services\GitHubServiceInteface */
    protected $gitHubService;

    /** @var App\Interfaces\Services\YoServiceInteface */
    protected $yoService;

    /** @var App\Interfaces\Services\UserServiceInteface */
    protected $userService;

    /**
     * constructor
     */
    public function __construct(GitHubService $gitHubService, YoService $yoService, UserService $userService)
    {
        $this->gitHubService = $gitHubService;
        $this->yoService     = $yoService;
        $this->UserService   = $userService;
    }

    /**
     * GitHubにユーザアカウントが存在するかを返す
     *
     * @return Illuminate\Http\JsonResponse $json
     */
    public function checkGitHubName(Request $request)
    {
        $this->validate($request, [
            'git_name' => 'required|string|max:1024',
        ]);

        $userName = \Input::get('git_name');

        // judge user name exists in github
        $isExist = $this->gitHubService->isExist($userName);
        $json    = $this->statusJson($isExist);

        // GitHubにアカウントが存在するかをjsonでreturn
        return $json;
    }

    /**
     * ユーザを登録する
     *
     * @return Illuminate\Http\JsonResponse $json
     */
    public function registerUser(RegisterUserRequest $request)
    {
        $yoName  = \Input::get('yo_name');
        $gitName = \Input::get('git_name');

        // send Yo
        if ($this->yoService->addUser($yoName)) {
            $result = $this->userService->registerUser($gitName, $yoName);
            return $this->statusJson($result ? true : false);
        } else {
            return $this->statusJson(false);
        }
    }

    /**
     * 処理の成功の可否メッセージのJSON生成
     *
     * @param bool $status
     *
     * @return Illuminate\Http\JsonResponse $json
     */
    private function statusJson($status)
    {
        $json = [
            'status' => $status ? 'success' : 'failed',
        ];
        return response()->json($json);
    }
}
