<?php
/**
 * ユーザ情報を制御する
 */
namespace App\Services;

use Laravel\Socialite\Two\User;
use App\Interfaces\Services\UserServiceInterface;
use App\Interfaces\Models\UserModelInterface as UserModel;
use App\Interfaces\Models\GitHubInfoModelInterface as GitHubInfoModel;

/**
 * ユーザ情報を制御するサービスクラス
 */
class UserService extends Service implements UserServiceInterface
{
    /** @var App\Interfaces\Models\UserModelInterface */
    protected $userModel;

    /** @var App\Interfaces\Models\GitHubInfoModelInterface */
    protected $gitHubInfoModel;

    /**
     * constructor
     *
     * @param UserModel       $userModel
     * @param GitHubInfoModel $gitHubInfoModel
     */
    public function __construct(UserModel $userModel, GitHubInfoModel $gitHubInfoModel)
    {
        $this->userModel       = $userModel;
        $this->gitHubInfoModel = $gitHubInfoModel;
    }

    /**
     * ユーザを登録する
     *
     * @param User $gitHubUser
     *
     * @return int $userId
     */
    public function registerUser(User $gitHubUser)
    {
        $gitHubId = $gitHubUser->getId();

        // 登録済みであればuser IDを返却
        if ($user = $this->userModel->getUserByGitHubId($gitHubId)) {
            return $user->id;
        }

        // usersに新たに登録
        $userId = $this->userModel->insertUser(null);
        // テーブル格納用データ
        $gitHubInformation = [
            'user_id'   => $userId,
            'token'     => $gitHubUser->offsetGet('token'),
            'github_id' => $gitHubUser->getId(),
            'nickname'  => $gitHubUser->getNickname(),
            'name'      => $gitHubUser->getName(),
            'email'     => $gitHubUser->getEmail(),
            'avatar'    => $gitHubUser->getAvatar(),
        ];
        $this->gitHubInfoModel->insert($gitHubInformation);
        return $userId;
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
