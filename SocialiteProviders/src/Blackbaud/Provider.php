<?php

namespace SocialiteProviders\Blackbaud;

use Illuminate\Support\Arr;
//use App\Models\User;
use SocialiteProviders\Manager\OAuth2\AbstractProvider;
use SocialiteProviders\Manager\OAuth2\User;

class Provider extends AbstractProvider
{
    /**
     * Unique Provider Identifier.
     */
    const IDENTIFIER = 'BLACKBAUD';

    /**
     * {@inheritdoc}
     */
    protected $scopes = [''];

    /**
     * {@inheritdoc}
     */
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase('https://oauth2.sky.blackbaud.com/authorization', $state);
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenUrl()
    {
        return 'https://oauth2.sky.blackbaud.com/token';
    }

    /**
     * {@inheritdoc}
     *
     */
    protected function getUserByToken($token)
    {
        $response = $this->getHttpClient()->get('https://api.sky.blackbaud.com/school/v1/academics/courses/', [
            'headers' => [
                'Bb-Api-Subscription-Key' => '',
                'Authorization' => 'Bearer '.$token,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * {@inheritdoc}
     *
     */
    protected function mapUserToObject(array $user)
    {
        return (new User())->setRaw($user)->map([
//          return  User::create([
            'id'    => Arr::get($user, 'user_id'),
//            'id' => $user['user_id'],
            'name' => Arr::get($user, 'family_name'),
            'email' => Arr::get($user, 'email'),
            'token' => Arr::get($user, 'access_token'),
//                ]);
        ]);
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenFields($code)
    {
        return array_merge(parent::getTokenFields($code), [
            'grant_type' => 'authorization_code'
        ]);
    }
}
