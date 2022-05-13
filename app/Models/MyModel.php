<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyModel extends Model
{
    use HasFactory;

    protected $table = 'my_models';

    protected $fillable = [
        'name',
        'image',
        'price',
        'username'
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'models_tags');
    }
}
