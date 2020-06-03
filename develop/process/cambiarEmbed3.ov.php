<?php
    
    use core\kernel\ovalo;


    $sec1 = ovalo::section('sec1');

    $sec1->embed()->script('Cuando session_start() es llamada o cuando se autoinicia una sesión, PHP llamará a los gestores de almacenamiento de sesiones open y read. Éstos serán un gestor de almacenamiento proporcionado por omisión o por extensiones de PHP (como SQLite o Memcached); o pueden ser un gestor personalizado como está definido en session_set_save_handler(). La llamada de retorno read recuperará cualquier información se de sesión existente (almacenada en un formato serializado especial) y será deserializada y usada para rellenar automáticamente la variable superglobal $_SESSION cuando la llamada de retorno read devuelva la información de sesión guardada a la gestión de sesiones de PHP.');
?>