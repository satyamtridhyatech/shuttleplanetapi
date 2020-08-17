<?php

namespace App;

use Laravel\Socialite\Contracts\Provider;
use App\Customers;

class SocialAccountService
{
    public function createOrGetUser($provider)
    {           
        $providerUser = $provider->user();
        $providerName = class_basename($provider);

        $account = SocialAccount::whereProvider($providerName)
            ->whereProviderUserId($providerUser->getId())
            ->first();


        if ($account) {
            return $account->user;
        } else {

            $account = new SocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => $providerName
            ]);

            $user = User::whereEmail($providerUser->getEmail())->first();

            if (!$user) {

                $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'username' => substr($providerUser->getEmail(), 0, strpos($providerUser->getEmail(), '@')),
                ]);

                $data=['user_id'=>$user->id,'email'=> $providerUser->getEmail()];
                $customer=new Customers($data);
                $customer->save();

            }

            $account->user()->associate($user);
            $account->save();

            return $user;

        }

    }
}