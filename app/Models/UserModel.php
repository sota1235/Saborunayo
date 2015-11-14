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
    /** @var string */
    protected $table;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->table = 'users';
    }

    /**
     * 有効な登録済みユーザを取得
     *
     * @return array
     */
    public function getUsers()
    {
        return DB::table($this->table)->where('deleted_flag', 0)->get();
    }

    /**
     * ユーザIDからユーザ情報を取得
     *
     * @param int   $userId
     * @param array $culumns
     *
     * @return array|null
     */
    public function getUserById($userId, array $columns = ['*'])
    {
        return \DB::table($this->table)->where('id', $userId)->first($columns);
    }

    /**
     * remember_tokenからユーザを取得
     *
     * @param mixed  $userId
     * @param string $token
     * @param array  $culumns
     *
     * @return array|null
     */
    public function retrieveByToken($userId, $token, array $columns = ['*'])
    {
        return \DB::table($this->table)->where('id', $userId)
            ->where('remember_token', $token)->first($columns);
    }

    /**
     * ユーザを登録する
     *
     * @param string $gitHubName
     * @param int    $phoneNumber
     *
     * @return int $result
     */
    public function insertUser($gitHubName, $phoneNumber)
    {
        return $result = DB::table($this->table)->insert([
            'github_name'  => $gitHubName,
            'phone_number' => $phoneNumber,
        ]);
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
