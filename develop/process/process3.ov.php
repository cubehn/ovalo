<?php
/*---------------------------------------------------------------
Objects:
    ovalo::BDD(<nombre de la configuracion>)
    ovalo::html() //sino lleva parametro hacer referencia al html del section donde se esta ejecutando el process, si se quiere hacer referencia a otro se debe colocar el Id del Section como parametro
    ovalo::viewFields('id')
    ovalo::viewFields('val')
    ovalo::viewFields('vals')

    //Parametro 1: titulo del mensaje
    //Parametro 2: contenido del mensaje
    //(opcional) Parametro 3: 1=muestra alerta al inicio del section, 2= al final
    //(opcional) Parametro 4: es el color segun bootstrap
    ovalo::message('title','message','position','color')
 
    $ovReturn
    $ovParam
    $ovDataSet
-----------------------------------------------------------------*/
    
//$query='insert into prueba('.ovalo::viewFields('id').') values('.ovalo::viewFields('val').')';
//ovalo::BDD('con')->exec($query);
    


    $query='select * from prueba';
    $datos=ovalo::BDD('con')->select($query);

    $obj=ovalo::component('sec2','componente2',$datos);
    ovalo::html('sec2')->getElementById('contUser1')->appendChild($obj);
    
//    ovalo::html('sec2')->getElementById('nom')->setAttribute('onChange','alert("dinamicamente!");');
    
    ovalo::addEvent('onChange','sec2','nom','javascript:alert("desde codigo");');
    //ovalo::addEvent('onClick','sec2','exampleCheck1','document.getElementById("ape").value=parseInt(document.getElementById("ape").value)+1');
    
    //ovalo::html('sec2')->addEvent('onChange','nom','process:process2'); //javascript:alert("hola");

    $valor = 'desde un parametro';

    ovalo::addEvent('onClick','sec2','exampleCheck1','process:process2,'.$valor);
    
    
     /*
     PENDIENTES
     =================================
     - [YA] tiene que llamar al componente1 construirlo con los datos y pintarlo en conUser1 (que esta en prueba.html)
     - Es mejor que el metodo "html" tenga funciones de ayuda directas y para acceder al DOM sea con el metodo dom:
            ovalo::html('sec2')->dom()->getElementById('contUser1')->appendChild($obj);
        ó
            ovalo::html('sec2')->component('componente1','contUser1',$datos);
        en lugar de:
            $obj=ovalo::component('sec2','componente1',$datos);
            ovalo::html('sec2')->getElementById('contUser1')->appendChild($obj);
            ovalo::html('sec2')->addEvent('onChange','nom','process:process2');
     - [YA] Que los process reciban parametros definidos por el usuario
        ahora acepta un parametro:
            process:process2,parametro
     - Tambien falta una opcion para cambiar el file asociado a un section desde una action
     - [YA ]Acciones asociadas por el usuario, por ejemplo que al dar click en un elemento de la lista se ejecute una action y que se puedan enviar parametros propios del objeto donde se le hace el click
       como por ejemplo que al dar click en el objeto se pase el texto a otro input.
            ovalo::addEvent(<evento>,<section>,<objeto>,<script>);
            ejemplo:
            ovalo::addEvent('onClick','sec2','exampleCheck1','process:process2,parametro);
     - Hay un problema que no se puede ejecutar dos procesos tardados al mismo tiempo mediante "capsule"
     */
?>

