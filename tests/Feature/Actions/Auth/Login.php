<?php

namespace Tests\Feature\Actions\Auth;

use Tests\Feature\Actions\Action;

class Login extends Action
{
    protected string $routeName = 'auth.login';
    protected string $httpMethod = 'post';
}
