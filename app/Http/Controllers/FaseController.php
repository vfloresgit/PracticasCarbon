<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Fase;
use App\MesAsignado;
class FaseController extends Controller
{
    //

   public function asignar(Request $request){

        try{

            $fechaInicio 		 			= $request->input('fecha_inicio_eval');
            $fechaInicio_alterno 			= $request->input('fecha_inicio_eval');
            $fechaInicio_alterno_original 	= $request->input('fecha_inicio_eval');

            $fechaFin = $request->input('fecha_fin_eval');      

		   if($fechaFin!=null){		           

			        $fechaInicio = Carbon::parse($fechaInicio);

			        $fechaInicio_alterno 			= Carbon::parse($fechaInicio_alterno);
			        $fechaInicio_alterno_aumentado  = $fechaInicio_alterno->addMonth(1)->startOfMonth();
                    
				    $fechaFinEval = Carbon::parse($fechaFin);
			   	    $fechaInicioDia = $fechaInicio->day;			   	    
			    
				    if($fechaInicioDia > 14){

                            $mesInicialMasUno = $fechaInicio->addMonth(0);
                           
                            $this->fechaInicialOk = $mesInicialMasUno;

                    	    $MesesDiferencia = $fechaFinEval->diffInMonths($mesInicialMasUno)+1;	
                    	    $mesesTotal  =  $MesesDiferencia-1;

                     	    $fase= Fase::create([
                    	   		'nombre'=>'',
                    			'fecha_inicio' => $fechaInicio_alterno_aumentado,					
                    	  		'fecha_fin' => $fechaFinEval,
                    	  		'cantidad_meses'=>$mesesTotal,
                    	  		'estado'=>1
                    	    ]);     
                    	  	   	 
		                    for ($i=1; $i <$MesesDiferencia ; $i++) { 						   
						   	// MESES DE EVALUACION ESPECIFICAS // 04 05 06
						   		 $fechaGenerada=  $mesInicialMasUno->addMonth(1)->startOfMonth();	
						   	 	 $mesGenerado = $mesInicialMasUno->month;

						   	 	 $mesFormato =  $this->formatoMes($mesGenerado);
						   	 	 $anioFormato = $mesInicialMasUno->year;
						   	 	 
						   	 	 $anio=Anio::select('id')->where('nombre','=',$anioFormato)->first();
                           
						 	     $mesAsignado= MesAsignado::create([
							   		'startup_id'=>'7',
									'estado' => 1,
							  		'fase_id' => $fase->id,
							  		'anio_id'=>$anio->id,
							  		'mes_id'=>$mesFormato
							    ]);    
						  					   
						   }

				    }elseif($fechaInicioDia <= 14){	

						   $mesInicialMasUno=$fechaInicio->subMonth(1);
                    	   $MesesDiferencia = $fechaFinEval->diffInMonths($mesInicialMasUno)+1;		
                    	   $mesesTotal  =  $MesesDiferencia-1;	
                    	 
                    	    $fase = new Fase();
                    	    $fase->nombre = '';
                    	    $fase->fecha_inicio =  $fechaInicio_alterno_original;
                    	    $fase->fecha_fin= $fechaFinEval;
                    	    $fase->cantidad_meses = $mesesTotal;
                    	    $fase->estado = 1;
                    	    $fase->save();                    	    
		                   
						   for ($i=1; $i <$MesesDiferencia ; $i++) { 
						   	// 03040506
						   		 $fechaGenerada =  $mesInicialMasUno->addMonth(1)->startOfMonth();	
						   		 $mesGenerado = $mesInicialMasUno->month;
						   		 // "<br>";
						   		 $mesFormato = $this->formatoMes($mesGenerado);	
						   		 $anioFormato = $mesInicialMasUno->year;
						   		 $anio=Anio::select('id')->where('nombre','=',$anioFormato)->first();

						   		  	    $mesAsignado= MesAsignado::create([
						   		 	   		'startup_id'=>'7',
						   		 			'estado' => 1,
						   		 	  		'fase_id' => $fase->id,
						   		 	  		'anio_id'=>$anio->id,
						   		 	  		'mes_id'=>$mesFormato
						   		 	    ]);                            
						   }
						   		
					}	   	

					return response()->json(['msg' => 'Fechas registradas exitosamente', 'rpta' => '','success' => true], 201);			 	  

		    }else{ 

		    	   

		    	    $fechaInicio_alterno = Carbon::parse($request->input('fecha_inicio_eval'));
		    	    $fechaInicio_alterno_nuevo = Carbon::parse($request->input('fecha_inicio_eval'));		    	    
		    	    $fechaInicioDia = $fechaInicio_alterno->day;
                    $fechaFin= $fechaInicio_alterno->addMonth();



		           if($fechaInicioDia > 14){


		           	   		$fase= Fase::create([
                    	   		'nombre'=>'',
                    			'fecha_inicio' => $request->input('fecha_inicio_eval'),					
                    	  		'fecha_fin' => $fechaFin,
                    	  		'cantidad_meses'=>1,
                    	  		'estado'=>1
                    	    ]);

                    	    $mesGenerado = $fechaInicio_alterno_nuevo->month;
                    	    $mesFormato = $this->formatoMes($mesGenerado);	
                    	    $anioFormato = $fechaInicio_alterno_nuevo->year;
                    	    $anio=Anio::select('id')->where('nombre','=',$anioFormato)->first();

                    	    $mesAsignado= MesAsignado::create([
						   		 	   		'startup_id'=>'7',
						   		 			'estado' => 1,
						   		 	  		'fase_id' => $fase->id,
						   		 	  		'anio_id'=>$anio->id,
						   		 	  		'mes_id'=>$mesFormato
						   	]);      
                    	  	   	 

                     

		           }elseif ($fechaInicioDia<=14) {
		           	


		           }


		         return response()->json(['msg' => 'Fechas registradas exitosamente', 'rpta' => '','success' => true], 201);
		    }
		   }catch(Exception $ex){

		   	return response()->json(['msg' => 'Error de registro', 'rpta' => '','success' => true], 201);

		   }
        }



          public function pruebaFecha(){

        	 $fechaInicioEval = Carbon::parse('2018-03-14');
        	 $sumadedias=$fechaInicioEval->addDay();
        	 echo $sumadedias;

        }


}
