<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Exceptions\InvalidCredentialsException;
use App\Exceptions\UserAlreadyExistsException;
use App\Exceptions\TokenNotFoundException;

class AuthService
{
    public function register(array $data)
    {
        try {
            $existingUser = User::where('email', $data['email'])->first();
            if ($existingUser) {
                throw new UserAlreadyExistsException($data['email']);
            }

            $data['password'] = Hash::make($data['password']);
            $user = User::create($data);
            $token = $user->createToken('auth_token')->plainTextToken;
            
            return [
                'message' => 'User registered successfully',
                'user' => $user,
                'token' => $token,
            ];
        } catch (UserAlreadyExistsException $e) {
            Log::error('Error registering user: ' . $e->getMessage());
            throw $e;
        } catch (\Exception $e) {
            Log::error('Error registering user: ' . $e->getMessage());
            throw new \Exception('Error registering user: ' . $e->getMessage());
        }
    }

    public function login(array $data)
    {
        try {
            $user = User::where('email', $data['email'])->first();
            if (!$user || !Hash::check($data['password'], $user->password)) {
                throw new InvalidCredentialsException($data['email']);
            }
            
            $token = $user->createToken('auth_token')->plainTextToken;
            $refreshToken = $user->createToken('refresh_token')->plainTextToken;
            
            return [
                'message' => 'Login successful',
                'user' => $user,
                'token' => $token,
                'refresh_token' => $refreshToken,
            ];
        } catch (InvalidCredentialsException $e) {
            Log::error('Error logging in user: ' . $e->getMessage());
            throw $e;
        } catch (\Exception $e) {
            Log::error('Error logging in user: ' . $e->getMessage());
            throw new \Exception('Error logging in: ' . $e->getMessage());
        }
    }

    public function logout(Request $request)
    {
        try {
            $user = $request->user();
            if (!$user) {
                throw new TokenNotFoundException();
            }
            
            $user->currentAccessToken()->delete();
            return ['message' => 'Logout successful'];
        } catch (TokenNotFoundException $e) {
            Log::error('Error logging out user: ' . $e->getMessage());
            throw $e;
        } catch (\Exception $e) {
            Log::error('Error logging out user: ' . $e->getMessage());
            throw new \Exception('Error logging out: ' . $e->getMessage());
        }
    }

    public function refreshToken(Request $request)
    {
        try {
            $user = $request->user();
            if (!$user) {
                throw new TokenNotFoundException();
            }
            
            $user->currentAccessToken()->delete();
            $token = $user->createToken('auth_token')->plainTextToken;
            $refreshToken = $user->createToken('refresh_token')->plainTextToken;
            
            return [
                'message' => 'Token refreshed successfully',
                'token' => $token,
                'refresh_token' => $refreshToken,
            ];
        } catch (TokenNotFoundException $e) {
            Log::error('Error refreshing token: ' . $e->getMessage());
            throw $e;
        } catch (\Exception $e) {
            Log::error('Error refreshing token: ' . $e->getMessage());
            throw new \Exception('Error refreshing token: ' . $e->getMessage());
        }
    }
}
