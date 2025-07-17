<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProgressLog;
use App\Http\Requests\StoreProgressLogRequest;
use App\Http\Requests\UpdateProgressLogRequest;

class ProgressLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $progressLogs = ProgressLog::all();
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
        $progressLog = ProgressLog::create($data);
        return response()->json($progressLog, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $progressLog = ProgressLog::findOrFail($id);
        return response()->json($progressLog);
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
        $progressLog = ProgressLog::findOrFail($id);
        $progressLog->update($request->validated());
        return response()->json($progressLog);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
