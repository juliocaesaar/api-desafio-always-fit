<?php

namespace App\Services;

use App\Models\Training;
use Illuminate\Support\Facades\Log;
use App\Exceptions\TrainingNotFoundException;
use App\Exceptions\UnauthorizedAccessException;
use Illuminate\Support\Facades\Auth;

class TrainingService
{
    public function getAll(array $filters = [])
    {
        try {
            $user = Auth::user();
            $query = $user->trainings();

            if (isset($filters['finished'])) {
                $finished = filter_var($filters['finished'], FILTER_VALIDATE_BOOLEAN);
                $query->where('finished', $finished);
            }

            if (isset($filters['category'])) {
                $query->where('category', $filters['category']);
            }

            if (isset($filters['level'])) {
                $query->where('level', $filters['level']);
            }

            return $query->get();
        } catch (\Exception $e) {
            Log::error('Error getting all trainings: ' . $e->getMessage());
            throw new TrainingNotFoundException($e->getMessage());
        }
    }

    public function create(array $data)
    {
        try {
            $user = Auth::user();
            $data['user_id'] = $user->id;
            $training = Training::create($data);
            return $training;
        } catch (\Exception $e) {
            Log::error('Error creating training: ' . $e->getMessage());
            throw new \Exception('Error creating training: ' . $e->getMessage());
        }
    }

    public function getById(string $id)
    {
        try {
            $user = Auth::user();
            $training = $user->trainings()->findOrFail($id);
            return $training;
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('Error getting training by id: ' . $e->getMessage());
            throw new TrainingNotFoundException($id);
        } catch (\Exception $e) {
            Log::error('Error getting training by id: ' . $e->getMessage());
            throw new TrainingNotFoundException($id);
        }
    }

    public function update(string $id, array $data)
    {
        try {
            $user = Auth::user();
            $training = $user->trainings()->findOrFail($id);
            $training->update($data);
            return $training;
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('Error updating training: ' . $e->getMessage());
            throw new TrainingNotFoundException($id);
        } catch (\Exception $e) {
            Log::error('Error updating training: ' . $e->getMessage());
            throw new TrainingNotFoundException($id);
        }
    }

    public function delete(string $id)
    {
        try {
            $user = Auth::user();
            $training = $user->trainings()->findOrFail($id);
            $training->delete();
            return ['message' => 'Training deleted successfully'];
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('Error deleting training: ' . $e->getMessage());
            throw new TrainingNotFoundException($id);
        } catch (\Exception $e) {
            Log::error('Error deleting training: ' . $e->getMessage());
            throw new TrainingNotFoundException($id);
        }
    }
}
