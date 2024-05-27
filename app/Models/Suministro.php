<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suministro extends Model
{
    use HasFactory;
    protected $table = 'suministro';//Nombre de la tabla  en la BD
    protected $primaryKey = 'idSuministro';//Atriburo de llave primaria
    public $incrementing = true;//id Autoincrementable
    protected $keyType = "int";//tipo de dato de id
    protected $idProveedor;
    protected $fecha;
    protected $monto;
    protected $estado;
    protected $fillable = ["idProveedor","fecha","monto","estado"];
    public $timestamps = false;
}
