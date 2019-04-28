@extends("templates.template")
@section('tab_title',$tab_title) <!-- titolo tab come 2° parametro stringa o variabile -->
@section('page_title',$page_title) <!-- titolo pagina/sezione -->
@section('page_content')

@component('components.actions_bar')
@endcomponent

@component('components.modal',[
	'modal_id' => 'modal',
	'title' => "Nuova ricevuta",
	'btn_text' => 'Inserisci'
]) 
		@component('components.forms.contabilita_ricevuta')
		@endcomponent
@endcomponent

<!-- tabella-->
<div id="table"></div>
<script type="text/javascript" src="{{ URL::asset('js/table_form.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
<script>

//var globali
var token = '{{ csrf_token() }}';
var table;
var row_selected_id;
var data_obj;
var columns_config = [ //definisco le colonne
		//title = titolo , field = chiave array
		{	//creo gruppo 
			title: 'Ricevute',
			columns:[
                { title:"N°", field:"numero"},
                { title:"Data", field:"data"},
                { title:"Importo", field:"importo"},
                { title:"Ricevuti da", field:"persona_nome"},
                { title:"Per", field:"ricevuta_causale"},
			],
        },
        {	//creo gruppo 
            title: 'Dati correlati',
            columns:[
                { title:"Pagamento al", field:"pagamento_data"},
                { title:"Versata su", field:"fondo_descrizione"},
                { title:"Voce conto economico", field:"voce_conto_economico_descrizione"}
            ],
        }
    ];



//al caricamento della pagina
$(document).ready(function(){
	//creo la tabella
	create_table(columns_config);
	//carica i dati
	load_table( '{{ route('getList') }}',token);
	//setto le impostazioni ajax comuni
	$.ajaxSetup({
		type: 'POST',
    cache: false,  
    headers: { 'X-CSRF-Token': token,}
	});

});

//---- EVENTI -----

/** alla selezione di un riga
*  @param {object} riga
*/ 
function row_selected(row){
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
function row_deselected(row){
	row_selected_id = null;
	//disabilito i pulsanti
	btn_disable(true);
}
function row_selection_changed(data, rows){
	if(data.length > 0)
	{
		row_selected_id = data[0].id;
		btn_disable(false);
	}
}

//ricerca istantanea
$("#input_search").keyup(function(){
    search(this.value);
});

$('#btn_visualizza').on('click',function(){
	console.log('btn_visualizza_click');
	//mostro loading
	$('#modal_loading').toggleClass('uk-hidden',false);
	$('#title').text('Visualizza ricevuta');
	$('#btn_submit').attr('disabled',true);	
	//popolo il select persone
	get_options('#select_persona','persone','Scegli il pagante..','nome');
	//popolo il select fondi
	get_options('#select_fondo','fondi','Scegli il fondo..','descrizione');
	//popolo il select tipo associato
	get_options('#select_voce_conto_economico','vociContoEconomico','Scegli la voce..','descrizione');
	//popolo il form
	get_exists_data(row_selected_id);
});

$('#btn_aggiungi').on('click',function(){
	console.log('btn_aggiungi_click');
	//mostro loading
	$('#modal_loading').toggleClass('uk-hidden',false);
	$('#title').text('Aggiungi ricevuta');
	//popolo il select persone
	get_options('#select_persona','persone','Scegli il pagante..','nome');
	//popolo il select fondi
	get_options('#select_fondo','fondi','Scegli il fondo..','descrizione');
	//popolo il select tipo associato
	get_options('#select_voce_conto_economico','vociContoEconomico','Scegli la voce..','descrizione');
	//popolo il select numero ricevuta
	get_input_value('numero','numero');
});

$('#btn_modifica').on('click',function()
{
	console.log('btn_modifica_click');
	//mostro loading
	$('#modal_loading').toggleClass('uk-hidden',false);
	$('#title').text('Modifica ricevuta');
	//popolo il select persone
	get_options('#select_persona','persone','Scegli il pagante..','nome');
	//popolo il select fondi
	get_options('#select_fondo','fondi','Scegli il fondo..','descrizione');
	//popolo il select tipo associato
	get_options('#select_voce_conto_economico','vociContoEconomico','Scegli la voce..','descrizione');
	//popolo il form
	get_exists_data(row_selected_id);
});
$('#btn_elimina').on('click',function()
{
	UIkit.modal.confirm('Eliminare il record selezionato?').then(
		function() {
		remove(row_selected_id);
		//disabilito i btn
		btn_disable(true);
		row_selected_id = null;
	}, 
		function () {
    console.log('Rejected.');
	});
		
});
$('#btn_stampa_lista').on('click',function(){
	table.download("pdf", "lista_ricevute.pdf", {
        orientation:"landscape", //set page orientation to portrait
				title:"Lista Ricevute", //add title to report
				autoTable:function(doc){
        //doc - the jsPDF document object

        //add some text to the top left corner of the PDF
        doc.text("SOME TEXT", 35, 35);

        //return the autoTable config options object
        return {
            styles: {
                fillColor: [200, 00, 00]
            },
        };
    	}
    });
});
$('#btn_stampa').on('click',function(){});
//all submit del form
$('#form').on('submit',function(e){
	e.preventDefault(); //blocco il comportamento di default
	//mostro loading
	$('#modal_loading').toggleClass('uk-hidden',false);
	if($('#id').length) //se l'elemento esiste sono in modifica
	{
		submit('PUT','update');
	}
	else{
		submit('POST','create');
	}

})

$('#btn_annulla').on('click',function (e) {
	form_reset();
	//metto a null la var globale 
	data_obj = null;
})

//-- CHIAMATE AJAX ------
/*chiamata ajax per popolare i select con le options
* @param {string} id select
* @param {string} url ajax
* @param {string} placeholder
* @param {string} campo dell'array da utilizzare
*/
function get_options(id_element,url,placeholder,field) {
	if($(id_element).length) {
    $.ajax({
        url: url,
        data: '',
        success: function(data){
					$(id_element).html('<option value="" disabled selected>'+placeholder+'</option>');
          for (let i = 0; i < data.length; i++) {
            var id = data[i].id;
            var text = data[i][field];
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
function get_input_value(name_input,url)
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

//chiamata ajax per popolare il modifica
function get_exists_data(id)
{
	$.ajax({
             url: 'get',
             data: {"id" : id},
             success: function(data){
									//console.log(data); 
									data_obj = JSON.parse(data)[0];
									//--data_obj
									//aggiungo l'id data_obj
									$('#form').append('<input id="id" type="hidden" name="id" value="'+data_obj.id+'">');
									$('input[name=numero]').val(data_obj.numero);
									$('input[name=data_emissione]').val(data_obj.data);
									$('#select_persona').val(data_obj.fk_persona);
									$('input[name=causale]').val(data_obj.ricevuta_causale);
									$('input[name=importo]').val(data_obj.importo);
									$('input[name=data_pagamento]').val(data_obj.pagamento_data);
									$('#select_fondo').val(data_obj.fk_fondo);
									$('#select_voce_conto_economico').val(data_obj.fk_voce_conto_economico);	
									//nascondo loading
									$('#modal_loading').toggleClass('uk-hidden',true);	
				},
             error: function(data) { 
                  alert("get_exists_data: Errore nella chiamata ajax!");
             }
        });
}

//chiamata ajax per l'invio del form
function submit(method,url)
{
	//recupero i valori del form
	var data = $('#form').serialize();
	table.selectRow();
	console.log(data); //x debug
	 $.ajax({
		 	method: method,
			 url: url,
			 data: data,
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
             error: function(data) {
							 //validazione fallita
							if( data.status === 422 ) {
										data = data.responseJSON;
                    var errors = data.errors;
										var message = data.message;
										var messages = '';
										$.each(errors, function (key, val) {
											$(":input[name='"+key+"']").addClass('uk-form-danger');
                        messages+="<p>"+val+"</p>";
										});
										//nascondo loading
										$('#modal_loading').toggleClass('uk-hidden',true);
										//stampo messaggio con errori
										UIkit.notification({
											message: messages,
											status: '',
											pos: 'bottom-center',
											timeout: 3000
										});
							}
						}
});
}
//chiamata ajax per eliminare
function remove(id)
{
	$.ajax({
             url: 'delete',
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
						 error:function (data) { alert('remove errore chiamata ajax!');}
	});
}

</script>

@endsection
