@extends("templates.template")
@section('tab_title',$tab_title) <!-- titolo tab come 2° parametro stringa o variabile -->
@section('page_title',$page_title) <!-- titolo pagina/sezione -->
@section('page_content')

@component('components.actions_bar',[
	'btn_visualizza' => 1,
	'btn_aggiungi' => 1,
    'btn_modifica' => 1,
    'btn_elimina' => 1,
    'btn_stampa' => 1,
    'btn_stampa_lista' => 1,
    'input_search' => 1,
])		
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
	var associazione = {!! json_encode($associazione->toArray()) !!};


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
		remove(row_selected_id,'delete');
		//disabilito i btn
		btn_disable(true);
		row_selected_id = null;
	}, 
		function () {
    console.log('Rejected.');
	});
		
});
$('#btn_stampa_lista').on('click',function(){
	let d = new Date();
    let data = '_'+d.getDate()+'_'+(d.getMonth()+1)+'_'+d.getFullYear();
	    table.download("pdf", "lista_ricevute_"+data+".pdf", {
            orientation:"landscape", //set page orientation to portrait
            jsPDF:{}, 
            autoTable:function(doc){
                    var width = doc.internal.pageSize.getWidth();
                    doc.setFontSize(10);
                    var header_title =  associazione.nome+"\n";
                    doc.text(header_title, 10, 10);
                    doc.setFontSize(8);
                    doc.setFont("times", "italic");
                    var header_text  =  associazione.indirizzo+","+associazione.cap+"- "+associazione.comune+"\n" +
                                        "Tel: " + associazione.telefono + " Tel: " + associazione.telefono_ext + " - " + "Email: "+associazione.email+"\n" +
                                        "Cf: " + associazione.codice_fiscale +" - " + "Pi: " + associazione.partita_iva;
                    doc.text(header_text, 10, 20);
                    doc.setFontSize(14);
                    doc.setFont("times", "normal");
                    doc.text("Lista ricevute",(width/2)-50,20,);
                
                            return {
                                theme: 'grid',
                                styles: {cellPadding: 0.1, fontSize: 7},
                                margin: {right: 5,left: 5,bottom: 10},
                                valign: 'left',
                                lineWidth: 1,
                                lineColor: [255, 0, 0],
                                startY: doc.pageCount > 1? doc.autoTableEndPosY() + 20 : 50
                            }
            }
        });
});

$('#btn_stampa').on('click',function(){
	if(row_selected_id != null)
	{var row = table.getRow(row_selected_id); //recupero l'oggetto della riga selezionata
	//recupero l'oggetto json della riga {field:value}
	var rowData = row.getData();
	//recupero i titoli delle colonne
	var title = new Array();
	table.getColumns().forEach(element => {
		title.push(element.getDefinition().title);
	});
	//recupero i valori della riga
	var values = Object.values(rowData);
	values.shift();
	//rimuovo gli elementi non necessari
	values.splice((values.length-2), 2);
	title.splice((title.length-2), 2);
	//istanzio l'oggetto che conterra i titoli (coretti!) e i valori della riga
	var obj = {};
	for (let i = 0; i < title.length; i++) {
		obj[title[i]]=values[i];
	}
	//console.log(obj);
	var header = '<h3>' + associazione.nome + '</h3>' +
				'<small>'+associazione.indirizzo + ', - ' +associazione.cap + ' ' + associazione.comune +'(' + associazione.provincia_sigla + ')</small> <br>'+
				'<small>Tel: ' + associazione.telefono + '- Tel: ' + associazione.telefono_ext + '-' +'Email: ' + associazione.email + '</small><br>'+
				'<small>Cf: ' + associazione.codice_fiscale +' - Pi: ' + associazione.partita_iva + '</small><hr>';
	printJS({
		documentTitle: 'Ricevuta',
		printable: [obj],
		type: 'json',
		properties: title,
		header: header,
		headerStyle: 'font-weight: 200;',
		style: 'td { text-align: center; }'
	  })
	}
});

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


</script>

@endsection
