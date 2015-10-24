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
    /**
     * GitHubにユーザアカウントが存在するかを返す
     *
     * @return Illuminate\Http\JsonResponse $json
     */
    public function checkGitHubName(Request $request, GitHubService $gitHubService)
    {
        $this->validate($request, [
            'git_name' => 'required|string|max:1024',
        ]);

        $userName = \Input::get('git_name');

        // judge user name exists in github
        $isExist = $gitHubService->isExist($userName);
        $json    = $this->statusJson($isExist);

        // GitHubにアカウントが存在するかをjsonでreturn
        return $json;
    }

    /**
     * ユーザを登録する
     *
     * @return Illuminate\Http\JsonResponse $json
     */
    public function registerUser(
      RegisterUserRequest $request, YoService $yoService, UserService $userService
    )
    {
        $yoName  = \Input::get('yo_name');
        $gitName = \Input::get('git_name');

        // send Yo
        if ($yoService->sendYo($yoName)) {
            $result = $userService->registerUser($gitName, $yoName);
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
