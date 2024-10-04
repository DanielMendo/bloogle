<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser; 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Panel; 

class User extends Authenticatable implements FilamentUser 
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'facebook',
        'twitter',
        'instagram',
        'password',
        'profile_picture',
        'bio',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Método para verificar el acceso al panel de administración.
     */
    public function canAccessPanel(Panel $panel): bool
    {
        // Permite el acceso solo a usuarios con correos que terminen con @admin.com
        return str_ends_with($this->email, '@admin.com');
    }
}
