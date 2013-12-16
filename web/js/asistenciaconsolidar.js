/*Fin extensiones de jQuery*/
function getConsolidadoActionButtons(filtro, resumen_modal, asistencia_modal, descartar_modal, editar_modal ){
    
    actions = "<p>";
    if(filtro == '0')
    {
    //resumen
        actions += '<a class="resumen_row actions-icons" data-original-title="Resumen" data-toggle="modal" href="'+resumen_modal+'"><img alt="ver" class="icons" src="http://d19k46zntalu3t.cloudfront.net/img/view.png"></a>';
    //asistencia
        actions += '<a class="asistencia_row  actions-icons" data-toggle="modal" data-original-title="Asistencia" href="'+asistencia_modal+'"><img alt="edit" class="icons" src="http://d19k46zntalu3t.cloudfront.net/img/select2.png"></a>';
    //descartar
        actions += '<a class="descartar_row  actions-icons" data-toggle="modal" data-original-title="Descartar" href="'+descartar_modal+'"><img alt="trash" src="http://d19k46zntalu3t.cloudfront.net/img/trash-icon.png"></a>';
    //editar
        actions += '<a class="editar_row  actions-icons" data-toggle="modal" data-original-title="Editar" href="'+editar_modal+'"><img alt="trash" src="http://d19k46zntalu3t.cloudfront.net/img/edit-icon.png"></a>';
    }
    else if(filtro=='1')
    {
         actions += '<a class="resumen_row actions-icons" data-original-title="Resumen" data-toggle="modal" href="'+resumen_modal+'"><img alt="ver" class="icons" src="http://d19k46zntalu3t.cloudfront.net/img/view.png"></a>';
    }
    else
    {
        //resumen
        actions += '<a class="resumen_row actions-icons" data-original-title="Resumen" data-toggle="modal" href="'+resumen_modal+'"><img alt="ver" class="icons" src="http://d19k46zntalu3t.cloudfront.net/img/view.png"></a>';
        //editar
        actions += '<a class="editar_row  actions-icons" data-toggle="modal" data-original-title="Editar" href="'+editar_modal+'"><img alt="trash" src="http://d19k46zntalu3t.cloudfront.net/img/edit-icon.png"></a>';
 
    }
  actions += '</p>';
  
  return actions;
}
