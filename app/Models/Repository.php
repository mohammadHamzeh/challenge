<?php

namespace App\Models;

use App\Filter\Contracts\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repository extends Model
{
    use HasFactory, Filterable;

    protected $fillable = [
        "repository_id",
        "repository_name",
        "description",
        "url",
        "language",
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
