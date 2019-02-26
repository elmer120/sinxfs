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

<!-- tabella-->
<div id="table"></div>


<script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
<script>
function create_table(){
    //definisco la tabella
     table = new Tabulator("#table", {
        layout:"fitColumns", //colonne si restringono attorno ai dati, il restante spazio è vuoto ma sempre una "tabella"
        responsiveLayout:"collapse", //le colonne si impilano quando non c'è abb spazio
        placeholder:"No Data Available", //quando non ci sono dati
        pagination:"local", //imposto la paginazione
        paginationSize:10, //per ogni pagina mostro n righe
        selectable:1, //righe selezionabili
        //rowSelected:row_selected, //callback riga selezionata
        //rowDeselected:row_deselected, //callback riga deselezionata
        //rowSelectionChanged: row_selection_changed, //callback al cambio selezione riga
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
}
</script>

@endsection
