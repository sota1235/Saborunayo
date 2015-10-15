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
        try {
            $result = DB::table($this->table)->insert([
                'github_name' => $gitHubName,
                'yo_name'     => $yoName,
            ]);
        } catch (\PDOException $e) {
            \Log::error(
                'Insert user failed: error - '.$e->getMessage().' user - '.$gitHubName
            );
            return 0;
        }
        return $result;
    }

    /**
     * ユーザを削除する
     *
     * @param string $gitHubName
     *
     * @return int $result
     */
    public function deleteUser($gitHubName)
    {
        $result = DB::table($this->table)
            ->where('github_name', $gitHubName)
            ->delete();
        return $result;
    }
}
