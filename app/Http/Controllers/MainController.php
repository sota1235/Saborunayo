<?php
/**
 * メインページ周りのルーティングを管理
 */
namespace App\Http\Controllers;

/**
 * メインページ周りのルーティング管理を行う
 */
class MainController extends Controller
{
    /**
     * メインページのviewを返す
     *
     * @return view
     */
    public function index()
    {
        return view('index');
    }
}
