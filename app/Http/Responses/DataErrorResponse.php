<?php

namespace App\Http\Responses;

class DataErrorResponse
{

    /**
     * @param string $message
     * @param int $line
     * @param string $class
     */
    public function __construct(\Throwable $th, string $className)
    {
        $this->message = $th->getMessage();
        $this->line = $th->getLine();
        $this->class = $className;
    }

    public function getMessage(): string
    {
        return "Mensaje: $this->message ,Class: $this->class ,linea $this->line";
    }
}
