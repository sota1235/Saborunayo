<?php
/**
 * Ajax専用コントローラー
 */
namespace App\Http\Controllers;

use App\Interfaces\Services\UserServiceInterface as UserService;

/**
 * Ajaxリクエストのルーティングを行う
 */
class AjaxController extends Controller
{
    /**
     * Update phone number
     *
     * @param UserService  $user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePhoneNumber(UserService $userService)
    {
        $userId      = \Auth::driver('github')->user()->getAuthIdentifier();
        $phoneNumber = \Input::get('phone_number');

        $updateResult = $userService->updatePhoneNumber($userId, $phoneNumber);
        return response()->json([
            'status' => $updateResult ? 'success' : 'failed',
        ]);
    }
}
