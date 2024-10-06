<?php

namespace App\Http\Controllers\Web\Admin\Admin;

use App\Http\Requests\Web\Dashboard\Role\StoreRoleRequest;
use App\Http\Requests\Web\Dashboard\Role\UpdateRolePermissionsRequest;
use App\Http\Requests\Web\Dashboard\Role\UpdateRoleRequest;
use App\Models\Admin;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use App\Traits\ResponseJson;

class RoleController extends Controller
{
    use ResponseJson;

    public Role $rolesModel;

    public function __construct(Role $rolesModel)
    {
        $this->rolesModel = $rolesModel;
        //$this->middleware(['role:owner'])->only('index');
        // $this->middleware(['permission:roles'])->only('index');
    }

    public function index(): \Illuminate\Contracts\View\View
    {
        $roles = $this->rolesModel->all();
        return view('admins.roles.index', compact('roles'));
    }

    public function store(StoreRoleRequest $storeRoleRequest): \Illuminate\Http\JsonResponse
    {
        $this->rolesModel::create($storeRoleRequest->validated());
        return $this->responseJson(['type' => 'success', 'message' => 'Role created successfully'], Response::HTTP_CREATED);
    }

    public function edit(Role $role): \Illuminate\Http\JsonResponse
    {
        $role->load('permissions');
        return $this->responseJson(['data' => $role], Response::HTTP_OK);
    }

    public function update(UpdateRoleRequest $updateRoleRequest, Role $role): \Illuminate\Http\JsonResponse
    {
        $role->update($updateRoleRequest->validated());
        return $this->responseJson(['type' => 'success', 'message' => 'Role updated successfully'], Response::HTTP_OK);
    }

    public function rolePermissions(Role $role): \Illuminate\Http\JsonResponse
    {
        $role->load('permissions');
        $permissions = Permission::all()->filter(function ($permission) use ($role) {
           return $role->hasPermissionTo($permission->name) ? $permission->setAttribute('checked', true) : $permission->setAttribute('checked', false);
        });
        return $this->responseJson(['data' => ['role' => $role, 'permissions' => $permissions]], Response::HTTP_OK);
    }

    public function updateRolePermissions(UpdateRolePermissionsRequest $updateRolePermissionsRequest, Role $role): \Illuminate\Http\JsonResponse
    {
        $role->syncPermissions($updateRolePermissionsRequest->validated()['permissions']);
        return $this->responseJson(['type' => 'success', 'message' => 'Role permissions updated successfully'], Response::HTTP_OK);
    }
}
