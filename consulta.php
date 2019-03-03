<?php 
//Script para conexión con base de datos en Mysql
include("db_script/heasy_mysql.php");
// Get Params Client
$obj = (object)$_REQUEST;

//Ejecutar Consultas en MYSQL desde PHP
switch ($obj->action) {
	case 'eliminar':
		$x = query("DELETE FROM libro 
					WHERE id_libro=$obj->id_libro ");
		if($x>0){
			server_res([
				"success"=>true
				,"message"=>"Eliminación Exitosa"
			]);
		}else{
			server_res([
				"success"=>false
				,"message"=>"Error al eliminar"
			]);
		}
		break;
	case 'editar':
		$r = query("SELECT * FROM libro 
			WHERE id_libro=$obj->id_libro");
		server_res($r[0]);
		break;
  	case 'buscar':
  	$r = query("SELECT * FROM libro 
			WHERE {$obj->tipo} LIKE '%{$obj->word}%'"); 

  	server_res($r);
    	break; 

    case 'guardar':

    if($obj->id_libro==""){
      $id = query("INSERT INTO libro (codigo,titulo,autor,editorial,ejemplares,fech_registro)VALUES('$obj->codigo','$obj->titulo','$obj->autor','$obj->editorial','$obj->ejemplares','$obj->fech_registro')");
    }else{
    	$upd = query("UPDATE libro 
    			SET 
    			codigo='$obj->codigo'
				,titulo='$obj->titulo'
				,autor='$obj->autor'
				,editorial='$obj->editorial'
				,ejemplares='$obj->ejemplares'
				,fech_registro='$obj->fech_registro'
				WHERE id_libro=$obj->id_libro");
    	if($upd == 1){
    		$id = $obj->id_libro;
    	}else{
    		$id = 0;
    	}
    	
    }
    
    if($id>0){
    	server_res([
    		"success"=>true
    		,"message"=>"Acción exitosa"
    	]);
    }else{
    	server_res([
    		"success"=>false
    		,"message"=>"Error"
    	]);
    }
    	break;  
}
?>
