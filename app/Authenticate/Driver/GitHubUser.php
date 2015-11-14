<?php
/**
 * Expand of GenericUser for GitHub authentication.
 *
 * @author sota1235
 */

namespace App\Authenticate\Driver;

use Illuminate\Auth\GenericUser;

class GitHubUser extends GenericUser
{
    /**
     * Get the password for the user>
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return '';
    }
}
