<?php
/**
 * ajax通信の受け口を管理
 */
namespace App\Http\Controllers;

/**
 * ajaxによるリクエストをさばく
 */
class AjaxController extends Controller
{
  /**
   * GitHubにユーザアカウントが存在するかを返す
   *
   * @return json
   */
  public function checkGitHubName()
  {
    // GitHubにアカウントが存在するかをjsonでreturn
    return response()->json([
      'status' => 'success'
    ]);
  }
}
