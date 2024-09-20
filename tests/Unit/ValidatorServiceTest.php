<?php

namespace Tests\Unit;

use App\Services\ValidatorService;
use Tests\TestCase;

class ValidatorServiceTest extends TestCase
{
    protected ValidatorService $validatorService;

    protected function setUp(): void
    {
        parent::setUp();
        config()->set('app.secret_key_sso', 'test_secret_key');
        config()->set('app.server_sso_url', 'https://test-server-sso-url.com');
        
        $this->validatorService = app(ValidatorService::class);
    }

    public function test_validate_invalidSignature_doesNotSetSessionOrCookie()
    {
        $this->validatorService->validate('token_sso', 'sign_sso');
        $this->assertArrayNotHasKey('user', $_COOKIE);
    }

    public function test_getUserFromSessionCookie_noCookie(): void 
    {
        $_COOKIE = [];
        $result = $this->validatorService->getUserFromSessionCookie();

        $this->assertNull($result);
    }

    public function test_getUserFromSessionCookie_withInvalidResponse(): void 
    {
        $_COOKIE['scn_session'] = 'scn_session_cookie';
        $result = $this->validatorService->getUserFromSessionCookie();

        $this->assertNull($result);
    }

    public function test_is_valid_signature(): void 
    {
        $token = 'token_sso';
        $sign = 'sign_sso';

        $this->assertFalse($this->validatorService->isValidSignature($token, $sign));
    }

    public function test_get_default_user(): void 
    {
        $result =  [
            "email" => config('auth.default_email'),
            "username" => config('auth.default_username')
        ];
        $user = $this->validatorService->getDefaultUser();

        $this->assertEquals($user['email'], $result['email']);
        $this->assertEquals($user['username'], $result['username']);
    }
}
