<?php

namespace App\Exceptions;

use Exception;

class ProgressLogNotFoundException extends Exception
{
    protected $code = 404;

    public function __construct($id = null)
    {
        $this->message = $id ? "progress log {$id} not found" : 'progress log not found';
        parent::__construct($this->message, $this->code);
    }

    public function render($request)
    {
        return response()->json([
            'error' => $this->message
        ], $this->code);
    }
} 