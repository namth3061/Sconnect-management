<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use App\Enums\StatusCode;
use Illuminate\Http\JsonResponse;

class AuthService
{
    public Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => config('app.auth_service'),
        ]);
    }

    public function login(array $request): JsonResponse
    {
        $formParams = [
            'username' => $request['email'],
            'password' => $request['password'],
        ];

        try {
            $response = $this->client->post('/auth/login', [
                'form_params' => $formParams,
            ]);

            $responseBody = json_decode($response->getBody()->getContents(), true);

            return response()->json($responseBody, StatusCode::OK);
        } catch (RequestException $e) {
            return $this->handleRequestException($e);
        }
    }

    protected function handleRequestException(RequestException $e): JsonResponse
    {
        if ($e->hasResponse()) {
            $responseBody = json_decode($e->getResponse()->getBody()->getContents(), true);

            return response()->json($responseBody, StatusCode::UNAUTHORIZED);
        }

        return response()->json(['error' => __('auth.failed')], StatusCode::SERVERERROR);
    }
}
