<?php

namespace App\Http\Controllers\Api;

use App\Trait\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UnitStoreRequest;
use App\Http\Requests\UnitUpdateRequest;
use App\Repositories\Unit\UnitInterface;

class UnitController extends Controller
{
    use ApiResponse;

    private $unitRepository;

    public function __construct(UnitInterface $unitRepository)
    {
        $this->unitRepository = $unitRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function allUnits()
    {
        $data = $this->unitRepository->all();
        $metaData['count'] = count($data);
        if (!$data) {
            return $this->ResponseError([], null, 'No Data Found', 200, 'error');
        } else {
            return $this->ResponseSuccess($data, $metaData);
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perPage = request('perpage');
        $data = $this->unitRepository->allPaginate($perPage);
        $metaData['count'] = count($data);
        if (!$data) {
            return $this->ResponseError([], null, 'No Data Found', 200, 'error');
        } else {
            return $this->ResponseSuccess($data, $metaData);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UnitStoreRequest $request)
    {
        try {
            $data = $this->unitRepository->store($request);
            return $this->ResponseSuccess($data, null, 'Data Stored Successfully', 201);
        } catch (\Exception $e) {
            return $this->ResponseError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->unitRepository->show($id);
        if (!$data) {
            return $this->ResponseError([], null, 'No Data Found', 200, 'error');
        } else {
            return $this->ResponseSuccess($data);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UnitUpdateRequest $request, string $id)
    {
        try {
            $data = $this->unitRepository->update($request, $id);
            return $this->ResponseSuccess($data, null, 'Data Updated Successfully', 204);
        } catch (\Exception $e) {
            return $this->ResponseError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = $this->unitRepository->delete($id);
            return $this->ResponseSuccess($data, null, 'Data Deleted Successfully', 204);
        } catch (\Exception $e) {
            return $this->ResponseError($e->getMessage());
        }
    }

    /**
     * Change status of specified resource from storage.
     */
    public function status(string $id)
    {
        //
    }
}
