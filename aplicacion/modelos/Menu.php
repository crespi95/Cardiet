<?php

class Menu extends CActiveRecord
{
    
    protected function fijarNombre()
    {
        return 'menu';
    }
    protected function fijarTabla(){
        return "menus";
    }
    
    protected function fijarAtributos()
    {
        return array(
            "fecha",
            "menu",
            "kcal",
            "usuario",
            "cod_menu"
            
           
            
        );
    }
    
    protected function fijarDescripciones()
    {
        return array(
            "fecha" => "Fecha: ",
            "menu"=> "Menu: ",
            "kcal"=> "Kcal total: ",
            "usuario"=>"Usuario: ",
            "cod_menu"=>"Codigo menu: "
            
        );
    }
    
    protected function fijarRestricciones()
    {
        Return array(
            array(
                "ATRI" => "fecha,menu,cantidad,usuario",
                "TIPO" => "REQUERIDO"
            ),
            array(
                "ATRI" => "menu",
                "TIPO" => "CADENA",
                "TAMANIO" => 200000
            ),
            array(
                "ATRI" => "fecha",
                "TIPO" => "FUNCION",
                "FUNCION" => "validaFecha"
            ),
            
            array(
                "ATRI" => "kcal",
                "TIPO" => "ENTERO",
                "MIN" => 0
            ),    array(
                "ATRI" => "kcal",
                "TIPO" => "ENTERO",
                "MAX" => 50000
            ),
            array(
                "ATRI" => "usuario",
                "TIPO" => "FUNCION",
                "FUNCION" => "validaUsuario"
            ),
        
        );
    }
    
    
    protected function afterCreate()
    {
        $this->fecha=(new DateTime())->format("d/m/Y");
        $this->menu = "";
        $this->kcal = 0;
        $this->usuario= "";
        if(Sistema::app()->Acceso()->hayUsuario()){
            $this->usuario =  Sistema::app()->Acceso()->getNick();
        }
    }
    protected function validamenu(){
        $cod_menu = CGeneral::addSlashes($this->cod_menu);
        $nick = CGeneral::addSlashes($this->usuario);
        $cod_usu= Sistema::app()->ACLBD()->getCod_usu($nick);
        $filas=$this->buscarTodos(["where cod_usuario = $cod_usu"]);
        $contador= 0;
        foreach ($filas as $value) {
            if($value["cod_menu"]==$cod_menu){
                $contador++;
            }
        }
        if($contador!=0){
            return true;
        }
        $this->setError("cod_menu", "El menu que intenta modificar no existe");
        
    }

    public function validaFecha(){
        $fecha1=DateTime::createFromFormat('Y-m-d',$this->fecha);
        $fecha2=DateTime::createFromFormat('Y-m-d','2000-01-01');
        if ($fecha1<$fecha2)
        {
            $this->setError("fecha","La fecha debe ser posterior a 01/01/2000");
        }
    }
    public function validaUsuario(){
        if(!Sistema::app()->Acceso()->hayUsuario() || Sistema::app()->Acceso()->getNick()!=$this->usuario){
            $this->setError("usuario", "El usuario no es válido");
            
        }     
    }
    public function insertarMenu(){
        $nick = CGeneral::addSlashes($this->usuario);
        $menu=CGeneral::addSlashes($this->menu);

        $fecha=CGeneral::fechaNormalAMysql($this->fecha);
        $kcal=CGeneral::addSlashes($this->kcal);       
        $cod_usuario = Sistema::app()->ACLBD()->getCod_usu($nick);
       
        $sent="INSERT INTO menus (cod_menu, fecha, menu, cod_usuario, kcal) VALUES (
                            NULL, '".$fecha."', '".$menu."','".$cod_usuario."', '".$kcal."')";
        Sistema::app()->BD()->crearConsulta($sent);
        
        
    }
    public function updateMenu(){
         
        $menu=CGeneral::addSlashes($this->menu);       
        $fecha=CGeneral::fechaNormalAMysql($this->fecha);
        $kcal=CGeneral::addSlashes($this->kcal);
        $cod_menu = CGeneral::addSlashes($this->cod_menu);
        
        $sent="UPDATE menus SET menu = '$menu', fecha ='$fecha', kcal='$kcal' WHERE cod_menu = $cod_menu";
        Sistema::app()->BD()->crearConsulta($sent);
        
        
    }
    public function sentenciaDelete($id){
        
        return "DELETE FROM menus WHERE cod_menu = ".$id;
        
    }
    
    
}