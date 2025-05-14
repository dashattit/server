<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'books';
    protected $fillable = [
        'id',
        'author',
        'title',
        'year_publication',
        'price',
        'new_edition',
        'annotation'
    ];
}