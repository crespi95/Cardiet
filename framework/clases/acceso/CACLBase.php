<?php
abstract class CACLBase {
    
    
    abstract public function anadirRole($nombre, $puedeAcceder, $puedeConfigurar, $permisoOtros=array());
    abstract public function getCodRole($nombre);
    abstract public function existeRole($codRole);
    abstract public function anadirUsuario($nombre, $nick, $contrasena, $codRole);
    abstract public function existeUsuario($nick);
    abstract public function esValido($nick, $contrasena);
    abstract public function getPermisos($nick, &$puedeAcceder, &$puedeConfigurar);
    abstract public function getPermisoOtros($nick, $numero);
    abstract public function getPermisosOtros($nick);
    abstract public function getNombre($nick);
    abstract public function setNombre($nick, $nombre);
    abstract public function dameUsuarios();
    abstract public function dameRoles();
    
}