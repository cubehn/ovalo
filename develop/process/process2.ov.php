<?php
/*---------------------------------------------------------------
Objects:
    ovalo::BDD(<nombre de la configuracion>)
    ovalo::html()
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
    
    $query='insert into prueba2('.ovalo::viewFields('id').') values('.ovalo::viewFields('val').')';
    
    //ovalo::html()->getElementById('elem1')->setAttribute('value','prueba123');
    ovalo::html('sec3')->getElementById('elem1')->setAttribute('value','prueba123 = '.$ovParam);
    //ovalo::html('sec2')->getElementById('nom')->setAttribute('value','JAJAJA');

 
?>