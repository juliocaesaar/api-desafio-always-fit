<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Training;
use App\Http\Requests\StoreTrainingRequest;
use App\Http\Requests\UpdateTrainingRequest;
use App\Exceptions\TrainingNotFoundException;
use App\Exceptions\UnauthorizedAccessException;
use Illuminate\Support\Facades\Auth;
use App\Services\TrainingService;

class TrainingController extends Controller
{
    protected $trainingService;

    public function __construct(TrainingService $trainingService)
    {
        $this->trainingService = $trainingService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trainings = $this->trainingService->getAll();
        return response()->json($trainings);
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
    public function store(StoreTrainingRequest $request)
    {
        $data = $request->validated();
        $training = $this->trainingService->create($data);
        return response()->json(['message' => 'Training created successfully', 'training' => $training], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $training = $this->trainingService->getById($id);
        return response()->json(['message' => 'Training found successfully', 'training' => $training], 200);
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
    public function update(UpdateTrainingRequest $request, string $id)
    {
        $training = $this->trainingService->update($id, $request->validated());
        return response()->json(['message' => 'Training updated successfully', 'training' => $training], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = $this->trainingService->delete($id);
        return response()->json($result);
    }
}
