<?php

namespace Harrk\GameJoltApi;

use GuzzleHttp\Client;
use Harrk\GameJoltApi\Callers\AbstractCaller;

class ApiCallService {
    protected $caller;
    protected $client;

    protected $method = 'GET';

    public function __construct(AbstractCaller $caller) {
        $this->caller = $caller;
        $this->client = new Client();
    }

    public function execute() {
        $request = $this->client->request(
            $this->method,
            $this->caller->getFullUrl(true),
            [
                'form_params' => [
                    $this->caller->getParams()
                ]
            ]
        );

        $body = json_decode($request->getBody()->getContents(), true);

        return $body;
    }
}
