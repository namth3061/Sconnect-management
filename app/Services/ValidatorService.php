<?php

namespace App\Services;

class ValidatorService
{
    protected string $secretKey;
    protected string $ssoUrl;

    public function __construct()
    {
        $this->secretKey = config('app.secret_key_sso');
        $this->ssoUrl = config('app.server_sso_url');
    }

    public function validate(string $token, string $sign): void
    {
        if ($this->isValidSignature($token, $sign)) {
            $_SESSION['token'] = $token;
        }

        $user = $this->getUserFromSessionCookie() ?? $this->getDefaultUser();

        if ($user) {
            setcookie('user', json_encode($user),  time() + config('auth.time_cookie'), "/", config('session.domain'));
        }
    }

    public function getUserFromSessionCookie(): ?array
    {
        if (!isset($_COOKIE['scn_session'])) {
            return null;
        }

        $sessionCookie = $_COOKIE['scn_session'];
        $responseData = $this->callApiWithSession($this->ssoUrl, $sessionCookie);

        if ($responseData && $responseData['code'] === 200) {
            return $responseData['data']['user'] ?? null;
        }

        return null;
    }

    public function getDefaultUser(): array
    {
        return [
            "email" => config('auth.default_email'),
            "username" => config('auth.default_username')
        ];
    }

    public function isValidSignature(string $token, string $sign): bool
    {
        return $token && $sign && hash_equals(hash_hmac('sha256', $token, $this->secretKey), $sign);
    }

    public function callApiWithSession(string $url, string $sessionCookie): mixed
    {
        $ch = curl_init($url);

        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_COOKIE => 'scn_session=' . $sessionCookie,
            CURLOPT_HTTPHEADER => [
                "Origin: " . config('app.client1_url_sso'),
                "Site-Access: " . hash_hmac('sha256', config('app.client1_url_sso'), $this->secretKey),
            ]
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }
}
