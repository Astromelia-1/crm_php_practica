<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Usuario extends Authenticatable
{
    use HasFactory;

    protected $table = 'usuarios';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id', 'nombre', 'email', 'password', 'rol'];

    protected $hidden = ['password', 'remember_token'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid(); 
        });
    }

    public function vacantes(): HasMany
    {
        return $this->hasMany(Vacante::class, 'reclutador_id');
    }

    public function aplicaciones(): HasMany
    {
        return $this->hasMany(Aplicacion::class, 'candidato_id');
    }
}
