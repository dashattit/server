<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Readers extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'readers';
    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'patronym',
        'address',
        'telephone'
    ];
}
