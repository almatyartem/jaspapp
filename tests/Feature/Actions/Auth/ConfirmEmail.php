<?php

namespace Tests\Feature\Actions\Auth;

use Tests\Feature\Actions\Action;

class ConfirmEmail extends Action
{
    protected string $routeName = 'auth.confirm_email';
    protected string $httpMethod = 'get';

    public function useSignedRoute(): bool
    {
        return true;
    }
}
