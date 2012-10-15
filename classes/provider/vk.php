<?php defined('SYSPATH') or die('No direct script access.');

class Provider_VK extends Provider
{
    protected $user;

    /**
     * @param $return_url
     * Get the URL to redirect to.
     * @return string
     */
    public function redirect_url($return_url)
    {
        $vk = VK::Instance();
        list($url, $params) = $vk->GetUserLoginUrl(
            Route::url('user/provider_return', array('provider' => 'vk'), true)
        );
        return $url . '?' . $vk->Params($params);
    }

    /**
     * Verify the login result and do whatever is needed to access the user data from this provider.
     * @return bool
     */
    public function verify()
    {
        $vk = VK::Instance();
        if ($code = Arr::get($_GET, 'code')) {
            $vk->LoginApp($code,
                Route::url('user/provider_return', array('provider' => 'vk'), true)
            );

            $this->user = $vk->Call('users.get', array(
                'uids' => $vk->GetToken('user_id')
            ));
            $this->user = $this->user[0];
            return true;
        }
        return false;
    }

    /**
     * Attempt to get the provider user ID.
     * @return mixed
     */
    public function user_id()
    {
        return (string)$this->user['uid'];
    }

    /**
     * Attempt to get the email from the provider (e.g. for finding an existing account to associate with).
     * @return string
     */
    public function email()
    {
        //vk.com does not allow us to get the email
        return false;
    }

    /**
     * Get the full name (firstname surname) from the provider.
     * @return string
     */
    public function name()
    {
        return $this->user['first_name'] . ' ' . $this->user['last_name'];
    }
}