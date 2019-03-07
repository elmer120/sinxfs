@extends("templates.template")
@section('tab_title',$tab_title) <!-- titolo tab come 2° parametro stringa o variabile -->
@section('page_title',$page_title) <!-- titolo pagina/sezione -->
@section('page_content')

  <!-- barra azioni -->
<button class="uk-button uk-button-primary uk-button-small" uk-toggle="target: #modal_aggiungi" type="button" >Aggiungi</button>
<button id="btn_modifica" class="uk-button uk-button-primary uk-button-small" uk-toggle="target: #modal_aggiungi" type="button" disabled>Modifica</button>
<button id="btn_elimina" class="uk-button uk-button-primary uk-button-small" disabled>Elimina</button>
<div class="uk-form-custom uk-search uk-search-default">
	<a href="#" id="a_search" class="uk-search-icon-flip uk-search-icon uk-icon" uk-search-icon=""></a>
	<input id="input_search" class="uk-search-input" type="search" name="text_search" value="" placeholder="Cerca...">
</div>

@component('components.modal',
	[
	'modal_id' => 'modal_aggiungi',
	'title' => "Aggiungi persona/socio",
	'btn_text' => 'Inserisci'
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
//---- EVENTI -----
//alla selezione di un riga
function row_selected(row)
{
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
function row_selection_changed(data, rows)
{
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
	}
});
$('#carica_direttivo_checkbox').on('click',function(){
	if(this.checked) //se checkbox carica direttivo è abilitato
	{
		$( "select[name='fk_cariche_direttivo']" ).attr('disabled',false);
		$( "input[name='carica_direttivo_dal']" ).attr('disabled',false);
		$( "input[name='carica_direttivo_al']" ).attr('disabled',false);
	}
	else{
		//disabilito gli input di carica direttivo e faccio clear dei valori
		$( "select[name='fk_cariche_direttivo']" ).attr('disabled',true);
		$( "select[name='fk_cariche_direttivo']" ).val('');
		$( "input[name='carica_direttivo_dal']" ).attr('disabled',true);
		$( "input[name='carica_direttivo_dal']" ).val('');
		$( "input[name='carica_direttivo_al']" ).attr('disabled',true);
		$( "input[name='carica_direttivo_al']" ).val('');
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
}
});
$('#btn_modifica').on('click',function()
{
	//popolo il select tipo associato
	get_soci_tipologie('#select_tipo_mod');
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
//all submit del form aggiungi
$('#form_aggiungi').on('submit',function(e){
	e.preventDefault();
	submit_aggiungi();
})
//all submit del form modifica
$('#form_modifica').on('submit',function(e){
	e.preventDefault();
	submit_modifica();
})
//alla selezione della provincia di nascita carico i corrispondenti comuni
$('#select_province_nascita').on('change',function(){
	$('#select_comuni_nascita').html('<option value="" disabled selected>Scegli il comune di nascita</option>');
	get_comuni(this.value,'#select_comuni_nascita');
});
//alla selezione della provincia di residenza carico i corrispondenti comuni
$('#select_province').on('change',function(){
	$('#select_comuni').html('<option value="" disabled selected>Scegli il comune</option>');
	get_comuni(this.value,'#select_comuni');
});
//alla selezione della regione di residenza carico le corrispondenti province
$('#select_regioni').on('change',function(){
	$('#select_province').html('<option value="" disabled selected>Scegli la provincia</option>');
	$('#select_comuni').html('<option value="" disabled selected>Scegli il comune</option>');
	get_province(this.value,'#select_province');
	
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
//console.log(id_select);
            $.ajax({
                url: 'comuni',
                data: {"provincia_select" : id_select},
                success: function(data){
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
									$('input[name=nome]').val(persona.nome);
									$('input[name=cognome]').val(persona.cognome);
									$('input[name=data_nascita]').val(persona.data_nascita);
									//nascita
									setTimeout(function(){$('#select_province_nascita').val(persona.fk_provincia_nascita).change();},500);
									setTimeout(function(){$('#select_comuni_nascita').val(persona.fk_comuni_nascita);},1000);
									$('input[name=codice_fiscale]').val(persona.codice_fiscale);
									$('input[name=partita_iva]').val(persona.partita_iva);
									//residenza
									setTimeout(function(){$('#select_regioni').val(persona.fk_regioni).change();},500);
									setTimeout(function(){$('#select_province').val(persona.fk_province).change();},1000);
									setTimeout(function(){$('#select_comuni').val(persona.fk_comuni);},2000);
									$('input[name=indirizzo]').val(persona.indirizzo);
									//$('input[name=privacy]').val(persona.nome);
									$('input[name=telefono]').val(persona.telefono);
									$('input[name=telefono_ext]').val(persona.telefono_ext);
									$('input[name=email]').val(persona.email);
									$('input[name=iban]').val(persona.iban);
									$('input[name=banca]').val(persona.banca);
									$('textarea[name=note]').val(persona.note)
									//--socio
									if(persona.fk_soci_tipologie != null)
									{
										$('input[name=socio]')[0].checked = true;
										$('#select_tipo').val(persona.fk_soci_tipologie);
										$('input[name=richiesta_data]').val(persona.richiesta_data);
										$('input[name=approvazione_data]').val(persona.approvazione_data);
										$('input[name=scadenza_data]').val(persona.scadenza_data);
										$('input[name=certificato_scadenza_al]').val(persona.certificato_scadenza_al);
									}
									//--carica direttivo
									if(persona.fk_cariche_direttivo != null)
									{
										$('input[name=carica_direttivo]')[0].checked = true;
										$('#select_carica').val(persona.fk_cariche_direttivo);
										$('input[name=carica_direttivo_dal]').val(persona.carica_direttivo_dal);
										$('input[name=carica_direttivo_al]').val(persona.carica_direttivo_al);
									}
									//--tessera
									if(persona.numero != null)
									{
										$('input[name=tessere]')[0].checked = true;
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
//chiamata ajax per l'invio del form aggiungi
function submit_aggiungi()
{
	//recupero i valori del form
	var data = $('#form_aggiungi').serialize();
	console.log(data); //x debug
   $.ajax({
			 url: "create",
			 data: data,
          success: function(data){
								//dopo l'inserimento rimuovo i danger
								$(":input").removeClass('uk-form-danger');
								//pulisco gli input del form
								$('#form_aggiungi').find("input[type=text], textarea").val("");
								//metto a default i checkbox
								$('input[name=socio]')[0].checked = $('input[name=socio]')[0].defaultChecked;
								$('input[name=carica_direttivo]')[0].checked = $('input[name=carica_direttivo]')[0].defaultChecked
								$('input[name=tessere]')[0].checked = $('input[name=tessere]')[0].defaultChecked
								UIkit.notification({
											message: data,
											status: '',
											pos: 'bottom-center',
											timeout: 3000
										});

					setTimeout(() => {
						UIkit.modal($('#modal_aggiungi')).hide();
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
