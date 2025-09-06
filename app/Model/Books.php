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
        'author',
        'title',
        'year_publication',
        'price',
        'new_edition',
        'annotation'
    ];

    public function author()
    {
        return $this->belongsTo(Authors::class, 'author');
    }

    public function deliveries()
    {
        return $this->hasMany(BookDeliveries::class, 'id_book');
    }
}