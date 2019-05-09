@extends("templates.template")
@section('tab_title',$tab_title) <!-- titolo tab come 2° parametro stringa o variabile -->
@section('page_title',$page_title) <!-- titolo pagina/sezione -->
@section('page_content')
@component('components.actions_bar',[
	'btn_visualizza' => 0,
	'btn_aggiungi' => 0,
    'btn_modifica' => 0,
    'btn_elimina' => 0,
    'btn_stampa' => 0,
    'btn_stampa_lista' => 1,
    'input_search' => 1,
])		
@endcomponent
    
<!-- tabella-->
<div id="table"></div>
    

        <pre id="test">												
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
    { field:'tessera_numero', title:'Tessera', accessorDownload:notNull},
    { field:'nome', title:'Nome',accessorDownload:notNull},
    { field:'cognome', title:'Cognome',accessorDownload:notNull},
    { field:'indirizzo', title:'Indirizzo',accessorDownload:notNull},
    { field:'data_nascita', title:'Data nascita',accessorDownload:notNull},
    { field:'comune_nascita', title:'Comune nascita',accessorDownload:notNull},
    { field:'comune_residenza', title:'Comune residenza',accessorDownload:notNull},
    { field:'provincia_sigla_residenza',title:'Prov. residenza',accessorDownload:notNull},
    { field:'codice_fiscale', title:'Cod.fiscale',accessorDownload:notNull},
    { field:'email', title:'Email',accessorDownload:notNull},
    { field:'telefono', title:'Tel.',accessorDownload:notNull},
    { field:'socio_approvazione_data', title:'Approvato',accessorDownload:notNull},
    { field:'soci_tipologia', title:'Tipo socio',accessorDownload:notNull},
    { field:'carica_direttivo', title:'Carica direttivo',accessorDownload:notNull}];	    
var jsonLista;
var associazione = {!! json_encode($associazione->toArray()) !!};
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

//ricerca istantanea
$("#input_search").keyup(function(){
    search(this.value);
});

$('#btn_stampa_lista').on('click',function(){
    let d = new Date();
    let data = '_'+d.getDate()+'_'+(d.getMonth()+1)+'_'+d.getFullYear();
	    table.download("pdf", "libro_soci"+data+".pdf", {
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
                    doc.text("Libro soci",(width/2)-50,20,);
                
                            return {
                                theme: 'grid',
                                styles: {cellPadding: 0.1, fontSize: 7},
                                margin: {right: 5,left: 5,bottom: 10},
                                valign: 'left',
                                lineWidth: 1,
                                lineColor: [255, 0, 0],
                                startY: doc.pageCount > 1? doc.autoTableEndPosY() + 20 : 50,
                            }
            }
        });
});




//chiamata ajax per popolare il documento
function get_list(data) {
         $.ajax({
             type: 'POST',
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
