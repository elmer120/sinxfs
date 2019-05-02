@extends("templates.template")
@section('tab_title',$tab_title) <!-- titolo tab come 2° parametro stringa o variabile -->
@section('page_title',$page_title) <!-- titolo pagina/sezione -->
@section('page_content')
@component('components.actions_bar')		
@endcomponent
    
<!-- tabella-->
<div id="table"></div>
    

        <pre>												
                Art. 15 
        Libri sociali obbligatori

        1. Oltre le scritture prescritte negli articoli 13, 14 e 17, comma 1, gli enti del Terzo settore devono tenere: 
        a) il libro degli associati o aderenti; 
        b) il libro delle adunanze e delle deliberazioni delle assemblee, in cui devono essere trascritti anche i verbali redatti per atto pubblico; 
        c) il libro delle adunanze e delle deliberazioni dell'organo di amministrazione, dell'organo di controllo, e di eventuali altri organi sociali. 
        2. I libri di cui alle lettere a) e b) del comma 1, sono tenuti a cura dell'organo di amministrazione. 
        I libri di cui alla lettera c) del comma 1, sono tenuti a cura dell'organo cui si riferiscono. 
        3. Gli associati o gli aderenti hanno diritto di esaminare i libri sociali, secondo le modalita' previste dall'atto costitutivo o dallo statuto. 
        4. Il comma 3 non si applica agli enti di cui all'articolo 4, comma 3.
        </pre>



<a href="#" class="uk-float-right uk-display-inline-block"  uk-icon="icon: triangle-up; ratio: 4" uk-scroll></a>
<script type="text/javascript" src="{{ URL::asset('js/table_form.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
<script>
//var globali
var token = '{{ csrf_token() }}';
var table;
var columns_config = [
    //title = titolo , field = chiave array
    { title:"N°",width:"15",formatter:"rownum"},	
    { field:'tessera_numero', title:'Tessera'},
    { field:'nome', title:'Nome'},
    { field:'cognome', title:'Cognome'},
    { field:'indirizzo', title:'Indirizzo'},
    { field:'data_nascita', title:'Data nascita'},
    { field:'comune_nascita', title:'Comune nascita'},
    { field:'comune_residenza', title:'Comune residenza'},
    { field:'provincia_sigla_residenza',title:'Prov. residenza'},
    { field:'codice_fiscale', title:'Cod.fiscale'},
    { field:'email', title:'Email'},
    { field:'telefono', title:'Tel.'},
    { field:'socio_approvazione_data', title:'Approvato'},
    { field:'soci_tipologia', title:'Tipo socio'},
    { field:'carica_direttivo', title:'Carica direttivo'}];	    
var jsonLista;

//al caricamento della pagina
$(document).ready(function(){
    $('#btn_aggiungi').attr('disabled',true);
    //creo la tabella
	create_table(columns_config);
	//carica i dati
	load_table( '{{ route('getListLibroSoci') }}',token);
	//setto le impostazioni ajax comuni
	$.ajaxSetup({
	type: 'POST',
    cache: false,  
    headers: { 'X-CSRF-Token': token,}
	});
});

$('#btn_stampa_lista').on('click',function(){
	    table.download("pdf", "Libro_soci.pdf", {
        orientation:"landscape", //set page orientation to portrait
		title:"Libro_soci", //add title to report
            autoTable:function(doc){
                //doc - the jsPDF document object

                //add some text to the top left corner of the PDF
                doc.text("SOME TEXT", 35, 35);

                //return the autoTable config options object
                return {
                    styles: {},
                    margin: {right: 5,left: 5,bottom: 10},
                    columnStyles: {Tel: {halign: 'center'}},
                };
            }
        });
});

//chiamata ajax per popolare il documento
function get_list(data) {
         $.ajax({
             type: 'POST',%S
             url: "{{ route('getListLibroSoci') }}",
             data: data,
                success: function(data){
                                jsonLista = data;
                                //sostituisco null con nd
                                for (let i = 0; i < jsonLista.length; i++) {
                                    var object = jsonLista[i];
                                    for (const key in object) {
                                        if(object[key] == null)
                                            object[key] = "";
                                        }
                                    }
                                    
                                
                                stampa(jsonLista);
                        },
                error: function(data) { 
                    alert("getListLibroSoci: Errore nella chiamata ajax!"+data);
                    }
            });   
}

</script>

@endsection
