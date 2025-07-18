<?php

namespace App\Exceptions;

use Exception;

class TrainingNotFoundException extends Exception
{
    protected $code = 404;

    public function __construct($id = null)
    {
        $this->message = $id ? "training {$id} not found" : 'training not found';
        parent::__construct($this->message, $this->code);
    }

    public function render($request)
    {
        return response()->json([
            'error' => $this->message
        ], $this->code);
    }
} 