@extends("templates.stampa")
@section('tab_title',$tab_title) <!-- titolo tab come 2° parametro stringa o variabile -->
@section('page_title',$page_title) <!-- titolo pagina/sezione -->
@section('page_content')

<!-- tabella-->
<img class="uk-height-1-1" src="{{ asset('storage/images/logo.png') }}" style="width: 75px" alt="Sinxfs"/>
<button type="button" class="uk-button uk-button-primary" onclick="stampa()">
        Print JSON Data
     </button>

     


<div id="table"></div>
<!-- includo script e librerie -->
<script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>

<script>
var jsonLista =  <?php echo $lista; ?>;
function stampa(){
printJS({
    printable: jsonLista, 
    properties: [
            { field:'nome', displayName:'Nome'},
            { field:'cognome', displayName:'Cognome'},
            { field:'indirizzo', displayName:'Indirizzo'},
            { field:'data_nascita', displayName:'Data nascita'},
            { field:'comune_nascita', displayName:'Comune nascita'},
            { field:'comune_residenza', displayName:'Comune residenza'},
            { field:'provincia_sigla_residenza',displayName:'Provincia residenza'},
            { field:'codice_fiscale', displayName:'Cod.fiscale'},
            { field:'email', displayName:'Email'},
            { field:'telefono', displayName:'Tel.'},
            { field:'approvazione_data', displayName:'Approvato'},
            { field:'soci_tipologia', displayName:'Tipo socio'},
            { field:'carica_direttivo', displayName:'Carica direttivo'}], 
    type: 'json',
    targetStyles:['*'],
    style: 'text-align:center;',
    header: '<span style="font-size: 2em; font-weight: bold;">{{ $associazione->nome }}</span><br><span>{{ $associazione->indirizzo }}, - {{ $associazione->cap }} {{ $associazione->comune }} {{ "(".$associazione->provincia_sigla.")" }} </span><br><span>{{ "Tel: ".$associazione->telefono }} - {{ "Tel: ".$associazione->telefono_ext }} - {{ "Email: ".$associazione->email }}</span><br><span>{{ "Cf: ".$associazione->codice_fiscale }} - {{ "Pi: ".$associazione->partita_iva }} </span></div></div><hr>',
    headerStyle: 'font-size: 1em;  font-weight: normal; text-align: center;',
    documentTitle: 'Libro soci',    
});


}
var table;
//al caricamento della pagina
$(document).ready(function(){
	//creo la tabella
	//create_table();
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

function create_table(){
 
    //definisco la tabella
table = new Tabulator("#table", {
   layout:"fitColumns", //colonne si restringono attorno ai dati, il restante spazio è vuoto ma sempre una "tabella"
   responsiveLayout:"collapse", //le colonne si impilano quando non c'è abb spazio
   placeholder:"No Data Available", //quando non ci sono dati
   //pagination:"local", //imposto la paginazione
   //paginationSize:20, //per ogni pagina mostro n righe
   selectable:0, //righe selezionabili
   tooltips:true,
    columns:[ //definisco le colonne
       //title = titolo , field = chiave array
       { title:"N°", width:"15",formatter:"rownum"},
       { title:"Nome", field:"nome"},
       { title:"Cognome", field:"cognome"},
       { title:"Indirizzo", field:"indirizzo"},
       { title:"Data nascita", field:"data_nascita"},
       { title:"Comune nascita", field:"comune_nascita"},
       { title:"Comune residenza", field:"comune_residenza"},
       { title:"Provincia residenza", field:"provincia_sigla_residenza"},
       { title:"Cod.fiscale", field:"codice_fiscale"},
       { title:"Email", field:"email"},
       { title:"Tel.", field:"telefono"},
       { title:"Approvato", field:"approvazione_data"},
       { title:"Tipo socio", field:"soci_tipologia"},
       { title:"Carica direttivo", field:"carica_direttivo"}
    ]
});

//carico i dati in tabella via ajax
var ajaxConfig = {
   method:"post", //set request type to Position
   headers: {
               'X-CSRF-Token': '{{ csrf_token() }}',
   },
};
table.setData( "{{ route('getListLibroSoci') }}", {}, ajaxConfig);
// variabile passata a view not trim table.setData( {//!! $lista !!} );
}

//trigger download of data.pdf file
$("#download-pdf").click(function(){
    table.download("pdf", "data.pdf", {
        orientation:"portrait", //set page orientation to portrait
        title:"Example Report", //add title to report
    });
});

</script>


@endsection