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
        $phoneNumber = \Auth::driver('github')->user()->__get('phone_number');
        return view('edit', [
            'phoneNumber' => $phoneNumber === 'tmp' ? null : $phoneNumber,
        ]);
    }
}
