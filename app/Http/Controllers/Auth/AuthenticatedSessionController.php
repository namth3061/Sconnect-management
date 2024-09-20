<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use App\Services\AuthenticateService;

class AuthenticatedSessionController extends Controller
{
    protected AuthenticateService $authenticateService;

    public function __construct(AuthenticateService $authenticateService)
    {
        $this->authenticateService = $authenticateService;
    }

    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param \App\Http\Requests\Auth\LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $res = $this->authenticateService->login($request);

        switch ($res->getStatusCode()) {
            case 200:
                $token = json_decode($res->getContent())->token;

                $request->session()->put('accessToken', $token);

                $request->session()->regenerate();
                break;
            case 401:
                throw ValidationException::withMessages([
                    json_decode($res->getContent()),
                ]);
            default:
                throw ValidationException::withMessages([
                    'email' => __('auth.failed'),
                ]);
        }

        return redirect()->route('system.dashboard');
    }

    /**
     * Destroy an authenticated session.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        setcookie('kong_token', '', time(), "/", config('session.domain'));
        setcookie('scn_session', '', time(), "/", config('session.domain'));
        setcookie('user', '', time(), "/", config('session.domain'));

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
