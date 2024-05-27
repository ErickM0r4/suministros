<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pieza extends Model
{
    use HasFactory;
    protected $table = 'pieza';//Nombre de la tabla  en la BD
    protected $primaryKey = 'idPieza';//Atriburo de llave primaria
    public $incrementing = true;//id Autoincrementable
    protected $keyType = "int";//tipo de dato de id
    protected $nombre;//nombre del campo Nombre
    protected $color;//nombre del campo color
    protected $precio;
    protected $idCategoria;
    protected $medida;
    protected $stock;
    protected $estado;
    protected $fillable = ["nombre","color","precio","idCategoria","medida","stock","estado"];
    public $timestamps = false;
}
