<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use App\Enums\StatusCode;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AuthenticateService
{
    public function login($request)
    {
        $client = new Client([
            'base_uri' => config('app.kong_url'),
        ]);

        $body = [
            'form_params' => [
                'identifier' => $request->email,
                'password' => $request->password,
            ],
        ];

        try {
            $res = $client->request('POST', '/login', $body);

            return response()->json(json_decode($res->getBody()->getContents()), StatusCode::OK);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $response = $e->getResponse();

                return response()->json(json_decode($response->getBody()->getContents()), StatusCode::UNAUTHORIZED);
            }

            return response()->json(['error' => __('auth.failed')], StatusCode::SERVERERROR);
        }
    }

    public function getUsers()
    {
        $token = getAccessToken();

        $client = new Client([
            'base_uri' => config('app.kong_url'),
            'headers' => [
                'Authorization' => "Bearer {$token}"
            ]
        ]);

        $res = $client->request('GET', '/api/users/list');

        return json_decode($res->getBody()->getContents(), true);
    }
}
