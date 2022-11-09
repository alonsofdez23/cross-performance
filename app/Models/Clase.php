<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
    use HasFactory;

    protected $table = 'clases';

    protected $fillable = [
        'monitor_id',
        'fecha_hora',
        'vacantes',
    ];

    /**
     * The atletas that belong to the Clase
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function atletas()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Get the monitor that owns the Clase
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function monitor()
    {
        return $this->belongsTo(User::class);
    }
}
