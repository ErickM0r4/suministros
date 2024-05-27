<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    protected $table = 'categoria';//Nombre de la tabla  en la BD
    protected $primaryKey = 'idCategoria';//Atriburo de llave primaria
    public $incrementing = true;//id Autoincrementable
    protected $keyType = "int";//tipo de dato de id
    protected $nombre;//nombre del campo Nombre
    protected $estado;//nombre del campo Estado
    protected $fillable = ["nombre","estado"];
    public $timestamps = false;
}
