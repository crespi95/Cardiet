<?php
if(isset($_SESSION["usuario"]["nick"])){
    if($_SESSION["usuario"]["validado"]){
        echo $_SESSION["usuario"]["nick"];
    }
}else{
    echo "Invitado";
}
