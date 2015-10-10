<?php
/**
 * ユーザDB周りの処理を行う
 */
namespace App\Models;

use App\Interfaces\Models\UserModelInterface;
use DB;

/**
 * usersテーブルの処理を行うモデルクラス
 */
class UserModel extends Model implements UserModelInterface
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->table = 'users';
    }

    /**
     * ユーザを登録する
     *
     * @param string $gitHubName
     * @param string $yoName
     *
     * @return int $result
     */
    public function insertUser($gitHubName, $yoName)
    {
        $result = DB::table($this->table)->insert([
            'github_name' => $gitHubName,
            'yo_name'     => $yoName,
        ]);
        return $result;
    }

    /**
     * ユーザを削除する
     *
     * @param int $userId
     *
     * @return int $result
     */
    public function deleteUser($userId)
    {
        $result = DB::table($this->table)
            ->where('id', $userId)
            ->delete();
        return $result;
    }
}
