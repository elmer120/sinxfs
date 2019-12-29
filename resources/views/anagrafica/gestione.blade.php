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
	'title' => "Aggiungi persona/socio",
	'btn_text' => 'Inserisci'
]) 
	@component('components.forms.anagrafica_gestione')
	@endcomponent
@endcomponent

<!-- tabella-->
<div id="table"></div>

<a href="#" class="uk-float-right uk-display-inline-block"  uk-icon="icon: triangle-up; ratio: 4" uk-scroll></a>
<script type="text/javascript" src="{{ URL::asset('js/table_form.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
<script>


//var globali
var token = '{{ csrf_token() }}';
var table;
var row_selected_id;
var data_obj;
var columns_config = [ 
		//title = titolo , field = chiave array
		{ title:"N°",width:"15",formatter:"rownum"},
		//{ title:"Azioni", width:110, resizable:false },
		{	//creo gruppo persona
			title: 'Persona',
			columns:[
			{ title:"Nome", field:"nome", accessorDownload:notNull},
			{ title:"Cognome", field:"cognome", accessorDownload:notNull},
			{ title:"Comune nascita", field:"comune_nascita", accessorDownload:notNull},
			{ title:"Comune residenza", field:"comune_residenza", accessorDownload:notNull},
			{ title:"Data nascita", field:"data_nascita", accessorDownload:notNull},
			],
		},
		{ title:"Tipo socio", field:"soci_tipologia", accessorDownload:notNull},
		{ title:"Carica direttivo", field:"carica_direttivo", accessorDownload:notNull},
		{ title:"Tessera n°", field:"tessera_numero", accessorDownload:notNull},
		{ title:"Certificato scadenza", field:"certificato_scadenza_al", accessorDownload:notNull},
		{ title:"Approvato", field:"approvazione_data", accessorDownload:notNull},
		{ title:"Quota scadenza", field:"quota_scadenza", accessorDownload:notNull}];
		var associazione = {!! json_encode($associazione->toArray()) !!};


//al caricamento della pagina
$(document).ready(function(){
	//creo la tabella
	create_table(columns_config);
	//carica i dati
	load_table( '{{ route('getListAnagrafica') }}',token);
	//setto le impostazioni ajax comuni
	$.ajaxSetup({
		type: 'POST',
		cache: false,  
		headers: { 'X-CSRF-Token': token,}
	});
});
// ---- FUNZIONI ----

//---- EVENTI -----

//ricerca istantanea
$("#input_search").keyup(function(){
	search(this.value);
});

$('#socio_checkbox').on('click',function(){
	if(this.checked) //se checkbox socio è abilitato
	{

		console.log('socio_abilitato');
		//abilito i legend di socio
		$('#socio_legend').removeClass("uk-text-muted");
		$('#certificato_medico_legend').removeClass("uk-text-muted");
		//abilito i checkbox di carica direttivo e tessere
		$('#carica_direttivo_checkbox').attr('disabled',false);
		$('#tessere_checkbox').attr('disabled',false);
		//abilito gli input di soci
		$( "select[name='fk_soci_tipologie']" ).attr('disabled',false);
		$( "input[name='richiesta_data']" ).attr('disabled',false);
		$( "input[name='approvazione_data']" ).attr('disabled',false);
		$( "input[name='scadenza_data']" ).attr('disabled',false);
		$( "input[name='certificato_scadenza_al']" ).attr('disabled',false);
	}
	else{
		console.log('socio_disabilitato');
		//disabilito i legend di socio
		$('#socio_legend').addClass("uk-text-muted");
		$('#certificato_medico_legend').addClass("uk-text-muted");
		
		//se carica direttivo e tessere sono abilitati li disabilito
		if($('#carica_direttivo_checkbox')[0].checked)
		{$('#carica_direttivo_checkbox').trigger('click');} //simulo il click
		if($('#tessere_checkbox')[0].checked)
		{$('#tessere_checkbox').trigger('click');}
		
		//disabilito i checkbox di carica direttivo e tessere
		$('#carica_direttivo_checkbox').attr('disabled',true);
		$('#tessere_checkbox').attr('disabled',true);
		
		//disabilito gli input di soci e faccio clear dei valori
		$( "select[name='fk_soci_tipologie']" ).attr('disabled',true);
		$( "select[name='fk_soci_tipologie']" ).val('');
		$( "input[name='richiesta_data']" ).attr('disabled',true);
		$( "input[name='richiesta_data']" ).val('');
		$( "input[name='approvazione_data']" ).attr('disabled',true);
		$( "input[name='approvazione_data']" ).val('');
		$( "input[name='scadenza_data']" ).attr('disabled',true);
		$( "input[name='scadenza_data']" ).val('');
		$( "input[name='certificato_scadenza_al']" ).attr('disabled',true);
		$( "input[name='certificato_scadenza_al']" ).val('');
	}
});

$('#carica_direttivo_checkbox').on('click',function(){
	if(this.checked) //se checkbox carica direttivo è abilitato
	{
		console.log('carica_abilitato');
		$( "select[name='fk_cariche_direttivo']" ).attr('disabled',false);
		$( "input[name='carica_direttivo_dal']" ).attr('disabled',false);
		$( "input[name='carica_direttivo_al']" ).attr('disabled',false);
	}
	else{
		console.log('carica_disabilitato');
		//disabilito gli input di carica direttivo e faccio clear dei valori
		$( "select[name='fk_cariche_direttivo']" ).attr('disabled',true);
		$( "select[name='fk_cariche_direttivo']" ).val('');
		$( "input[name='carica_direttivo_dal']" ).attr('disabled',true);
		$( "input[name='carica_direttivo_dal']" ).val('');
		$( "input[name='carica_direttivo_al']" ).attr('disabled',true);
		$( "input[name='carica_direttivo_al']" ).val('');
		//rimuovo il campo nascosto di id
		/*$('#soci_cariche_direttivo_id').remove();*/
	}
});

$('#tessere_checkbox').on('click',function(){
if(this.checked)//se checkbox tessere è abilitato
{
	console.log('tessere_abilitato');
	//abilito gli input di tessere
	$( "input[name='numero']" ).attr('disabled',false);
	$( "input[name='tessere_dal']" ).attr('disabled',false);
	$( "input[name='tessere_al']" ).attr('disabled',false);
	$( "input[name='tessere_tipo']" ).attr('disabled',false);
}
else{
	console.log('tessere_disabilitato');
	//disabilito gli input di tessere e faccio clear dei valori
	$( "input[name='numero']" ).attr('disabled',true);
	$( "input[name='numero']" ).val('');
	$( "input[name='tessere_dal']" ).attr('disabled',true);
	$( "input[name='tessere_dal']" ).val('');
	$( "input[name='tessere_al']" ).attr('disabled',true);
	$( "input[name='tessere_al']" ).val('');
	$( "input[name='tessere_tipo']" ).attr('disabled',true);
	$( "input[name='tessere_tipo']" ).val('');
	//rimuovo il campo nascosto di id
	/*$('#tessere_id').remove(); */
}
});

$('#privacy_checkbox').on('click',function(e){
	if(this.checked)
	{
		$('#privacy_hidden').val('1');
	}
	else
	{
		$('#privacy_hidden').val('0');
	}
});

$('#btn_visualizza').on('click',function (){
	if (row_selected_id > 0)
	{
		$('#title').text('Visualizza persona');
		//popolo il select tipo associato
		get_options('#select_tipo','sociTipologie','*Tipo associato...','nome');
		//popolo il select carica direttivo
		get_options('#select_carica','caricheDirettivo','*Carica direttivo','nome');
		//popolo il select responsabile
		get_options('#select_responsabile','responsabili','Responsabile..','nome','cognome');
		//popolo il select regioni con tutte
		get_options('#select_regioni','regioni','Scegli la regione','nome');
		//popolo il select province di nascita con tutte
		get_options('#select_province_nascita','province','Scegli la provincia','nome');
		//popolo la persona
		get_persona(row_selected_id,true);
	}
	else{
		console.error("Id selezionato non valido! id:"+row_selected_id);
	}
});

$('#btn_aggiungi').on('click',function(){
	form_reset();
	$('#title').text('Aggiungi persona');
	//popolo il select regioni con tutte
	get_options('#select_regioni','regioni','Scegli la regione','nome');
	//popolo il select province di nascita con tutte
	get_options('#select_province_nascita','province','Scegli la provincia','nome');
	//popolo il select tipo associato
	get_options('#select_tipo','sociTipologie','*Tipo associato...','nome');
	//popolo il select carica direttivo
	get_options('#select_carica','caricheDirettivo','*Carica direttivo','nome');
	//popolo il select responsabile
	get_options('#select_responsabile','responsabili','Responsabile..','nome','cognome');
});

$('#btn_modifica').on('click',function()
{
	$('#title').text('Modifica persona');
	//popolo il select tipo associato
	get_options('#select_tipo','sociTipologie','*Tipo associato...','nome');
	//popolo il select carica direttivo
	get_options('#select_carica','caricheDirettivo','*Carica direttivo','nome');
	//popolo il select responsabile
	get_options('#select_responsabile','responsabili','Responsabile..','nome','cognome');
	//popolo il select regioni con tutte
	get_options('#select_regioni','regioni','Scegli la regione','nome');
	//popolo il select province di nascita con tutte
	get_options('#select_province_nascita','province','Scegli la provincia','nome');
	//popolo la persona
	get_persona(row_selected_id,false);

});

$('#btn_elimina').on('click',function()
{
	UIkit.modal.confirm('Eliminare il record selezionato?').then(
		function() {
		remove(row_selected_id,'deletePerson');
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
	    table.download("pdf", "Anagrafica"+data+".pdf", {
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
                    doc.text("Anagrafica",(width/2)-50,20,);
                
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

$('#btn_annulla').on('click',function (e) {
	form_read_only(false);
	checkbox_default()
	form_reset();
	//metto a null la var globale persona
	persona = null;
})

$('#btn_stampa').on('click',function(){});

//all submit del form
$('#form').on('submit',function(e){
	e.preventDefault(); //blocco il comportamento di default
	if($('#persona_id').length) //se l'elemento esiste sono in modifica
	{
		submit('PUT');
	}
	else{
		submit('POST');
	}

})

//alla selezione della provincia di nascita carico i corrispondenti comuni
$('#select_province_nascita').on('change',function(){
	var tmp = {"provincia_select" : this.value};
	get_options('#select_comuni_nascita','comuni','Scegli il comune','nome',null,tmp);
});
//alla selezione della regione di residenza carico le corrispondenti province
$('#select_regioni').on('change',function(){
	var tmp = {"region_select" : this.value}
	get_options('#select_province','province','Scegli la provincia','nome',null,tmp);
});
//alla selezione della provincia di residenza carico i corrispondenti comuni
$('#select_province').on('change',function(){
	var tmp = {"provincia_select" : this.value};
	get_options('#select_comuni','comuni','Scegli il comune','nome',null,tmp);
});

function checkbox_default()
{
	//metto a default i checkbox
	console.info("checkbox default!");
	if($('#privacy_checkbox')[0].checked){
	$('#privacy_checkbox').click();}
	if($('input[name=socio]')[0].checked){
	$('#socio_checkbox')[0].click();}
	if($('input[name=carica_direttivo]')[0].checked)
	{$('#carica_direttivo_checkbox')[0].click();}
	if($('input[name=tessere]')[0].checked)
	{$('#tessere_checkbox')[0].click();}
}

//chiamata ajax per popolare il modifica
function get_persona(id,solaLettura)
{
	$.ajax({
             url: 'getPerson',
             data: {"id" : id},
             success: function(data){
									console.log(data); 
									persona = JSON.parse(data)[0];
									//--persona
									//aggiungo l'id persona
									$('#form').append('<input id="persona_id" type="hidden" name="persona_id" value="'+persona.id+'">');
									$('input[name=nome]').val(persona.nome);
									$('input[name=cognome]').val(persona.cognome);
									$('input[name=data_nascita]').val(persona.data_nascita);
									//nascita
									setTimeout(function(){$('#select_province_nascita').val(persona.fk_provincia_nascita).change();},250);
									setTimeout(function(){$('#select_comuni_nascita').val(persona.fk_comuni_nascita);},500);
									$('input[name=codice_fiscale]').val(persona.codice_fiscale);
									$('input[name=partita_iva]').val(persona.partita_iva);
									//residenza
									setTimeout(function(){$('#select_regioni').val(persona.fk_regioni).change();},750);
									setTimeout(function(){$('#select_province').val(persona.fk_province).change();},1000);
									setTimeout(function(){$('#select_comuni').val(persona.fk_comuni);},1250);
									$('input[name=indirizzo]').val(persona.indirizzo);
									if(persona.privacy){ $('#privacy_checkbox')[0].click();}
									$('input[name=telefono]').val(persona.telefono);
									$('input[name=telefono_ext]').val(persona.telefono_ext);
									$('input[name=email]').val(persona.email);
									$('input[name=iban]').val(persona.iban);
									$('input[name=banca]').val(persona.banca);
									$('textarea[name=note]').val(persona.note)

									//--socio
									if(persona.socio_id != null)
									{
										//aggiungo l'id socio
										$('#form').append('<input id="socio_id" type="hidden" name="socio_id" value="'+((persona.socio_id==null) ? "": persona.socio_id)+'">');
										$('input[name=socio]')[0].click();
										$('#select_tipo').val(persona.fk_soci_tipologie);
										$('input[name=richiesta_data]').val(persona.richiesta_data);
										$('input[name=approvazione_data]').val(persona.approvazione_data);
										$('input[name=scadenza_data]').val(persona.scadenza_data);
										$('input[name=certificato_scadenza_al]').val(persona.certificato_scadenza_al);
									}
									//--carica direttivo
									if(persona.soci_cariche_direttivo_id != null)
									{
										//aggiungo l'id soci_cariche_direttivo
										$('#form').append('<input id="soci_cariche_direttivo_id" type="hidden" name="soci_cariche_direttivo_id" value="'+((persona.soci_cariche_direttivo_id==null) ? "": persona.soci_cariche_direttivo_id)+'">');
										$('input[name=carica_direttivo]')[0].click();
										$('#select_carica').val(persona.fk_cariche_direttivo);
										$('input[name=carica_direttivo_dal]').val(persona.carica_direttivo_dal);
										$('input[name=carica_direttivo_al]').val(persona.carica_direttivo_al);
									}
									//--tessera
									if(persona.tessere_id != null)
									{
										//aggiungo l'id tessera
										$('#form').append('<input id="tessere_id" type="hidden" name="tessere_id" value="'+((persona.tessere_id==null) ? "": persona.tessere_id)+'">');
										$('input[name=tessere]')[0].click();
										$('input[name=numero]').val(persona.numero);
										$('input[name=tessere_dal]').val(persona.tessere_dal);
										$('input[name=tessere_al]').val(persona.tessere_al);
										$('input[name=tessere_tipo]').val(persona.tessere_tipo);
									}
									if (solaLettura)
									{
										form_read_only(solaLettura);
									}
					
				},
             error: function(data) { 
                  alert("get_persona: Errore nella chiamata ajax!");
             }
        });
}
//chiamata ajax per l'invio del form
function submit(method)
{
	//recupero i valori del form
	var data = $('#form').serialize();
	console.debug(data); //x debug
	 $.ajax({
		 	method: method,
			 url: 'create',
			 data: data,
          success: function(data){
			  					data = JSON.parse(data);
								//metto a default il form
								form_reset();
								//metto a null la var globale persona
								persona = null;
								//stampo messaggio 
								UIkit.notification({
											message: data.risultato.messaggio,
											status: '',
											pos: 'bottom-center',
											timeout: 3000
										});
					//chiudo il modal
					setTimeout(() => {
						UIkit.modal($('#modal')).hide();
						//aggiorno i dati in tabella
						table.setData();	
						setTimeout(
							()=>{
							//vado alla pagina dove c'è la nuova riga
							table.setPageToRow(data.persona.id);
							//seleziono la nuova riga
							table.selectRow(data.persona.id);
							},500);
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

//-- CHIAMATE AJAX ------
//chiamata ajax per popolare il select delle regioni
/*
function get_regioni(id_element) {
    $.ajax({
        url: 'regioni',
        data: '',
        success: function(data){
					$(id_element).html('<option value="" disabled selected>Scegli la regione</option>');
          for (let i = 0; i < data.length; i++) {
            var id = data[i].id;
            var name = data[i].nome;
            var option = "<option value='"+id+"'>"+name+"</option>"; 
            $(id_element).append(option);
          }
        },
        error: function(data) { 
             alert(" Regioni: Errore nella chiamata ajax!");
        }
   });
}
//chiamata ajax per popolare il select delle provincie
function get_province(id_select,id_element) {
	//console.log(id_select);
          $.ajax({
             url: 'province',
              data: {"region_select" : id_select},
              success: function(data){
									$(id_element).html('<option value="" disabled selected>Scegli la provincia</option>');
                  //popolo le province
                  for (let i = 0; i < data.length; i++) {
                    var id = data[i].id;
                    var name = data[i].nome;
                    var option = "<option value='"+id+"'>"+name+"</option>"; 
                    $(id_element).append(option);
                  }
              },
              error: function(data) { 
                alert("Province: Errore nella chiamata ajax!");
              }
         });
}
 //chiamata ajax per popolare il select dei comuni
function get_comuni(id_select,id_element){
            $.ajax({
                url: 'comuni',
                data: {"provincia_select" : id_select},
                success: function(data){
									$(id_element).html('<option value="" disabled selected>Scegli il comune</option>');
                  //popolo i comuni
                  for (let i = 0; i < data.length; i++) {
                    var id = data[i].id;
                    var name = data[i].nome;
                    var option = "<option value='"+id+"'>"+name+"</option>"; 
                    $(id_element).append(option);
                  }
                },
                error: function(data) { 
                    alert("Comuni: Errore nella chiamata ajax!");
                }
           });
}
//chiamata ajax per popolare il select tipo
function get_soci_tipologie(id_element){
	$.ajax({
                type: 'POST',
                url: 'sociTipologie',
                data: '',
                success: function(data){
									$(id_element).html('<option value="">*Tipo associato...</option>');
                  //popolo la select tipologia soci
                  for (let i = 0; i < data.length; i++) {
                    var id = data[i].id;
                    var name = data[i].nome;
                    var option = "<option value='"+id+"'>"+name+"</option>"; 
                    $(id_element).append(option);
                  }
                },
                error: function(data) { 
                     alert("SociTipologie: Errore nella chiamata ajax!");
                }
           });
}
//chiamata ajax per popolare il select carica direttivo
function get_cariche_direttivo(id_element) {
         $.ajax({
             type: 'POST',
             url: 'caricheDirettivo',
             data: '',
             success: function(data){
							$(id_element).html('<option value="">*Carica direttivo</option>');
              //popolo la select carica direttivo
							for (let i = 0; i < data.length; i++) {
                    var id = data[i].id;
                    var name = data[i].nome;
                    var option = "<option value='"+id+"'>"+name+"</option>"; 
                    $(id_element).append(option);
                  }
             },
             error: function(data) { 
                  alert("CaricheDirettivo: Errore nella chiamata ajax!");
             }
        });
}
//chiamata ajax per popolare il select responsabile
function get_responsabili(id_element) {
         $.ajax({
             type: 'POST',
             url: 'responsabili',
             data: '',
             success: function(data){
							 $(id_element).html('<option value="" selected>Responsabile..</option>');
              //popolo la select responsabili
							for (let i = 0; i < data.length; i++) {
                    var id = data[i].id;
                    var name = data[i].nome;
										var cognome = data[i].cognome;
                    var option = "<option value='"+id+"'>"+name+' '+cognome+"</option>"; 
                    $(id_element).append(option);
                  }
             },
             error: function(data) { 
                  alert("Tipi.js: Errore nella chiamata ajax!");
             }
        });
}
*/
</script>

@endsection
