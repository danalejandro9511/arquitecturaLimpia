<?php

namespace App\Repositories\Companies;

use Illuminate\Support\Facades\Storage;

class EloquentImageRepository implements ImageRepositoryInterface
{
    public function store($image, $directory): string
    {
        return $image->store($directory, 'public');
    }
}