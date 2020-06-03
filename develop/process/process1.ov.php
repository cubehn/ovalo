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
-----------------------------------------------------------------*/
    

    $query='insert into prueba('.ovalo::viewFields('id').') values('.ovalo::viewFields('val').')';
    ovalo::BDD('con')->exec($query);

    $pru=ovalo::html()->getElementById('nom')->getAttribute('value');

    ovalo::html()->getElementById('ape')->setAttribute('value','Automaticamente Ape');
    ovalo::html()->getElementById('nom')->setAttribute('value','Dinamic Nom');
    ovalo::html()->getElementById('nom')->setAttribute('style','background-color: #BF9FEF');

    $pru2=ovalo::html()->getElementById('nom')->getAttribute('value');

    ovalo::html('sec3')->getElementById('elem3')->setAttribute('value',$pru);

    //ovalo::html('mainse3')->getElementById('elem1')->setAttribute('value','otro section');

    ovalo::message('Aviso','El registro ha sido guardado. '.$pru.' -> '.$pru2,2,'success');


?>