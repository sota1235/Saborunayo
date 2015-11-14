<?php
/**
 * 認証系ルーティング管理
 */
namespace App\Http\Controllers;

use Laravel\Socialite\Contracts\Factory as SocialiteManager;
use App\Interfaces\Services\UserServiceInterface as UserService;

/**
 * 認証周りのルーティング処理を行う
 */
class AuthController extends Controller
{
    /**
     * Return login page
     *
     * @return \Illuminate\View\View
     */
    public function getLogin()
    {
        return view('login');
    }

    /**
     * Redirect to GitHub Authorization
     *
     * @param SocialiteManager $socialiteManager
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToGitHub(SocialiteManager $socialiteManager)
    {
        return $socialiteManager->driver('github')->redirect();
    }

    /**
     * Handle redirection from GitHub OAuth
     *
     * @param SocialiteManager $socialiteManager
     * @param UserService      $userService
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleGitHubRdirect(
        SocialiteManager $socialiteManager,
        UserService      $userService
    ) {
        $user = $socialiteManager->driver('github')->user();
        $id = $userService->registerUser($user);
        \Auth::driver('github')->loginUsingId($id);
        return redirect()->route('main');
    }
}
