<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Modules\Admin\Application\Services\OrganizationService;
use App\Modules\Admin\Http\Requests\OrganizationRequest;

class OrganizationController extends Controller
{
    public function __construct(protected OrganizationService $organizationService) {}

    public function index()
    {
        return response()->json($this->organizationService->getAll());
    }

    public function store(OrganizationRequest $request)
    {
        return response()->json(
            $this->organizationService->create($request->validated()),
            201
        );
    }

    public function show(int $id)
    {
        return response()->json($this->organizationService->getById($id));
    }

    public function update(OrganizationRequest $request, int $id)
    {
        return response()->json($this->organizationService->update($id, $request->validated()));
    }

    public function destroy(int $id)
    {
        $this->organizationService->delete($id);
        return response()->json(['message' => 'Deleted successfully']);
    }
}
