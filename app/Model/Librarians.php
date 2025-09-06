<?php
namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Src\Auth\IdentityInterface;

class Librarians extends Model implements IdentityInterface
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'librarians';
    protected $fillable = [
        'first_name',
        'last_name',
        'patronym',
        'login',
        'password',
        'role_id'
    ];

    protected $hidden = [
        'password'
    ];

    protected static function booted()
    {
        static::created(function ($user) {
            $user->password = md5($user->password);
            $user->save();
        });
    }

    public function findIdentity(int $id)
    {
        return self::where('id', $id)->first();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function attemptIdentity(array $credentials)
    {
        return self::where([
            'login' => $credentials['login'],
            'password' => md5($credentials['password'])
        ])->first();
    }

    public function role()
    {
        return $this->belongsTo(LibrarianRoles::class, 'role_id');
    }

    public function deliveries()
    {
        return $this->hasMany(BookDeliveries::class, 'id_library');
    }

    /**
     * Проверка роли по названию
     */
    public function hasRole($roleName): bool
    {
        return $this->role && $this->role->role_name === $roleName;
    }

    /**
     * Проверка на администратора
     */
    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    /**
     * Проверка на библиотекаря
     */
    public function isLibrarian(): bool
    {
        return $this->hasRole('librarian') || $this->isAdmin();
    }

    /**
     * Полное имя
     */
    public function getFullNameAttribute(): string
    {
        return trim("{$this->last_name} {$this->first_name} {$this->patronym}");
    }
}