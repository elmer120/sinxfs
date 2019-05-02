@extends("templates.template")
@section('tab_title',$tab_title) <!-- titolo tab come 2° parametro stringa o variabile -->
@section('page_title',$page_title) <!-- titolo pagina/sezione -->
@section('page_content')

	<!-- barra azioni -->
	<div class="uk-placeholder uk-display-inline-block uk-background-default uk-margin-remove">
		<div class="uk-form-custom uk-search uk-search-default">
			<a href="#" id="a_search" class="uk-search-icon-flip uk-search-icon uk-icon" uk-search-icon=""></a>
			<input id="input_search" class="uk-search-input" type="search" name="text_search" value="" placeholder="Cerca...">
		</div>
	</div>

<!-- tabella-->
<div id="table"></div>
<script type="text/javascript" src="{{ URL::asset('js/table_form.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
<script>

//var globali
var token = '{{ csrf_token() }}';
var table;
var row_selected_id;
var columns_config = [ //definisco le colonne
		//title = titolo , field = chiave array
		{ title:"N°", width:"15",formatter:"rownum"},
		//{ title:"Azioni", width:110, resizable:false },
		{	//creo gruppo persona
			title: 'Persona',
			columns:[
			{ title:"Nome", field:"nome"},
			{ title:"Cognome", field:"cognome"},
            { title:"Indirizzo", field:"indirizzo"},
			{ title:"Comune", field:"comune_residenza"},
            { title:"Provincia", field:"provincia_sigla_residenza"},
            { title:"Email", field:"email"},
            { title:"Telefono", field:"telefono"},
            { title:"Telefono", field:"telefono_ext"},
            { title:"Cod.fiscale", field:"codice_fiscale"},
            { title:"Partita iva", field:"partita_iva"},
			{ title:"Data nascita", field:"data_nascita"},
			],
		},
		];


		//al caricamento della pagina
$(document).ready(function(){
	//creo la tabella
	create_table(columns_config);
	//carica i dati
	load_table( '{{ route('getListRubrica') }}',token);
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


</script>

@endsection