<?php

namespace App\Http\Controllers;

use App\Services\RoleService;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoleController
{
    protected RoleService $roleService;

    public function __construct()
    {
        if (env('APP_ENV') == 'production')
            abort(Response::HTTP_NOT_FOUND);

        $this->roleService = app(RoleService::class);
    }

    public function getRole(Request $request): JsonResponse
    {
        $perPage = $request->input('perPage', 10);
        $page = $request->input('page', 1);
        $searchTerm = $request->input('query', '');
        $name = $request->input('data');
        $currentRole = null;

        try {
            if ($name) {
                $currentRole = $this->roleService->getRoleByName($name);
            }

            $roles = $this->roleService->getRoleForSelect($perPage, $page, $searchTerm);
            
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => trans('global-message.error_msg'),
            ]);
        }

        return response()->json([
            'status' => 200,
            'data' => $roles,
            'item' => $currentRole,
        ]);
    }
}
