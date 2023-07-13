<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Breed extends Model
{
    use HasFactory;

    protected $table = 'user_breeds';

    protected $fillable = [
        'name',
        'description',
        'age',
        'state',
        'image_id',
        'user_id',
    ];

    protected $hidden = [
        'image_id',
        'user_id',
    ];

    public function image()
    {
        return $this->belongsTo(Image::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
