<?php
/**
 * 認証系ルーティング管理
 */
namespace App\Http\Controllers;

use Laravel\Socialite\Contracts\Factory as SocialiteManager;

/**
 * 認証周りのルーティング処理を行う
 */
class AuthController extends Controller
{
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
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleGitHubRdirect(SocialiteManager $socialiteManager)
    {
        dd($socialiteManager->driver('github')->user());
    }
}
