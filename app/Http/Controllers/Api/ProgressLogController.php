<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProgressLog;
use App\Http\Requests\StoreProgressLogRequest;
use App\Http\Requests\UpdateProgressLogRequest;
use App\Services\ProgressLogService;

class ProgressLogController extends Controller
{
    protected $progressLogService;

    public function __construct(ProgressLogService $progressLogService)
    {
        $this->progressLogService = $progressLogService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $progressLogs = $this->progressLogService->getAll();
        return response()->json($progressLogs);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProgressLogRequest $request)
    {
        $data = $request->validated();
        $progressLog = $this->progressLogService->create($data);
        return response()->json(['message' => 'Progress log created successfully', 'progress_log' => $progressLog], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $progressLog = $this->progressLogService->getById($id);
        return response()->json(['message' => 'Progress log found successfully', 'progress_log' => $progressLog], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProgressLogRequest $request, string $id)
    {
        $progressLog = $this->progressLogService->update($id, $request->validated());
        return response()->json(['message' => 'Progress log updated successfully', 'progress_log' => $progressLog], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = $this->progressLogService->delete($id);
        return response()->json($result);
    }
}
