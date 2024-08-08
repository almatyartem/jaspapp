<?php

namespace Tests\SteF\Models;

use Exception;
use Illuminate\Testing\TestResponse;

class RouteBasedAction extends BaseAction
{
    protected string $routeName;
    protected string $httpMethod;
    protected bool $useSignedRoute = false;

    protected function getRouteName(): string
    {
        if(!$this->routeName){
            throw new Exception('Route name not set');
        }

        return $this->routeName;
    }

    protected function getHttpMethod() : string
    {
        if(!$this->httpMethod){
            throw new Exception('Http method not set');
        }

        return $this->httpMethod;
    }

    protected function useSignedRoute() : bool
    {
        return $this->useSignedRoute;
    }

    public function call(array $headers = []) : TestResponse
    {
        $request = $this->requestDto;
        $routeParamsList = $this->bridge()->getNamedRouteParameters($this->getRouteName());
        if($request && $routeParamsList){
            $request->setRouteParamNames($routeParamsList);
        }

        if($this->getHttpMethod() === 'get'){
            $routeParams = array_merge($request?->routeParams() ?? [], $request?->data() ?? []);
            $data = [];
        } else {
            $routeParams = $request?->routeParams();
            $data = $request?->data();
        }
        return $this->bridge()->requestToNamedRoute(
            $this->getHttpMethod(),
            [$this->getRouteName(), $routeParams],
            $data,
            $headers,
            $this->useSignedRoute()
        );
    }
}
