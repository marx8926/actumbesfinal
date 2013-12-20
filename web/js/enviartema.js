/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function getTemaActionButtons(dist_modal, delete_modal){
  actions = "<p>";
  actions += '<a class="share_row actions-icons" data-original-title="Distribuir" data-toggle="modal" href="#'+dist_modal+'"><img alt="distribuir" class="icons" src="http://d19k46zntalu3t.cloudfront.net/img/share.png"></a>';
  actions += '<a class="delete_row  actions-icons" data-original-title="Eliminar" data-toggle="modal" href="#'+delete_modal+'"><img alt="eliminar" class="icons" src="http://d19k46zntalu3t.cloudfront.net/img/trash-icon.png"></a>';
  actions += '</p>';
  return actions;
}

function crearDataTable(idTable,UrlaDTable,FormatoDTable, DrawCallBackFunction, RowCallBackFunction){
	
	var oTable = $('#'+idTable).dataTable({
		"bProcessing": true,
		"bServerSide": false,
		"bDestroy": true,
		"sAjaxSource": UrlaDTable,	  
		"aoColumns": FormatoDTable,				             
	 	"aaSorting": [ [4, 'desc'] ], 
                "sPaginationType": "full_numbers",
	 	"fnCreatedRow": function( nRow, aData, iDisplayIndex ) {
	 		if(typeof(RowCallBackFunction)!= 'undefined' && RowCallBackFunction != null)
	 			RowCallBackFunction(nRow,aData,iDisplayIndex);
		},
	 	"fnDrawCallback": function(oSettings ){
		 	if(typeof(DrawCallBackFunction)!= 'undefined' && DrawCallBackFunction != null){
		 		setTimeout(function() {
			 		DrawCallBackFunction();
		 		});
	 		}
    }
	});
	return oTable;
}