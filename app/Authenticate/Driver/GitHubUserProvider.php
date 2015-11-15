<?php
/**
 * Authの拡張クラス
 *
 * @author sota1235
 */

namespace App\Authenticate\Driver;

use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Authenticate\Driver\GitHubUser;
use App\Interfaces\Models\UserModelInterface as UserModel;

class GitHubUserProvider implements UserProvider
{
    /** @var UserModel */
    protected $user;

    /**
     * constructor
     *
     * @param UserModel $user
     */
    public function __construct(UserModel $user)
    {
        $this->user = $user;
    }

    /**
     * Retrieve a user by unique identifer.
     *
     * @param mixed $identifier
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveById($identifier)
    {
        $user = $this->user->getUserById($identifier);
        return $this->getGitHubUser($user);
    }

    /**
     * Retrieve a user by unique token and identifier.
     *
     * @param mixed  $identifier
     * @param string $token
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByToken($identifier, $token)
    {
        $user = $this->user->retrieveByToken($identifier, $token);
        return $this->getGitHubUser($user);
    }

    /**
     * Update the "remember me" token for the given user in storage.
     *
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     * @param string $token
     */
    public function updateRememberToken(Authenticatable $user, $token)
    {
        $this->user->updateRememberToken($user->getAuthIdentifier(), $token);
    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param array $credentials
     * @return null
     */
    public function retrieveByCredentials(array $credentials)
    {
        return;
    }

    /**
     * Validate a user against the given credentials.
     *
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     * @param array $credentials
     * @return true
     */
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        return true;
    }

    /**
     * Get the GitHub user.
     *
     * @param mixed $user
     *
     * @return \App\Authenticate\Driver\GitHubUser
     */
    protected function getGitHubUser($user)
    {
        if(!is_null($user)) {
            return new GitHubUser((array) $user);
        }
    }
}
