<?php

namespace App\Exceptions;

use Exception;

class InvalidCredentialsException extends Exception
{
    protected $code = 401;

    public function __construct($email = null)
    {
        $this->message = $email ? "invalid credentials for {$email}" : 'invalid credentials';
        parent::__construct($this->message, $this->code);
    }

    public function render($request)
    {
        return response()->json([
            'error' => $this->message
        ], $this->code);
    }
} 