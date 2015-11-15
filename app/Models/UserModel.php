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
        return \DB::table($this->table)
            ->leftJoin('github_informations AS gi', 'users.id', '=', 'gi.user_id')
            ->where('users.deleted_flag', 0)->get();
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
        return \DB::table($this->table)
            ->leftJoin('github_informations AS gi', 'users.id', '=', 'gi.user_id')
            ->where('users.id', $userId)->first($columns);
    }

    /**
     * GitHub IDからユーザ情報を取得
     *
     * @param mixed $gitHubId
     *
     * @return array|null
     */
    public function getUserByGitHubId($gitHubId)
    {
        return \DB::table($this->table)
            ->leftJoin('github_informations as gi', 'users.id', '=', 'gi.user_id')
            ->where('gi.github_id', $gitHubId)
            ->first();
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
     * remember_tokenを更新
     *
     * @param mixed  $userId
     * @param string $token
     */
    public function updateRememberToken($userId, $token)
    {
        \DB::table($this->table)->where('id', $userId)
            ->update(['remember_token' => $token]);
    }

    /**
     * ユーザを登録し、IDを返す
     *
     * @param int $phoneNumber
     *
     * @return int
     */
    public function insertUser($phoneNumber)
    {
        return $result = DB::table($this->table)->insertGetId([
            'phone_number' => $phoneNumber,
        ]);
    }
}
