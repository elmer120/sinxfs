@extends("templates.template")
@section('tab_title',$tab_title) <!-- titolo tab come 2° parametro stringa o variabile -->
@section('page_title',$page_title) <!-- titolo pagina/sezione -->
@section('page_content')

  <!-- barra azioni -->
<div class="uk-form-custom uk-search uk-search-default">
	<a href="#" id="a_search" class="uk-search-icon-flip uk-search-icon uk-icon" uk-search-icon=""></a>
	<input id="input_search" class="uk-search-input" type="search" name="text_search" value="" placeholder="Cerca...">
</div>


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
		]
});
//carico i dati in tabella via ajax
var ajaxConfig = {
    method:"post", //set request type to Position
    headers: {
				'X-CSRF-Token': '{{ csrf_token() }}',
    },
};
table.setData( "{{ route('getListRubrica') }}", {}, ajaxConfig);
// variabile passata a view not trim table.setData( {//!! $lista !!} );
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

</script>

@endsection
