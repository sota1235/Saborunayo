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
        $this->userModel = $userModel;
    }

    /**
     * ユーザを登録する
     *
     * @param string $gitHubName
     * @param string $yoName
     *
     * @return bool $result
     */
    public function registerUser($gitHubName, $yoName)
    {
        $result = $this->userModel->insertUser($gitHubName, $yoName);
        return $result ? true : false;
    }

    /**
     * 全ユーザの情報を取得
     *
     * @return array
     */
    public function getUsers()
    {
        return $this->userModel->getUsers();
    }

    /**
     * ユーザを削除する
     *
     * @param string $gitHubName
     *
     * @return bool $result
     */
    public function dropUser($gitHubName)
    {
        $result = $this->userModel->deleteUser($gitHubName);
        return $result ? true : false;
    }
}
