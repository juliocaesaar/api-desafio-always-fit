<?php

namespace App\Services;

use App\Models\ProgressLog;
use Illuminate\Support\Facades\Log;
use App\Exceptions\ProgressLogNotFoundException;
use App\Exceptions\UnauthorizedAccessException;
use Illuminate\Support\Facades\Auth;

class ProgressLogService
{
    public function getAll()
    {
        try {
            $user = Auth::user();
            return $user->progressLogs;
        } catch (\Exception $e) {
            Log::error('Error getting all progress logs: ' . $e->getMessage());
            throw new ProgressLogNotFoundException();
        }
    }

    public function create(array $data)
    {
        try {
            $user = Auth::user();
            $data['user_id'] = $user->id;
            $progressLog = ProgressLog::create($data);
            return $progressLog;
        } catch (\Exception $e) {
            Log::error('Error creating progress log: ' . $e->getMessage());
            throw new \Exception('Error creating progress log: ' . $e->getMessage());
        }
    }

    public function getById(string $id)
    {
        try {
            $user = Auth::user();
            $progressLog = $user->progressLogs()->findOrFail($id);
            return $progressLog;
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('Error getting progress log by id: ' . $e->getMessage());
            throw new ProgressLogNotFoundException($id);
        } catch (\Exception $e) {
            Log::error('Error getting progress log by id: ' . $e->getMessage());
            throw new ProgressLogNotFoundException($id);
        }
    }

    public function update(string $id, array $data)
    {
        try {
            $user = Auth::user();
            $progressLog = $user->progressLogs()->findOrFail($id);
            $progressLog->update($data);
            return $progressLog;
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('Error updating progress log: ' . $e->getMessage());
            throw new ProgressLogNotFoundException($id);
        } catch (\Exception $e) {
            Log::error('Error updating progress log: ' . $e->getMessage());
            throw new ProgressLogNotFoundException($id);
        }
    }

    public function delete(string $id)
    {
        try {
            $user = Auth::user();
            $progressLog = $user->progressLogs()->findOrFail($id);
            $progressLog->delete();
            return ['message' => 'Progress log deleted successfully'];
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('Error deleting progress log: ' . $e->getMessage());
            throw new ProgressLogNotFoundException($id);
        } catch (\Exception $e) {
            Log::error('Error deleting progress log: ' . $e->getMessage());
            throw new ProgressLogNotFoundException($id);
        }
    }
} 