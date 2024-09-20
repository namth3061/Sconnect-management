<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Services\AuthService;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;
use App\Enums\StatusCode;
use Illuminate\Http\JsonResponse;
use Mockery;

class AuthServiceTest extends TestCase
{
    protected $authService;
    protected $clientMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->clientMock = Mockery::mock(Client::class);
        $this->authService = new AuthService();
        $this->authService->client = $this->clientMock;
    }

    public function testLoginSuccess()
    {
        $responseBody = ['token' => 'sample_token'];
        $response = new Response(200, [], json_encode($responseBody));

        $this->clientMock
            ->shouldReceive('post')
            ->once()
            ->with('/auth/login', [
                'form_params' => [
                    'username' => 'test@example.com',
                    'password' => 'password',
                ],
            ])
            ->andReturn($response);

        $request = [
            'email' => 'test@example.com',
            'password' => 'password',
        ];

        $result = $this->authService->login($request);

        $this->assertInstanceOf(JsonResponse::class, $result);
        $this->assertEquals(StatusCode::OK, $result->getStatusCode());
        $this->assertEquals($responseBody, $result->getData(true));
    }

    public function testLoginFailure()
    {
        $responseBody = ['error' => 'Unauthorized'];
        $response = new Response(401, [], json_encode($responseBody));
        $request = new Request('POST', '/auth/login');
        $exception = new RequestException('Unauthorized', $request, $response);

        $this->clientMock
            ->shouldReceive('post')
            ->once()
            ->with('/auth/login', [
                'form_params' => [
                    'username' => 'test@example.com',
                    'password' => 'wrong_password',
                ],
            ])
            ->andThrow($exception);

        $request = [
            'email' => 'test@example.com',
            'password' => 'wrong_password',
        ];

        $result = $this->authService->login($request);

        $this->assertInstanceOf(JsonResponse::class, $result);
        $this->assertEquals(StatusCode::UNAUTHORIZED, $result->getStatusCode());
        $this->assertEquals($responseBody, $result->getData(true));
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
