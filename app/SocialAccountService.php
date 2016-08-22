<?php

namespace App;

use Laravel\Socialite\Contracts\Provider;

class SocialAccountService
{
    /**
     * @var object
     */
    protected $providerUser;

    /**
     * @var string
     */
    protected $providerName;

    /**
     * @param Provider $provider
     * @return static
     */
    public function createOrGetUser(Provider $provider)
    {
        $this->providerUser = $provider->user();
        $this->providerName = class_basename($provider);

        $account = SocialAccount::whereProvider($this->providerName)
            ->whereProviderUserId($this->providerUser->getId())
            ->first();

        if ($account) {
            return [
                'user' => $account->user,
                'is_new' => false,
            ];
        } else {

            $account = new SocialAccount([
                'provider_user_id' => $this->providerUser->getId(),
                'provider' => $this->providerName
            ]);

            $user = User::whereEmail($this->providerUser->getEmail())->first();

            if (!$user) {

                $role = Role::where('name', 'user')->first();

                $user = User::create([
                    'email' => $this->providerUser->getEmail(),
                    'fullname' => $this->providerUser->getName(),
                    'firstname' => $this->getFirstname(),
                    'lastname' => $this->getLastname(),
                    'role_id' => $role->id,
                ]);
            }

            $account->user()->associate($user);
            $account->save();

            return [
                'user' => $user,
                'is_new' => true,
                'provider' => $this->providerName,
            ];
        }
    }

    /**
     * @return null|string
     */
    private function getFirstname()
    {
        $firstname = null;

        switch ($this->providerName) {
            case 'GoogleProvider':
                $firstname = $this->providerUser->user['name']['givenName'];
                break;
            case 'FacebookProvider':
                $firstname = explode(' ', $this->providerUser->getName())[0];
                break;
        }

        return $firstname;
    }

    /**
     * @return null|string
     */
    private function getLastname()
    {
        $lastname = null;

        switch ($this->providerName) {
            case 'GoogleProvider':
                $lastname = $this->providerUser->user['name']['familyName'];
                break;
            case 'FacebookProvider':
                $name = explode(' ', $this->providerUser->getName());
                array_shift($name);
                $lastname = implode(' ', $name);
                break;
        }

        return $lastname;
    }

    /**
     * @return null|string
     */
    private function getGender()
    {
        return isset($this->providerUser->user['gender']) ? $this->providerUser->user['gender'] : null;
    }

    /**
     * @param $size
     * @return null|string
     */
    private function getAvatar($size)
    {
        $avatar = null;

        $sizedAvatar = $this->providerUser->getAvatar();
        $avatarArray = explode('?', $sizedAvatar);
        $avatarUrl = $avatarArray[0];

        switch ($this->providerName) {
            case 'GoogleProvider':
                $avatar = $avatarUrl . '?sz=' . $size;
                break;
            case 'FacebookProvider':
                $avatar = $avatarUrl . '?width=' . $size;
                break;
        }

        return $avatar;
    }
}