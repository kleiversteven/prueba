<?php
class Persona extends Consultas {
    function Municipios(){
        $query="SELECT * FROM municipios";
        return $this->_consultar($this->SELECT,$query);
    }
    function Profesiones(){
        $query="SELECT * FROM profesion";
        return $this->_consultar($this->SELECT,$query);
    }
    function Marcas(){
        $query="SELECT * FROM marca";
        return $this->_consultar($this->SELECT,$query);
    }
    function Modelo($marca=''){
        $query="SELECT * FROM modelo where codemarc = $marca ";
        return $this->_consultar($this->SELECT,$query);
    }
    function buscar_persona($cedula=''){
        $cedula=trim($cedula);
        $query="SELECT cedupers, nombpers FROM 	persona where cedupers = '$cedula' and persona.statpers = 1 ";
        return $this->_consultar($this->SELECT,$query);
    }
    function insert_persona($cedula='',$nombre='',$fecha='',$munic='',$dir='',$telf='',$sexo=''){
        $query="insert into persona (cedupers,nombpers,nacipers,codemuni,direpers,telepers,sexopers)values('$cedula','$nombre','$fecha','$munic','$dir','$telf','$sexo')";
            return $this->_consultar($this->INSERT,$query);
    }
    function add_profesion($cedula='',$prof=''){
        $query="insert into dpersona (cedupers,codeprof)values('$cedula','$prof')";
        return $this->_consultar($this->INSERT,$query);
    }
    function add_vehiculo($cedula='',$marca='',$mode=''){
        $query="insert into dpersonab (cedupers,codemarc,codemode)values('$cedula','$marca','$mode')";
        return $this->_consultar($this->INSERT,$query);
    }
    function get_personas($cedu=''){
        $query="SELECT
                    persona.cedupers,
                    persona.nombpers,
                    persona.nacipers,
                    TIMESTAMPDIFF(
                        YEAR,
                        persona.nacipers,
                        CURDATE()
                    ) AS edad,
                    persona.codemuni,
                    persona.direpers,
                    persona.telepers,
                    persona.sexopers,
                IF (
                    persona.sexopers = 'f',
                    'Femenino',
                    'Masculino'
                ) AS sexo,
                 profesion.descprof,
                 marca.descmarc,
                 modelo.descmode,
                 modelo.codemode,
                 modelo.aniomode,
                 municipios.descmuni,
                 persona.statpers,
                 profesion.codeprof,
                 marca.codemarc
                FROM
                    persona
                LEFT JOIN dpersona ON persona.cedupers = dpersona.cedupers
                LEFT JOIN dpersonab ON persona.cedupers = dpersonab.cedupers
                LEFT JOIN marca ON dpersonab.codemarc = marca.codemarc
                LEFT JOIN modelo ON modelo.codemarc = marca.codemarc
                AND dpersonab.codemode = modelo.codemode
                INNER JOIN profesion ON profesion.codeprof = dpersona.codeprof
                INNER JOIN municipios ON municipios.codemuni = persona.codemuni
                WHERE
                    persona.statpers = 1 ";
        if(!empty($cedu))
            $query.=" and persona.cedupers = '$cedu' ";
        
        return $this->_consultar($this->SELECT,$query);
    }
    function update_persona($cedula='',$nombre='',$munic='',$dir='',$telf=''){
        $query = "update persona set nombpers= '$nombre' ,codemuni= $munic, direpers = '$dir',telepers= '$telf' where cedupers ='$cedula' ";
        return $this->_consultar($this->UPDATE,$query);
        
    }
    function update_profesion($cedula='',$prof=''){
        $query="update dpersona set codeprof='$prof' where cedupers = '$cedula' ";
        return $this->_consultar($this->INSERT,$query);
    }
    function update_vehiculo($cedula='',$marca='',$mode=''){
        $query="update dpersonab set codemarc='$marca' ,codemode='$mode' where cedupers = '$cedula' ";
        return $this->_consultar($this->INSERT,$query);
    }
    function delete_persona(){
        $query="update persona set statpers=0 where cedupers = $cedu and persona.statpers = 1";
        return $this->_consultar($this->UPDATE,$query);
    }
}