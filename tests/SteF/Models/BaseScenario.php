<?php

namespace Tests\SteF\Models;

use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\SteF\Contracts\BridgeContract;

class BaseScenario
{
    protected array $headers = [];
    protected array $actions = [];
    protected array $defaultResponseHandlers = [];
    protected $defaultResponseDataExtactor = null;
    protected ?string $lastActionClass = null;

    function __construct(
        readonly BridgeContract $bridge
    ){}

    public function getHeaders() : array
    {
       return $this->headers;
    }

    public function bridge() : BridgeContract
    {
        return $this->bridge;
    }

    public function setResponseHandlers(array $handlers) : self
    {
        $this->defaultResponseHandlers = $handlers;

        return $this;
    }

    public function setDefaultResponseDataExtactor(callable $handler) : self
    {
        $this->defaultResponseDataExtactor = $handler;

        return $this;
    }

    public function setHeader(string $name, string $value) : self
    {
        $this->headers[$name] = $value;

        return $this;
    }

    public function unsetHeader(string $name) : self
    {
        unset($this->headers[$name]);

        return $this;
    }

    public function setAuthToken(string $token) : BaseScenario
    {
        return $this->setHeader('Authorization', 'Bearer '.$token);
    }

    public function getHeader(string $name) : ?string
    {
        return $this->headers[$name] ?? null;
    }

    public function reloadDto(string $dtoClass, array $dtoDefaultParameters = [], bool $isSingleton = false) : self
    {
       //TODO remove
        return $this;
    }

    public function setVariable(string $variableName, $value, $actions) : self
    {
        $this->container->when($actions)
            ->needs('$'.$variableName)
            ->give($value);

        dump($variableName);
        dump($value);
        dump($actions);

        return $this;
    }

    public function action(
        string $item,
        array $requestData = null,
        string $id = null,
        array $responseHandlers = null,
        callable $responseDataExtractor = null
    ) : self
    {
        /**
         * @var BaseAction $action
         */
        $action = new $item($this);

        $action->process(
            $responseDataExtractor ?? $this->defaultResponseDataExtactor,
            $requestData,
            array_merge($this->defaultResponseHandlers ?? [], $responseHandlers ?? []),
            $this->getHeaders()
        );

        $id = $id ?? '#'.(1 + count($this->actions[$item] ?? []));
        $this->actions[$item][$id] = $action;

        $this->lastActionClass = $item;

        return $this;
    }

    public function getResponseDto(string $actionClass = null, string $id = null) : ?BaseResponseDto
    {
        return $this->findAction($actionClass ?? $this->lastActionClass, $id)?->getResponseDto();
    }

    public function getRequesteDto(string $actionClass = null, string $id = null) : ?BaseRequestDto
    {
        return $this->findAction($actionClass ?? $this->lastActionClass, $id)?->getRequestDto();
    }

    protected function findAction(string $actionClass, string $id = null) : ?BaseAction
    {
        $id = $id ?? '#'.count($this->actions[$actionClass] ?? []);

        return $this->actions[$actionClass][$id] ?? null;
    }

    public function perform(callable $callable) : self
    {
        call_user_func($callable, $this);

        return $this;
    }

    public function getDto(string $dtoClass, $parameters) : ?BaseDto
    {
        $object = $this->bridge->make($dtoClass, $parameters ?? []);
        if($parameters){
            $object->fill($parameters);
        }

        return $object;
    }
}
