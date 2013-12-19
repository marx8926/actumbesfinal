 FormatoTable = [
                    {
                        "mDataProp": "id"
                    },
                    {
                        "mDataProp": "lider"
                    },{
                        "mDataProp": "creacion"
                    },{
                        "mDataProp": "red"
                    },{
                        "mDataProp": "direccion"
                    },{
                        "mDataProp": "telefono"
                    },{
                        "mDataProp": "dia"
                    },{
                        "mDataProp": "hora"
                    },{
                        "mDataProp": "estado"
                    },{
                        "mDataProp": "tipo"
                    },{
                        "mDataProp": "acciones"
                    }];

function getCelulaActionButtons(conf,add_modal, delete_modal, view_modal ){
  actions = "<p>"
  if(conf.substring(0,1)==1) //add
    actions += '<a class=" add_row actions-icons" data-original-title="Enrolar" data-toggle="modal" href="#'+add_modal+'"><img alt="enrolar" class="icons" src="http://d19k46zntalu3t.cloudfront.net/img/plus1.png"></a>';
  if(conf.substring(1,2)==1) //OFF
    actions += '<a class="delete-row  actions-icons" data-original-title="Desactivar" data-toggle="modal" href="#'+delete_modal+'"><img alt="desactivar" class="icons" src="http://d19k46zntalu3t.cloudfront.net/img/trash-icon.png"></a>';
  if(conf.substring(2,3)==1) //view
    actions += '<a class="ver_row  actions-icons" data-original-title="Ver" href="#'+view_modal+'"><img alt="ver" src="http://d19k46zntalu3t.cloudfront.net/img/view.png"></a>';
  actions += '</p>'
  return actions;
}         

eliminar = [];
 $("#ida").click(function (event) {
                    event.preventDefault();
                    var selectedItem = $("#sin_celula option:selected");
                    $("#en_celula").append(selectedItem);
                });

$("#regreso").click(function (event) {
                    event.preventDefault();
                    var selectedItem = $("#en_celula option:selected");
                    $("#sin_celula").append(selectedItem);
                    //eliminar = selectedItem;
                    
});

                $("#matricular").change(function(){
                    
                });