<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;
    protected $table = 'proveedor';//Nombre de la tabla  en la BD
    protected $primaryKey = 'idProveedor';//Atriburo de llave primaria
    public $incrementing = true;//id Autoincrementable
    protected $keyType = "int";//tipo de dato de id
    protected $nombre;//nombre del campo Nombre
    protected $direccion;
    protected $numero;
    protected $ciudad;
    protected $provincia;
    protected $estado;
    protected $fillable = ["nombre","direccion","numero","ciudad","provincia","estado"];
    public $timestamps = false;
}
