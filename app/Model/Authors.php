<?php
namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Authors extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'authors';
    protected $fillable = [
        'first_name',
        'last_name',
        'patronym'
    ];
}
