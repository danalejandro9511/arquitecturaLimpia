<?php

namespace App\Domains\Entities\TaxRates;

class TaxRate
{
    public $id;
    public $name;
    public $percentage;

    public function __construct($id, $name, $percentage)
    {
        $this->id = $id;
        $this->name = $name;
        $this->percentage = $percentage;
    }
}