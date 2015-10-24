<?php
/**
 * Yo APIと通信するクラス
 */
namespace App\Interfaces\Services;

interface YoServiceInterface
{
    /**
     * 登録済みユーザ全員にYoを送る
     *
     * @return void
     */
    public function sendYo();

    /**
     * ユーザをYo対象リストに登録する
     *
     * @param string $userName
     *
     * @return bool $result
     */
    public function addUser($userName);

    /**
     * Yoアカウントが存在するかどうか調べる
     *
     * @param string $userName
     *
     * @return bool
     */
    public function isExist($userName);

    /**
     * ユーザをYo対象リストから削除する
     *
     * @param string $userName
     *
     * @return bool $result
     */
    public function dropUser($userName);
}
