<?php

namespace Tests\SteF;

use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Testing\TestResponse;
use Tests\SteF\Contracts\BridgeContract;
use Tests\SteF\Models\BaseDto;
use Tests\SteF\Models\BaseScenario;
use Tests\TestCase;

readonly class Bridge implements BridgeContract
{
    function __construct(
        public TestCase $testCase,
        public Application $app
    ){}

    public function make($abstract, array $parameters = []) : BaseDto
    {
        return $this->app->make($abstract, $parameters);
    }

    public function getNamedRouteParameters(string $routeName) : ?array
    {
        foreach(Route::getRoutes()->getRoutes() as $route){
            /**
             * @var \Symfony\Component\Routing\Attribute\Route $route
             */
            if($route->getName() === $routeName){
                return $route->parameterNames();
            }
        }

        return null;
    }

    public function requestToNamedRoute(string $method, $route, array $data = null, array $headers = [], bool $isSigned = false): TestResponse
    {
        if(is_string($route)){
            $route = [$route];
        }
        if($isSigned){
            $uri = $this->urlHelper()->signedRoute($route[0], $this->resolveParams($route[1] ?? []));
        } else {
            $uri = $this->urlHelper()->route($route[0], $this->resolveParams($route[1] ?? []));
        }

        return $this->request($method, $uri, $data, $headers);
    }

    public function request(string $method, string $uri, array $data = null, array $headers = []): TestResponse
    {
        if(in_array($method, ['post', 'patch', 'put', 'delete'])) {
            $response = $this->testCase->$method($uri, $this->resolveParams($data ?? []), $headers);
        } elseif($method == 'get') {
            $response = $this->testCase->get($uri, $headers);
        } else {
            throw new \Exception('Extend RequestAdapter to support method ' . $method);
        }

        return $response;
    }

    protected function urlHelper() : UrlGenerator
    {
        return $this->app->make(UrlGenerator::class);
    }

    protected function resolveParams(array $params): array
    {
        return (isset($params[0]) && is_object($params[0])) ? $this->extractData($params[0], $params[1] ?? null) : $params;
    }

    protected function extractData(BaseDto $object, array $params = null) : array
    {
        $result = [];
        if($params){
            foreach ($params as $k => $param) {
                $result[is_int($k) ? $param : $k] = $object->$param;
            }
        } else {
            $result = $object->toArray();
        }

        return $result;
    }
}
