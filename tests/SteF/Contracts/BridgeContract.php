<?php

namespace Tests\SteF\Contracts;

use Illuminate\Testing\TestResponse;
use Tests\SteF\Models\BaseDto;

interface BridgeContract
{
    public function requestToNamedRoute(string $method, $route, array $data = null, array $headers = [], bool $isSigned = false): TestResponse;
    public function getNamedRouteParameters(string $routeName) : ?array;
    public function request(string $method, string $uri, array $data = null, array $headers = []): TestResponse;
    public function make($abstract, array $parameters = []) : BaseDto;
}
