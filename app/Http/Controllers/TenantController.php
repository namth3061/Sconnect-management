<?php

namespace App\Http\Controllers;

use App\Services\TenantService;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TenantController
{
    protected TenantService $tenantService;

    public function __construct()
    {
        if (env('APP_ENV') == 'production')
            abort(Response::HTTP_NOT_FOUND);
        
        $this->tenantService = app(TenantService::class);
    }

    public function getTenant(Request $request): JsonResponse
    {
        $perPage = $request->input('perPage', 10);
        $page = $request->input('page', 1);
        $searchTerm = $request->input('query', '');
        $tenantId = $request->input('data');
        $currentTenant = null;

        try {
            if ($tenantId) {
                $currentTenant = $this->tenantService->getTenantById($tenantId);
            }

            $tenants = $this->tenantService->getTenantForSelect($perPage, $page, $searchTerm);

        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => trans('global-message.error_msg'),
            ]);
        }

        return response()->json([
            'status' => 200,
            'data' => $tenants,
            'item' => $currentTenant,
        ]);
    }
}
