/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/*Fin extensiones de jQuery*/
function getOtherActionButtons(conf,add_modal, delete_modal, view_modal ){
  actions = "<p>"
  if(conf.substring(0,1)==1) //add
    actions += '<a class=" add_row actions-icons" data-original-title="Añadir" data-toggle="modal" href="#'+add_modal+'"><img alt="ver" class="icons" src="http://d19k46zntalu3t.cloudfront.net/img/plus1.png"></a>';
  if(conf.substring(1,2)==1) //OFF
    actions += '<a class="delete-row  actions-icons" data-original-title="Eliminar" data-toggle="modal" href="#'+delete_modal+'"><img alt="edit" class="icons" src="http://d19k46zntalu3t.cloudfront.net/img/trash-icon.png"></a>';
  if(conf.substring(2,3)==1) //view
    actions += '<a class="ver_row  actions-icons" data-original-title="Ver" href="#'+view_modal+'"><img alt="trash" src="http://d19k46zntalu3t.cloudfront.net/img/view.png"></a>';
  actions += '</p>'
  return actions;
}

function cambiar_estado(modal)
{
    actions = "<p>";
    
    actions += '<a class="estado-row  actions-icons" data-original-title="Cambiar Estado" data-toggle="modal" href="#'+modal+'"><img alt="edit" class="icons" src="http://d19k46zntalu3t.cloudfront.net/img/sorting.png"></a>';

    actions += '</p>';
    return actions;
}

function cambiar_ver_estado(modal_cambiar, modal_ver)
{
    actions = "<p>";
    
    actions += '<a class="estado-row  actions-icons" data-original-title="Cambiar Estado" data-toggle="modal" href="#'+modal_cambiar+'"><img alt="edit" class="icons" src="http://d19k46zntalu3t.cloudfront.net/img/sorting.png"></a>';
    actions += '<a class="ver_row  actions-icons" data-original-title="Ver Detalle" href="'+modal_ver+'"><img alt="trash" src="http://d19k46zntalu3t.cloudfront.net/img/view.png"></a>';


    actions += '</p>';
    return actions;
}