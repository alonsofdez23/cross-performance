<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Chat extends Model
{
    use HasFactory;

    protected $table = 'chats';

    protected $fillable = [
        'nombre',
        'imagen_url',
        'es_grupo',
    ];

    // Mutadores
    public function nombre(): Attribute
    {
        return new Attribute(
            get: function($value) {
                if ($this->es_grupo) {
                    return $value;
                }

                // Usuario con quien estoy conversando
                $user = $this->users->where('id', '!=', Auth::id())->first();

                return $user->name;
            }
        );
    }

    public function imagen(): Attribute
    {
        return new Attribute(
            get: function(){
                if ($this->es_grupo) {
                    return Storage::url($this->imagen_url);
                }

                $user = $this->users->where('id', '!=', Auth::id())->first();

                return $user->profile_photo_url;
            }
        );
    }

    public function ultimoMensaje(): Attribute
    {
        return new Attribute(
            get: function(){
                return $this->mensajes->last()->created_at;
            }
        );
    }

    public function mensajesNoLeidos(): Attribute
    {
        return new Attribute(
            get: function(){
                return $this->mensajes()->where('user_id', '!=', Auth::id())->where('leido', false)->count();
            }
        );
    }

    /**
     * Get all of the mensajes for the Chat
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mensajes()
    {
        return $this->hasMany(Mensaje::class);
    }

    /**
     * The users that belong to the Chat
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
