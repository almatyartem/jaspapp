<?php

namespace App\Services;

use App\Models\Space;
use App\Models\User;
use App\Services\Repositories\SpacesRepository;
use App\Services\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Laravel\Sanctum\NewAccessToken;
use Laravel\Socialite\Contracts\User as SocialiteUser;

readonly class AuthService
{
    public function __construct(
        protected readonly UserRepository $userRepository,
        protected readonly SpacesRepository $spacesRepository,
    ) {
    }

    public function createAccessToken(User $user): NewAccessToken
    {
        return $user->createToken('auth-token');
    }

    public function login(string $email, string $password) : ?User
    {
        $user = $this->findUserByEmail($email);

        if (!$user || !Hash::check($password, $user->password)) {
            return null;
        }

        return $user->withAccessToken($this->createAccessToken($user));
    }

    public function register(string $name, string $email, string $password = null) : ?User
    {
        if($this->findUserByEmail($email)){
            return null;
        }

        $user = $this->userRepository->create($name, $email, $password);

        return $user->withAccessToken($this->createAccessToken($user));
    }

    public function addUserToSpace(User $user, Space $space, bool $isOwner = false) : bool
    {
        $space->users()->attach($user->id, ['is_owner' => $isOwner]);

        return true;
    }


    public function googleAuth(SocialiteUser $socialiteUser) : ?User
    {
        $user = $this->findUserByEmail($socialiteUser->getEmail());

        if ($user) {
            return $user;
        }

        return $this->register($socialiteUser->getName(), $socialiteUser->getEmail());
    }

    public function setPassword(User $user, string $password): bool
    {
        return $this->userRepository->patchPassword($user, $password);
    }

    public function resetPassword(string $email, string $token, string $password): bool
    {
        $user = $this->findUserByEmail($email);

        if ($user && Password::broker()->tokenExists($user, $token)) {
            if ($this->setPassword($user, $password)) {
                Password::broker()->deleteToken($user);

                return true;
            }
        }

        return false;
    }

    public function logout(User $user): bool
    {
        $user->currentAccessToken()?->delete();

        return true;
    }

    protected function findUserByEmail(string $email) : ?User
    {
        return User::query()->where('email', $email)->first();
    }
}
