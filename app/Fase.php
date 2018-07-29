<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fase extends Model
{
    //

    public $table='fases';
    protected $primaryKey='id';
    protected $fillable = [
					    	'nombre',
					    	'fecha_inicio',
					    	'fecha_fin',
					    	'cantidad_meses',
					    	'estado'
   						  ];
}
