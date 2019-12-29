/**
 * crea tabella con tabulator.js 
 * @param columns_config configurazione colonne
 */
window.create_table = function create_table(columns_config){
 	//definisco la tabella
  table = new Tabulator("#table", {
	layout:"fitColumns", //colonne si restringono attorno ai dati, il restante spazio è vuoto ma sempre una "tabella"
	responsiveLayout:"collapse", //le colonne si impilano quando non c'è abb spazio
	placeholder:"No Data Available", //quando non ci sono dati
	pagination:"local", //imposto la paginazione
	paginationSize:20, //per ogni pagina mostro n righe
	selectable:1, //righe selezionabili
	rowSelected: window.rowSelected, //callback riga selezionata
	rowDeselected: window.row_deselected, //callback riga deselezionata
	rowSelectionChanged: window.row_selection_changed, //callback al cambio selezione riga
	rowDblClick: window.row_dbl_click,//callback al doppio click sulla riga
	tooltips:true,
  	columnVertAlign:"bottom", 
 	columns: columns_config,
});
}
/** carica i dati in tabella con ajax
 * @param  {} url url ajax
 * @param  {} token token laravel
 * @param  {} obj_parameters parametri ajax
 */
window.load_table = function load_table(url,token,obj_parameters = null) {
	//carico i dati in tabella via ajax
	var ajaxConfig = {
    	method:"POST", //set request type to Position
    	headers: {'X-CSRF-Token': token,},
	};
	console.info(obj_parameters);
	table.setData( url, obj_parameters, ajaxConfig);
}

/** 
* Ricerca una stringa nella tabella 
* @param {string} str da ricercare
*/
window.search = function search(str)
{
	var filters = [];
    var columns = table.getColumns();
    var search = str;

    columns.forEach(function(column){
			if(column.getField() != undefined)
			{
        filters.push({
            field:column.getField(),
            type:"like",
            value:search,
				});
			}
    });

    table.setFilter([filters]);
}
/**
 * reset form
 * @return {null} nothing
 */
window.form_reset = function form_reset() {
	//pulisco gli input del form
	$("#form")[0].reset();
	//rimuovo gli eventuali campi nascosti degli id
	$('input[type=hidden]').remove()
	//rimuovo i danger
	$(":input").removeClass('uk-form-danger');
	//riabilito il btn submit
	$('#btn_submit').attr('disabled',false);				
	console.log('Reset form ok');								
}
/**
 * reset form
 * @return {null} nothing
 */
window.form_read_only = function form_read_only(setta) {
	$('#form *').prop('disabled', setta);
	//riabilito il btn submit
	$('#btn_submit').prop('disabled',setta);				
	console.info('Form in sola lettura: '+setta);								
}

/**
 * @param  {boolean} state true per disabilitare
 */
window.btn_disable = function btn_disable(state)
{
    //disabilito i pulsanti
	$('#btn_modifica').attr('disabled',state);
	$('#btn_elimina').attr('disabled',state);
  	$('#btn_visualizza').attr('disabled',state);
  	$('#btn_stampa').attr('disabled',state);
}

/*chiamata ajax per popolare i select con le options
* @param {string} id select
* @param {string} url ajax
* @param {string} data dati da inviare
* @param {string} placeholder
* @param {string} campo dell'array da utilizzare
*/
window.get_options = function get_options(id_element,url,placeholder,field,field_ext = null,data = null) {
	if($(id_element).length) {
    $.ajax({
        url: url,
        data: data,
        success: function(data){
					$(id_element).html('<option value="" disabled selected>'+placeholder+'</option>');
          for (let i = 0; i < data.length; i++) {
            var id = data[i].id;
						var text = data[i][field];
						(field_ext!=null)? text+=' '+data[i][field_ext] : '';
            var option = "<option value='"+id+"'>"+text+"</option>"; 
            $(id_element).append(option);
          }
        },
        error: function(data) { 
             alert("get_options: Errore nella chiamata ajax!"+data);
        }
	 });
	}else
	{
		alert("L'id "+id_element+" non esiste.")
	}
}

/** chiamata ajax per popolare gli input
* @param {string} attributo name input
* @param {url} url ajax
*/
window.get_input_value = function get_input_value(name_input,url)
{
	if($('input[name="'+name_input+'"]').length)
	{
		$.ajax({
        url: url,
        data: '',
        success: function(data){
					$('input[name="'+name_input+'"]')[0].value=data;
					$('#modal_loading').toggleClass('uk-hidden',true);
        },
        error: function(data) { 
             alert("get_options: Errore nella chiamata ajax!"+data);
        }
	 });
	}
	else
	{
		alert("L'input con name= "+name_input+" non esiste.")
	}
	
}

/** alla selezione di un riga
*  @param {object} riga
*/ 
window.rowSelected = function row_selected(row){
	//recupero l'id (del database)
	row_selected_id = row.getData()['id'];
	if(row_selected_id != null)
	{	//abilito i pulsanti
		btn_disable(false);
	}
};
/** alla deselezione di un riga
*  @param {object} riga
*/
window.row_deselected = function row_deselected(row){
	row_selected_id = null;
	//disabilito i pulsanti
	btn_disable(true);
}
/** al cambio selezione di un riga
*  @param {object} data
* @param {object} riga
*/
window.row_selection_changed = function row_selection_changed(data, rows){
	if(data.length > 0)
	{
		row_selected_id = data[0].id;
		btn_disable(false);
	}
}
/** al doppio click sulla riga 
*  @param {object} data
* @param {object} riga
*/
window.row_dbl_click = function row_dbl_click(e, row){
	
	//recupero l'id (del database)
	row_selected_id = row.getData()['id'];
	if(row_selected_id != null && row_selected_id > 0)
	{
		$("#btn_visualizza").trigger("click");
		UIkit.modal($("#modal")[0]).show();
	}
}


/** chiamata ajax per rimuovere un elemento
*  @param {Number} id id del database
*  @param {String} url url su cui effettuare la chiamata
*/
window.remove = function remove(id,url)
{ 
	$.ajax({
             url: url,
			 method : "DELETE",
             data: {"id" : id},
             success: function(data){
					//stampo messaggio 
					UIkit.notification({
											message: data,
											status: '',
											pos: 'bottom-center',
											timeout: 3000
										});
										//chiudo il modal
						setTimeout(() => {
							UIkit.modal($('#modal')).hide();
							table.setData();
						}, 2000);
				},
			error:function (data) { alert('delete_persona errore chiamata ajax!');}
	});
}
/** funzione per rimuovere i valori null nella generazione del pdf
 * 
 */
window.notNull = function (value, data, type, params, column){
	return (value==null)? "" : value;
};