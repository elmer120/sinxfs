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
	rowSelected:row_selected, //callback riga selezionata
	rowDeselected:row_deselected, //callback riga deselezionata
	rowSelectionChanged: row_selection_changed, //callback al cambio selezione riga
  	tooltips:true,
  	columnVertAlign:"bottom", 
 	columns: columns_config,
});
}
/** carica i dati in tabella con ajax
 * @param  {} url url ajax
 * @param  {} token token laravel
 */
window.load_table = function load_table(url,token) {
	//carico i dati in tabella via ajax
	var ajaxConfig = {
    	method:"POST", //set request type to Position
    	headers: {'X-CSRF-Token': token,},
	};
	table.setData( url, {}, ajaxConfig);
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


