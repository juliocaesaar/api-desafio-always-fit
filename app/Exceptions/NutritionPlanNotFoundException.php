<?php

namespace App\Exceptions;

use Exception;

class NutritionPlanNotFoundException extends Exception
{
    protected $code = 404;

    public function __construct($id = null)
    {
        $this->message = $id ? "nutrition plan {$id} not found" : 'nutrition plan not found';
        parent::__construct($this->message, $this->code);
    }

    public function render($request)
    {
        return response()->json([
            'error' => $this->message
        ], $this->code);
    }
} 