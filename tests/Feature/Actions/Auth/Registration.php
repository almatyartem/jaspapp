<?php

namespace Tests\Feature\Actions\Auth;

use Tests\Feature\Actions\Action;

class Registration extends Action
{
    protected string $routeName = 'auth.register';
    protected string $httpMethod = 'post';
}
