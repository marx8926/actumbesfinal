   
                $("#ida").click(function (event) {
                    event.preventDefault();
                    var selectedItem = $("#estudiantes option:selected");
                    $("#matricular").append(selectedItem);
                });

                $("#regreso").click(function (event) {
                    event.preventDefault();
                    var selectedItem = $("#matricular option:selected");
                    $("#estudiantes").append(selectedItem);
                });

                $("#matricular").change(function(){
                    
                });
                
                
                    
             
                
                FormatoEMTable = [
                    {
                        "mDataProp": "nombres"
                    },{
                        "mDataProp": "red"
                    },{
                        "mDataProp": "acciones"
                    }];
                
                FormatoMatriculaTable = [
                {                
                    "mDataProp": "abreviatura"
                },
                {
                    "mDataProp": "titulo"
                },{
                    "mDataProp": "dia"
                },
                {
                    "mDataProp": "inicio"
                },            
                {
                    "mDataProp": "fin"
                },{
                    "mDataProp": "hora_inicio"
                },{
                    "mDataProp":"hora_fin"
                },{
                    "mDataProp":"estado_nombre"
                },{
                    "mDataProp": "numero_sesiones"
                },{
                    "mDataProp": "requisito"
                },{ "mDataProp": "acciones"}
                ]; 
                
                
                 function generar_vista_tabla_curso(idTable, UrlaDTable, FormatoDTable)
                {
                    //columnas = generar_acolumnas(5,"L");
                    
                    var oTable = $('#'+idTable).dataTable({
                        "bProcessing": true,
                        "bServerSide": false,
                        "bDestroy": true,
                        "sAjaxSource": UrlaDTable,	  
                        "aoColumns": FormatoDTable,				             
                        "aaSorting": [ [0, 'asc'], [1, 'asc'] ], 
                        "sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span12'i><'span12 center'p>>",
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
                
                function generar_acolumnas(num_lecciones,patron)
                {
                    var resultado = [];
                    //añadir N°
                    resultado.push({"sTitle": "N°", "mDataProp": "nro" });
                    //Añadir inicio
                    resultado.push({"sTitle": "Estudiante", "mDataProp": "nombres"});

                    
                    for(i=1; i <= num_lecciones; i++ )
                    {
                        item = {"sTitle": patron+i.toString(), "mDataProp": patron+i.toString()};
                        
                        resultado.push(item);
                    }
                    return resultado;
                }
                
                