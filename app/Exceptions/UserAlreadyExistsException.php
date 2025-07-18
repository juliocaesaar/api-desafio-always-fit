<?php

namespace App\Exceptions;

use Exception;

class UserAlreadyExistsException extends Exception
{
    protected $code = 409;

    public function __construct($email = null)
    {
        $this->message = $email ? "user with email {$email} already exists" : 'user already exists';
        parent::__construct($this->message, $this->code);
    }

    public function render($request)
    {
        return response()->json([
            'error' => $this->message
        ], $this->code);
    }
} 