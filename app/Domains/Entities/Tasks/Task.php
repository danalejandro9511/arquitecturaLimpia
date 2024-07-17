<?php

namespace App\Domains\Entities\Tasks;

class Task
{
    public $id;
    public $title;
    public $description;
    public $completed;

    public function __construct($id, $title, $description, $completed)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->completed = $completed;
    }
}
