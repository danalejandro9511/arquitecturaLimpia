<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'cif',
        'color',
        'address',
        'population',
        'cp',
        'phone',
        'email',
    ];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
