<?php

namespace App\Http\Controllers\Web\Admin\Admin;

use App\Http\Requests\Web\Dashboard\Permission\StorePermissionRequest;
use App\Http\Requests\Web\Dashboard\Permission\UpdatePermissionRequest;
use App\Http\Requests\Web\Dashboard\Permission\UpdatePermissionRolesRequest;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;
use App\Traits\ResponseJson;
use App\Models\Setting ;

class PermissionController extends Controller
{
    use ResponseJson;

    public Permission $permissionModel;

    public function __construct(Permission $permissionModel)
    {
        $this->permissionModel = $permissionModel;
    }

    public function index(): \Illuminate\Contracts\View\View
    {
        $permissions = $this->permissionModel->all();
        return view('admins.permissions.index', compact('permissions' ));
    }

    public function store(StorePermissionRequest $storePermissionRequest): \Illuminate\Http\JsonResponse
    {
        $this->permissionModel::create($storePermissionRequest->validated());
        return $this->responseJson(['type' => 'success', 'message' => 'permission created successfully'], Response::HTTP_CREATED);
    }

    public function edit(Permission $permission): \Illuminate\Http\JsonResponse
    {
        return $this->responseJson(['data' => $permission], Response::HTTP_OK);
    }

    public function update(UpdatePermissionRequest $updatePermissionRequest, Permission $permission): \Illuminate\Http\JsonResponse
    {
        $permission->update($updatePermissionRequest->validated());
        return $this->responseJson(['type' => 'success', 'message' => 'permission updated successfully'], Response::HTTP_OK);
    }

    public function permissionRoles(Permission $permission): \Illuminate\Http\JsonResponse
    {
        $permission->load('roles');
        $roles = Role::all()->filter(function ($role) use ($permission) {
            return $role->hasPermissionTo($permission->name) ? $role->setAttribute('checked', true) : $role->setAttribute('checked', false);
        });
        return $this->responseJson(['data' => ['permission' => $permission, 'roles' => $roles]], Response::HTTP_OK);
    }

    public function updatePermissionRoles(UpdatePermissionRolesRequest $updatePermissionRolesRequest, Permission $permission): \Illuminate\Http\JsonResponse
    {
        $permission->syncRoles($updatePermissionRolesRequest->validated()['roles']);
        return $this->responseJson(['type' => 'success', 'message' => 'Permission roles updated successfully'], Response::HTTP_OK);
    }
}
