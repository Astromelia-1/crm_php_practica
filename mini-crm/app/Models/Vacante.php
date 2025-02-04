<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Vacante extends Model
{
    use HasFactory;

    protected $table = 'vacantes';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id', 'titulo', 'descripcion', 'requisitos', 'reclutador_id'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    public function reclutador(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'reclutador_id');
    }

    public function aplicaciones(): HasMany
    {
        return $this->hasMany(Aplicacion::class);
    }
}