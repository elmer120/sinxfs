@extends("templates.template")
@section('tab_title',$tab_title) <!-- titolo tab come 2° parametro stringa o variabile -->
@section('page_title',$page_title) <!-- titolo pagina/sezione -->
@section('page_content')

  <!-- barra azioni -->
<button class="uk-button uk-button-primary uk-button-small" uk-toggle="target: #modal" type="button" >Aggiungi</button>
<button id="btn_modifica" class="uk-button uk-button-primary uk-button-small" uk-toggle="target: #modal" type="button" disabled>Modifica</button>
<button id="btn_elimina" class="uk-button uk-button-primary uk-button-small" disabled>Elimina</button>
<div class="uk-form-custom uk-search uk-search-default">
	<a href="#" id="a_search" class="uk-search-icon-flip uk-search-icon uk-icon" uk-search-icon=""></a>
	<input id="input_search" class="uk-search-input" type="search" name="text_search" value="" placeholder="Cerca...">
</div>

@component('components.modal',
	[
	'modal_id' => 'modal',
	'form_id' => 'form_persona',
	'title' => "Aggiungi persona/socio",
	'btn_text' => 'Inserisci',
	'select_province_nascita_id' => 'select_province_nascita',
	'select_comuni_nascita_id' => 'select_comuni_nascita',
	'select_regioni_id' => 'select_regioni',
	'select_province_id' => 'select_province',
	'select_comuni_id' => 'select_comuni',
	'select_responsabile_id' => 'select_responsabile',
	'select_tipo_id' => 'select_tipo',
	'select_carica_id' => 'select_carica'
	]
) 
@endcomponent

<!-- tabella-->
<div id="table"></div>


<script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
<script>

//al cambio nella select filtro i dati in tabella
$('#select_type').on('change', function() {
	if(this.value!="T")
	{ table.setFilter("type","=",this.value);}
	else{
	  table.clearFilter();
	}
});
//al click su cerca
var last_value_search;
$('#a_search').on('click', function() {
	if(typeof last_value_search !== 'undefined')
	{
		table.removeFilter("name", "=", last_value_search);
	}
	table.addFilter("name","like",$('#input_search').val());
	last_value_search = $('#input_search').val();
});
//al caricamento della pagina
$(document).ready(function(){
	//creo la tabella
	create_table();
	//setto le impostazioni ajax comuni
	$.ajaxSetup({
		type: 'POST',
    cache: false,  
    headers: {
    'X-CSRF-Token': '{{ csrf_token() }}',
     }
		//dataType: 'text', //Tipo di dato che si riceve di ritorno
    //contentType : 'application/json', //tipo di contenuto inviato al serve
	});
	//popolo il select regioni con tutte
	get_regioni('#select_regioni');
	//popolo il select province di nascita con tutte
	get_province(null,'#select_province_nascita');
	//popolo il select tipo associato
	get_soci_tipologie('#select_tipo');
	//popolo il select carica direttivo
	get_cariche_direttivo('#select_carica');
	//popolo il select responsabile
	get_responsabili('#select_responsabile');
	
});
// ---- FUNZIONI ----
var table;
var row_selected_id;

function create_table(){
 
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
 	columns:[ //definisco le colonne
		//title = titolo , field = chiave array
		{ title:"#", formatter:"rownum"},
		{ title:"Azioni", width:110, resizable:false },
		{	//creo gruppo persona
			title: 'Persona',
			columns:[
			{ title:"Nome", field:"nome"},
			{ title:"Cognome", field:"cognome"},
			{ title:"Comune nascita", field:"comune_nascita"},
			{ title:"Comune residenza", field:"comune_residenza"},
			{ title:"Data nascita", field:"data_nascita"},
			],
		},
		{ title:"Tipo socio", field:"soci_tipologia"},
		{ title:"Carica direttivo", field:"carica_direttivo"},
		{ title:"Tessera n°", field:"tessera_numero"},
		{ title:"Certificato scadenza", field:"certificato_scadenza_al"},
		{ title:"Approvato", field:"approvazione_data"},
		{ title:"Quota scadenza", field:"quota_scadenza"}]
});
//carico i dati in tabella via ajax
var ajaxConfig = {
    method:"post", //set request type to Position
    headers: {
				'X-CSRF-Token': '{{ csrf_token() }}',
    },
};
table.setData( "{{ route('getList') }}", {}, ajaxConfig);
// variabile passata a view not trim table.setData( {//!! $lista !!} );
}

function form_reset() {
	//pulisco gli input del form
	$('#form_persona').find(":input, textarea").val("");
	//rimuovo gli eventuali campi nascosti degli id
	$('#persona_id').remove();
	$('#socio_id').remove();
	$('#soci_cariche_direttivo_id').remove();
	$('#tessere_id').remove(); 
	//rimuovo i danger
	$(":input").removeClass('uk-form-danger');
	//metto a default i checkbox
	if($('#privacy_checkbox')[0].checked){
	$('#privacy_checkbox').click();}
	if($('input[name=socio]')[0].checked){
	$('input[name=socio]')[0].click();}
	if($('input[name=carica_direttivo]')[0].checked)
	{$('input[name=carica_direttivo]')[0].click();}
	if($('input[name=tessere]')[0].checked)
	{$('input[name=tessere]')[0].click();}
	console.log('Reset form ok');														
}

//---- EVENTI -----
//alla selezione di un riga
function row_selected(row){
	//recupero l'id (del database)
	row_selected_id = row.getData()['id'];
	if(row_selected_id != null)
	{	//abilito i pulsanti
		$('#btn_modifica').attr('disabled',false);
		$('#btn_elimina').attr('disabled',false);
	}
};
// alla deselezione metto a null l'id precedente
function row_deselected(row){
	row_selected_id = null;
	//disabilito i pulsanti
	$('#btn_modifica').attr('disabled',true);
	$('#btn_elimina').attr('disabled',true);
}
function row_selection_changed(data, rows){
	if(data.length > 0)
	{
		row_selected_id = data[0].id;
		//abilito i pulsanti
		$('#btn_modifica').attr('disabled',false);
		$('#btn_elimina').attr('disabled',false);
	}
}

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
		//se sono in modifica
		if(persona != null)
		{	//aggiungo gli id nascosti
			$('#form_persona').append('<input id="socio_id" type="hidden" name="socio_id" value="'+persona.socio_id+'">');
			$('#form_persona').append('<input id="soci_cariche_direttivo_id" type="hidden" name="soci_cariche_direttivo_id" value="'+persona.soci_cariche_direttivo_id+'">');
			$('#form_persona').append('<input id="tessere_id" type="hidden" name="tessere_id" value="'+persona.tessere_id+'">');
			console.log('campi nascosti eliminati');
		}
	}
	else{
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

		//rimuovo gli i campi nascosti di id
		$('#socio_id').remove();
		$('#soci_cariche_direttivo_id').remove();
		$('#tessere_id').remove(); 
	}
});
$('#carica_direttivo_checkbox').on('click',function(){
	if(this.checked) //se checkbox carica direttivo è abilitato
	{
		$( "select[name='fk_cariche_direttivo']" ).attr('disabled',false);
		$( "input[name='carica_direttivo_dal']" ).attr('disabled',false);
		$( "input[name='carica_direttivo_al']" ).attr('disabled',false);
		//se sono in modifica
		if(persona!=null)
		{	//aggiungo gli id nascosti
			$('#form_persona').append('<input id="soci_cariche_direttivo_id" type="hidden" name="soci_cariche_direttivo_id" value="'+persona.soci_cariche_direttivo_id+'">');
		}
	}
	else{
		//disabilito gli input di carica direttivo e faccio clear dei valori
		$( "select[name='fk_cariche_direttivo']" ).attr('disabled',true);
		$( "select[name='fk_cariche_direttivo']" ).val('');
		$( "input[name='carica_direttivo_dal']" ).attr('disabled',true);
		$( "input[name='carica_direttivo_dal']" ).val('');
		$( "input[name='carica_direttivo_al']" ).attr('disabled',true);
		$( "input[name='carica_direttivo_al']" ).val('');
		//rimuovo il campo nascosto di id
		$('#soci_cariche_direttivo_id').remove();
	}
});

$('#tessere_checkbox').on('click',function(){
if(this.checked)//se checkbox tessere è abilitato
{
	//abilito gli input di tessere
	$( "input[name='numero']" ).attr('disabled',false);
	$( "input[name='tessere_dal']" ).attr('disabled',false);
	$( "input[name='tessere_al']" ).attr('disabled',false);
	$( "input[name='tessere_tipo']" ).attr('disabled',false);
	//se sono in modifica
	if(persona!=null)
	{	//aggiungo gli id nascosti
			$('#form_persona').append('<input id="tessere_id" type="hidden" name="tessere_id" value="'+persona.tessere_id+'">');
	}
}
else{
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
	$('#tessere_id').remove(); 
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
$('#btn_aggiungi').on('click',function(){
	$('#title').text('Aggiungi persona');
});
$('#btn_modifica').on('click',function()
{
	$('#title').text('Modifica persona');
	//popolo il select tipo associato
	get_soci_tipologie('#select_tipo');
	//popolo il select carica direttivo
	get_cariche_direttivo('#select_carica');
	//popolo il select responsabile
	get_responsabili('#select_responsabile');
	//popolo il select regioni con tutte
	get_regioni('#select_regioni');
	//popolo il select province di nascita con tutte
	get_province(null,'#select_province_nascita');
	//popolo la persona
	get_persona(row_selected_id);

});
//all submit del form
$('#form_persona').on('submit',function(e){
	e.preventDefault(); //blocco il comportamento di default
	if($('#persona_id').length) //se l'elemento esiste sono in modifica
	{
		submit('PUT');
	}
	else{
		submit('POST');
	}

})

$('#btn_annulla').on('click',function (e) {
	form_reset();
	//metto a null la var globale persona
	persona = null;
})
//alla selezione della provincia di nascita carico i corrispondenti comuni
$('#select_province_nascita').on('change',function(){
	get_comuni(this.value,'#select_comuni_nascita');
});
//alla selezione della regione di residenza carico le corrispondenti province
$('#select_regioni').on('change',function(){
	get_province(this.value,'#select_province');
});
//alla selezione della provincia di residenza carico i corrispondenti comuni
$('#select_province').on('change',function(){
	get_comuni(this.value,'#select_comuni');
});

//-- CHIAMATE AJAX ------
//chiamata ajax per popolare il select delle regioni
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
//chiamata ajax per popolare il modifica
function get_persona(id)
{
	$.ajax({
             url: 'getPerson',
             data: {"id" : id},
             success: function(data){
									console.log(data); 
									persona = JSON.parse(data)[0];
									//--persona
									//aggiungo l'id persona
									$('#form_persona').append('<input id="persona_id" type="hidden" name="persona_id" value="'+persona.id+'">');
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
										$('#form_persona').append('<input id="socio_id" type="hidden" name="socio_id" value="'+persona.socio_id+'">');
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
										$('#form_persona').append('<input id="soci_cariche_direttivo_id" type="hidden" name="soci_cariche_direttivo_id" value="'+persona.soci_cariche_direttivo_id+'">');
										$('input[name=carica_direttivo]')[0].click();
										$('#select_carica').val(persona.fk_cariche_direttivo);
										$('input[name=carica_direttivo_dal]').val(persona.carica_direttivo_dal);
										$('input[name=carica_direttivo_al]').val(persona.carica_direttivo_al);
									}
									//--tessera
									if(persona.tessere_id != null)
									{
										//aggiungo l'id tessera
										$('#form_persona').append('<input id="tessere_id" type="hidden" name="tessere_id" value="'+persona.tessere_id+'">');
										$('input[name=tessere]')[0].click();
										$('input[name=numero]').val(persona.numero);
										$('input[name=tessere_dal]').val(persona.tessere_dal);
										$('input[name=tessere_al]').val(persona.tessere_al);
										$('input[name=tessere_tipo]').val(persona.tessere_tipo);
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
	var data = $('#form_persona').serialize();
	console.log(data); //x debug
	 $.ajax({
		 	method: method,
			 url: 'create',
			 data: data,
          success: function(data){
								//metto a default il form
								form_reset();
								//metto a null la var globale persona
								persona = null;
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
