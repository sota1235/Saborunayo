<?php
/**
 * メインページ周りのルーティングを管理
 */
namespace App\Http\Controllers;

use Laravel\Socialite\Contracts\Factory as SocialiteManager;

/**
 * メインページ周りのルーティング管理を行う
 */
class MainController extends Controller
{
    /**
     * メインページのviewを返す
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('index');
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
}
