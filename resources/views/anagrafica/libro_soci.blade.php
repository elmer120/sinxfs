@extends("templates.template")
@section('tab_title',$tab_title) <!-- titolo tab come 2° parametro stringa o variabile -->
@section('page_title',$page_title) <!-- titolo pagina/sezione -->
@section('page_content')

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

    <form id="form_libro_soci" class="uk-form-horizontal" method="get">

        <fieldset class="uk-fieldset">

        <legend class="uk-legend">Associati</legend> <!-- titolo -->

        <label class="uk-form-label">Ordinamento</label>
            <div class="uk-form-controls uk-margin">
                <label><input class="uk-radio" type="radio" name="ordinamento" value="persone.nome" checked> Per nome</label><br>
                <label><input class="uk-radio" type="radio" name="ordinamento" value="tessere.numero"> Per numero tessera</label>
            </div>

        <button class="uk-button uk-button-primary" type="submit">Stampa</button>

        </fieldset>
    </form>


<script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
<script>

//al caricamento della pagina
$(document).ready(function(){
	//setto le impostazioni ajax comuni
	$.ajaxSetup({
		type: 'POST',
    cache: false,
    dataType: 'json', //Tipo di dato che si riceve di ritorno  
    headers: {
    'X-CSRF-Token': '{{ csrf_token() }}',
     }
     
	});
	// Default export is a4 paper, portrait, using milimeters for units
var doc = new jsPDF()

doc.text('Hello world!', 10, 10)
doc.save('a4.pdf')
doc.output('dataurlnewwindow','filename=test')
});


function demoFromHTML() {
            var pdf = new jsPDF('p', 'pt', 'letter');
            // source can be HTML-formatted string, or a reference
            // to an actual DOM element from which the text will be scraped.
            source = $('#customers')[0];

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





var jsonLista;
function stampa(lista){
    printJS({
        printable: lista, 
        properties: [
                { field:'tessera_numero', displayName:'Tessera'},
                { field:'nome', displayName:'Nome'},
                { field:'cognome', displayName:'Cognome'},
                { field:'indirizzo', displayName:'Indirizzo'},
                { field:'data_nascita', displayName:'Data nascita'},
                { field:'comune_nascita', displayName:'Comune nascita'},
                { field:'comune_residenza', displayName:'Comune residenza'},
                { field:'provincia_sigla_residenza',displayName:'Prov. residenza'},
                { field:'codice_fiscale', displayName:'Cod.fiscale'},
                { field:'email', displayName:'Email'},
                { field:'telefono', displayName:'Tel.'},
                { field:'socio_approvazione_data', displayName:'Approvato'},
                { field:'soci_tipologia', displayName:'Tipo socio'},
                { field:'carica_direttivo', displayName:'Carica direttivo'}], 
        type: 'json',
        targetStyles:['*'],
        style: 'td { text-align: center; } tr:nth-child(even) { background-color: #f2f2f2; }',
        header: '<span style="font-size: 2em; font-weight: bold;">{{ $associazione->nome }}</span><br><span>{{ $associazione->indirizzo }}, - {{ $associazione->cap }} {{ $associazione->comune }} {{ "(".$associazione->provincia_sigla.")" }} </span><br><span>{{ "Tel: ".$associazione->telefono }} - {{ "Tel: ".$associazione->telefono_ext }} - {{ "Email: ".$associazione->email }}</span><br><span>{{ "Cf: ".$associazione->codice_fiscale }} - {{ "Pi: ".$associazione->partita_iva }} </span></div></div><hr>',
        headerStyle: 'font-size: 1em;  font-weight: normal; text-align: center;',
        documentTitle: 'Libro soci',    
    });
}
//all submit del form
$('#form_libro_soci').on('submit',function(e){
    var data = $('#form_libro_soci').serialize();
	console.log(data); //x debug
	e.preventDefault(); //blocco il comportamento di default
    get_list(data);

})
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
