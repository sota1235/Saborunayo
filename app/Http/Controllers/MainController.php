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
     * 電話番号編集ページを表示
     *
     * @return \Illuminate\View\View
     */
    public function getEdit()
    {
        return view('edit', [
            'githubName'  => 'github_name',
            'phoneNumber' => 'hoge'
        ]);
    }
}
