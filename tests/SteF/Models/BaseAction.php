<?php

namespace Tests\SteF\Models;

use Illuminate\Http\Response;
use Illuminate\Testing\TestResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Tests\SteF\Contracts\BridgeContract;

abstract class BaseAction
{
    protected ?BaseRequestDto $requestDto = null;
    protected ?BaseResponseDto $responseDto = null;
    protected ?string $requestEntity = null;
    protected ?string $responseEntity = null;

    public function __construct(
        readonly protected BaseScenario $scenario
    ) {}

    public function process(
        callable $responseDataExtractor,
        array $requestData = null,
        array $responseHandlers = [],
        array $headers = []
    ): self
    {
        $this->requestDto = $this->getRequestObject(
            $this->getRequestEntityClass(),
            $requestData
        );

        $response = $this->call($headers);
        if ($response->baseResponse instanceof StreamedResponse) {
            ob_start();
            $response->sendContent();
            $content = ob_get_clean();
            $response = new TestResponse(
                new Response(
                    $content,
                    $response->baseResponse->getStatusCode(),
                    $response->baseResponse->headers->all()
                )
            );
        }

        $data = call_user_func($responseDataExtractor, $response);
        $this->responseDto = $this->getResponseObject(
            $this->getResponseEntityClass(),
            $data
        );

        foreach($responseHandlers as $responseHandler){
            call_user_func($responseHandler, $response, $this, $this->scenario);
        }

        return $this;
    }

    protected function getResponseEntityClass() : string
    {
        return $this->responseEntity ?? BaseResponseDto::class;
    }

    protected function getRequestEntityClass() : string
    {
        return $this->requestEntity ?? BaseRequestDto::class;
    }

    protected abstract function call(array $headers = []) : TestResponse;

    protected function bridge() : BridgeContract
    {
        return $this->scenario->bridge();
    }

    public function getResponseDto() : ?BaseResponseDto
    {
        return $this->responseDto;
    }

    public function getRequestDto() : ?BaseRequestDto
    {
        return $this->requestDto;
    }

    public function getRequestObject(string $dtoClass, array $parameters = null) : ?BaseRequestDto
    {
        return $this->scenario->getDto($dtoClass, $parameters);
    }

    public function getResponseObject(string $dtoClass, array $parameters = null) : ?BaseResponseDto
    {
        return $this->scenario->getDto($dtoClass, $parameters);
    }
}
