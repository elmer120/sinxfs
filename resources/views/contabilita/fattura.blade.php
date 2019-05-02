@extends("templates.template")
@section('tab_title',$tab_title) <!-- titolo tab come 2° parametro stringa o variabile -->
@section('page_title',$page_title) <!-- titolo pagina/sezione -->
@section('page_content')

@component('components.actions_bar')
@endcomponent

@component('components.modal',[
	'modal_id' => 'modal',
	'title' => "Nuova fattura",
	'btn_text' => 'Inserisci'
]) 
		@component('components.forms.contabilita_ricevuta')
		@endcomponent
@endcomponent

<!-- tabella-->
<div id="table"></div>
<div class="invoice">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="https://www.sparksuite.com/images/logo.png" style="width:100%; max-width:300px;">
                            </td>
                            
                            <td>
                                Invoice #: 123<br>
                                Created: January 1, 2015<br>
                                Due: February 1, 2015
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                Sparksuite, Inc.<br>
                                12345 Sunny Road<br>
                                Sunnyville, CA 12345
                            </td>
                            
                            <td>
                                Acme Corp.<br>
                                John Doe<br>
                                john@example.com
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="heading">
                <td>
                    Payment Method
                </td>
                
                <td>
                    Check #
                </td>
            </tr>
            
            <tr class="details">
                <td>
                    Check
                </td>
                
                <td>
                    1000
                </td>
            </tr>
            
            <tr class="heading">
                <td>
                    Item
                </td>
                
                <td>
                    Price
                </td>
            </tr>
            
            <tr class="item">
                <td>
                    Website design
                </td>
                
                <td>
                    $300.00
                </td>
            </tr>
            
            <tr class="item">
                <td>
                    Hosting (3 months)
                </td>
                
                <td>
                    $75.00
                </td>
            </tr>
            
            <tr class="item last">
                <td>
                    Domain name (1 year)
                </td>
                
                <td>
                    $10.00
                </td>
            </tr>
            
            <tr class="total">
                <td></td>
                
                <td>
                   Total: $385.00
                </td>
            </tr>
        </table>
    </div>
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


function demoFromHTML(source) {
            var pdf = new jsPDF('p', 'pt', 'letter');
            // source can be HTML-formatted string, or a reference
            // to an actual DOM element from which the text will be scraped.
            //source = $('#invoice');

            // we support special element handlers. Register them with jQuery-style 
            // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
            // There is no support for any other type of selectors 
            // (class, of compound) at this time.
            specialElementHandlers = {
                // element with id of "bypass" - jQuery style selector
                '#bypassme': function(element, renderer) {
                    // true = "handled elsewhere, bypass text extraction"
                    return true
                }
            };
            margins = {
                top: 80,
                bottom: 60,
                left: 40,
                width: 522
            };
            // all coords and widths are in jsPDF instance's declared units
            // 'inches' in this case
            pdf.fromHTML(
                    source, // HTML string or DOM elem ref.
                    margins.left, // x coord
                    margins.top, {// y coord
                        'width': margins.width, // max width of content on PDF
                        'elementHandlers': specialElementHandlers
                    },
            function(dispose) {
                // dispose: object with X, Y of the last line add to the PDF 
                //          this allow the insertion of new lines after html
                pdf.save('Test.pdf');
            }
            , margins);
        }

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
