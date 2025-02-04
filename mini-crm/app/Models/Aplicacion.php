<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Aplicacion extends Model
{
    use HasFactory;

    protected $table = 'aplicaciones';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id', 'candidato_id', 'vacante_id', 'cv_url', 'estado'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    public function candidato(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'candidato_id');
    }

    public function vacante(): BelongsTo
    {
        return $this->belongsTo(Vacante::class, 'vacante_id');
    }
}