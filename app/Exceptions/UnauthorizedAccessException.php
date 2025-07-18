<?php

namespace App\Exceptions;

use Exception;

class UnauthorizedAccessException extends Exception
{
    protected $code = 403;

    public function __construct($resource = null)
    {
        $this->message = $resource ? "unauthorized access to {$resource}" : 'unauthorized access';
        parent::__construct($this->message, $this->code);
    }

    public function render($request)
    {
        return response()->json([
            'error' => $this->message
        ], $this->code);
    }
} 