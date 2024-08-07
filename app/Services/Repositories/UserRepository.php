<?php

namespace App\Services\Repositories;

use App\Models\Base\BaseModel;
use App\Models\Interfaces\TunedModel;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;


readonly class UserRepository extends BaseRepository
{
    public function create(string $name, string $email, string $password = null): User
    {
        $user = new User();
        $user->name = $name;
        $user->email = $email;
        if($password){
            $user->password = Hash::make($password);
        }
        $user->save();

        return $user;
    }

    public function update(User $user, string $name) : User
    {
        $user->name = $name;
        $user->save();

        return $user;
    }

    public function patchPassword(User $user, string $password) : bool
    {
        $user->password = Hash::make($password);

        return $user->save();
    }

    protected function getModel(): TunedModel
    {
        return new User();
    }
}
