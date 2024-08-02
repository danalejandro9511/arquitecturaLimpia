<?php

namespace App\Domains\Entities\Companies;

class Company
{
    public $id;
    public $name;
    public $cif;
    public $color;
    public $address;
    public $population;
    public $cp;
    public $phone;
    public $email;
    public $logoPath; 

    public function __construct($id, $name, $cif, $color, $address, $population, $cp, $phone, $email, $logoPath = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->cif = $cif;
        $this->color = $color;
        $this->address = $address;
        $this->population = $population;
        $this->cp = $cp;
        $this->phone = $phone;
        $this->email = $email;
        $this->logoPath = $logoPath;
    }
}