<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\ValidatorService;
use App\Services\AuthService;

class VerifyAuthToken
{
    protected $authService;
    protected $validatorService;

    public function __construct(AuthService $authService, ValidatorService $validatorService)
    {
        $this->authService = $authService;
        $this->validatorService = $validatorService;
    }

    public function handle(Request $request, Closure $next)
    {
        if (@$_COOKIE['user'] && @$_COOKIE['kong_token'] && @$_COOKIE['scn_session']) {
            return $next($request);
        } else if (@$_COOKIE['user']) {
            return $this->handleHasCookieUser(@$_COOKIE['user']);
        } else if ($request->query('token') && $request->query('sign')) {
            return $this->handleHasTokenAndSign($request);
        } else {
            return $this->handleNotCookie();
        }
    }

    private function handleHasCookieUser(string $cookieUser): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $user = json_decode($cookieUser);
        $this->callApiLoginKong($user->email);

        return redirect(route('uisheet'));
    }

    private function handleHasTokenAndSign(Request $request): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $this->callApWithSession($request->query('token'), $request->query('sign'));

        return redirect(route('uisheet'));
    }

    private function handleNotCookie(): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        return redirect()->away(config('app.sc_url'));
    }

    private function callApiLoginKong(string $email): void
    {
        $request = [
            'email' => $email,
            'password' => config('auth.default_password'),
        ];

        try {
            $kongUser = $this->authService->login($request);

            if ($kongUser) {
                $data = $kongUser->getData(true);
                $token = $data['token']['value']['token'];
                setcookie('kong_token', $token, time() + config('auth.time_cookie'), "/", config('session.domain'));
            }
        } catch (\Exception $e) {
            Log::error(__('auth.login_kong_failed') . $e->getMessage());
        }
    }

    private function callApWithSession(string $token, string $sign): void
    {
        $dataToken = compact('token', 'sign');
        setcookie('scn_session', json_encode($dataToken), time() + config('auth.time_cookie'), "/", config('session.domain'));
        
        try {
            $this->validatorService->validate($token, $sign);
        } catch (\Exception $e) {
            Log::error(__('auth.token_validate_failed') . $e->getMessage());
        }
    }
}
