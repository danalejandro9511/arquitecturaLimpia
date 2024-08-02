<?php

namespace App\Repositories\Companies;

interface ImageRepositoryInterface
{
    public function store($image, $directory): string;
}