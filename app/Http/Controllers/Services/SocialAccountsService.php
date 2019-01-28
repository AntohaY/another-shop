<?php
namespace App\Http\Controllers\Services;
use App\User;
use App\Models\LinkedSocialAccount;
use Laravel\Socialite\Two\User as ProviderUser;


class SocialAccountsService
{
    public function findOrCreate(ProviderUser $providerUser, string $provider): User
    {

        $linkedSocialAccount = LinkedSocialAccount::where('provider', $provider)
            ->where('provider_id', $providerUser->getId())
            ->first();
        if ($linkedSocialAccount) {
            return $linkedSocialAccount->user;
        } else {
            $user = null;
            if ($email = $providerUser->getEmail()) {
                $user = User::where('email', $email)->first();
            }
            if (! $user) {
                $user = User::create([
                    'name' => $providerUser->getName(),

                    'email' => $providerUser->getEmail(),
                ]);
            }
            $user->linkedSocialAccounts()->create([
                'provider_id' => $providerUser->getId(),
                'provider' => $provider,
            ]);
            return $user;
        }
    }
}
