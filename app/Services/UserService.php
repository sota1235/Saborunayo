<?php
/**
 * ユーザ情報を制御する
 */
namespace App\Services;

use App\Interfaces\Services\UserServiceInterface;
use App\Interfaces\Models\UserModelInterface as UserModel;

/**
 * ユーザ情報を制御するサービスクラス
 */
class UserService extends Service implements UserServiceInterface
{
    /** @var App\Interfaces\Models\UserModelInterface */
    protected $userModel;

    /**
     * constructor
     */
    public function __construct(UserModel $userModel)
    {
        $this->userModel;
    }

    /**
     * ユーザを登録する
     *
     * @param string $gitName
     * @param string $yoName
     *
     * @return bool $result
     */
    public function registerUser($gitName, $yoName)
    {
        $result = $this->UserModel->insertUser($gitName, $yoName);
        return $result ? true : false;
    }

    /**
     * ユーザを削除する
     *
     * @param string $gitName
     *
     * @return bool $result
     */
    public function dropUser($gitName)
    {
    }
}
