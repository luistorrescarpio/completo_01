<?php 
/*
	Nombre: heasy_mysql
	Versión: 1.1.0
	Autor del Script: Luis Torres Carpio
	Correo: luis.torres.carpio1@gmail.com
	Descripción: 
		Script para facilitar las consultas en Mysql desde PHP
		Pensado para el desarrollo agil.
*/
class conexion{	
	private $server;
	private $user;
	private $clave;
	private $db;
	
	public $conex;
	
	function __construct()
	{	
		$this->server="127.0.0.1";
		$this->user="root";
		$this->clave="";
		$this->db="test_libreria02";
	}
	public function conectar()
	{
		$this->conex=new mysqli($this->server,$this->user,$this->clave,$this->db);
		$this->conex->set_charset("utf8");//save accent db
	}
	public function cerrar()
	{
		$this->conex->close();
	}
}
function query_exec($consulta){
	$mc=new conexion();
	$mc->conectar();
	$mc->conex->multi_query($consulta);
	while ($mc->conex->next_result()) {;} // flush multi_queries
	$mc->cerrar();
	return 1;
}
function query($consulta){
	$type = array(
		"INSERT INTO", 
		"INSERT", 
		"UPDATE",
		"SELECT * FROM",
		"SELECT",
		"DELETE FROM",
		"CREATE TABLE",
		);
	for($i=0;$i<count($type);$i++){

		if (strpos($consulta, $type[$i]) !== false){
			$mc=new conexion();
			$mc->conectar();
			switch ($type[$i]) {
				case 'INSERT INTO':
					$mc->conex->query($consulta);
					$id=$mc->conex->insert_id;
					return $id;
					break;
				
				case 'UPDATE':
					$mc->conex->query($consulta);
					return 1;
					break;	

				case 'SELECT * FROM':
					$results = $mc->conex->query($consulta);
					if($results->num_rows>0){
						while( $rr = mysqli_fetch_assoc($results) ) $rows[] = $rr;
					
						return $rows;
					}else
						return [];
					break;

				case 'SELECT':
					$results = $mc->conex->query($consulta);
					if($results->num_rows>0){
						while( $rr = mysqli_fetch_assoc($results) ) $rows[] = $rr;
					
						return $rows;
					}else
						return [];
					break;
					
				case 'DELETE FROM':
					$mc->conex->query($consulta);
					return 1;
					break;

				case 'CREATE TABLE':
					$mc->conex->query($consulta);
					return 1;
					break;
			}
		$mc->cerrar();
		}
	}
}
function server_res($data){
	if( gettype($data) == "string" )
			echo $data;
		else
			echo json_encode($data);
		exit();
}
?>