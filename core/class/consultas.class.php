<?php
class Consultas  {
    
    static $DBconnection = '';
    private $host = '127.0.0.1';
    private $user = 'root';
    private $pass = '';
    private $db = 'dbprueba';
    var $return_id='';
    var $INSERT = 'INSERT';
    var $UPDATE = 'UPDATE';
    var $DELETE = 'DELETE';
    var $SELECT = 'SELECT';
    function _connectDB(){
        $this->DBconnection = mysql_connect($this->host,$this->user,$this->pass,true ) or die("Error de conexion");
        mysql_select_db($this->db, $this->DBconnection)or die("Error de base de datos: ".$this->db);
        if(!is_object($this->DBconnection))
        {
            return false;
        }else{
           //echo ' => SI conecto';
            return true;
        }
    }
    
        
        function _consultar($tipo, $query){
            $calcrows='';
            $tipo=strtoupper($tipo);
            $this->return_id = '';
            $query = trim($query);
            $this->check_connect();
            switch($tipo){
                    case 'SELECT':
                                set_time_limit(0);
                                ini_set('memory_limit',-1);
                                //if($calcrows){ $query = substr($query,0,6)." SQL_CALC_FOUND_ROWS ".substr($query,6); }
                                $inicio = microtime();
                                $result = mysql_query("set names 'utf8'");
                                $result = mysql_query($query, $this->DBconnection);
                                $fin = microtime();
                                $this->time = $fin - $inicio;
                                $res_array = array ();
                                $i = 0;
                                //Consulta general
                                if ($result) {
                                        while($rows=mysql_fetch_assoc($result)){
                                                foreach($rows as $columna => $valor){
                                                        $res_array[$i][$columna] = $valor;
                                                }
                                                $i++;
                                        }
                                        $result = mysql_query('SELECT FOUND_ROWS() as total', $this->DBconnection);
                                        return $res_array;
                                }else{
                                    return 0;
                                }

                            break;
                    case 'INSERT':
                    case 'UPDATE':
                    case 'DELETE':
                            $return_value="0";
                            try{
                                    $inicio = microtime();
                                    $result = mysql_query("set names 'utf8'");
                                    $result = mysql_query($query, $this->DBconnection);
                                    $query=addslashes($query);
                                    if($result){
                                            $return_value = true;
                                            if($tipo=='INSERT'){
                                                    $this->return_id = mysql_insert_id($this->DBconnection);
                                                    $return_value = $this->return_id;
                                            }
                                    }else{
                                        return 0;
                                    }
                                return $return_value;
                            } catch(Exception $e) {
                                    die("ERROR EN LA SENTENCIA SQL ".$query);
                            }
                            break;
            }
        }
  function check_connect(){
        $arr_config = '';
        if (!isset($this->DBconnection) ){
            if (!isset($this->DBconnection)){
                    $this->_connectDB();
                }
        }
    }  
    
}
