<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Contacto extends Model{

    use HasFactory;

 protected $fillable=['usuario_id','nombre','apellido','foto','email','telefono'];

 public function usuario(){
    return $this->belongsTo('usuarios');
 }


 protected $table='contactos';
}
