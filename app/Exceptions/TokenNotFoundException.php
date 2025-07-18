<?php

namespace App\Exceptions;

use Exception;

class TokenNotFoundException extends Exception
{
    protected $code = 401;

    public function __construct($token = null)
    {
        $this->message = $token ? "token {$token} not found" : 'token not found';
        parent::__construct($this->message, $this->code);
    }

    public function render($request)
    {
        return response()->json([
            'error' => $this->message
        ], $this->code);
    }
} 