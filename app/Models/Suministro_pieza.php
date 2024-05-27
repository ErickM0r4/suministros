<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suministro_pieza extends Model
{
    use HasFactory;
    protected $table = 'suministro_pieza';//Nombre de la tabla  en la BD
    protected $primaryKey = 'idSuministroPieza';//Atriburo de llave primaria
    public $incrementing = true;//id Autoincrementable
    protected $keyType = "int";//tipo de dato de id
    protected $idSuministro;
    protected $idPieza;
    protected $cantidad;
    protected $precio;
    protected $subtotal;
    protected $fillable = ["idSuministro","idPieza","cantidad","precio","subtotal"];
    public $timestamps = false;
}
