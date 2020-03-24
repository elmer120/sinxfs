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
	@component('components.forms.gestione_utenti')
	@endcomponent
@endcomponent

<!-- tabella-->
<div id="table"></div>

<a href="#" class="uk-float-right uk-display-inline-block"  uk-icon="icon: triangle-up; ratio: 4" uk-scroll></a>
<script type="text/javascript" src="{{ URL::asset('js/table_form.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
<script>


//var globali
var token = $('meta[name="csrf-token"]').attr('content');
var table;
var row_selected_id;
var data_obj;
var columns_config = [ 
		//title = titolo , field = chiave array
		{ title:"N°",width:"15",formatter:"rownum"},
		//{ title:"Azioni", width:110, resizable:false },
		{	//creo gruppo persona
			title: 'Utente',
			columns:[
                        { title:"Nome", field:"nome", accessorDownload:notNull},
                        { title:"Username", field:"username", accessorDownload:notNull},
                        { title:"Livello", field:"livello", accessorDownload:notNull},
                        { title:"Immagine", field:"immagine", accessorDownload:notNull},
                        { title:"Data creazione", field:"created_at", accessorDownload:notNull,formatter:"datetime",
                            formatterParams:{inputFormat:"YYYY-MM-DD hh:mm:ss",outputFormat:"DD/MM/YYYY hh:mm:ss",invalidPlaceholder:true}
                            },
                        { title:"Ultimo accesso", field:"ultimo_accesso", accessorDownload:notNull,formatter:"datetime",
                            formatterParams:{inputFormat:"YYYY-MM-DD hh:mm:ss",outputFormat:"DD/MM/YYYY hh:mm:ss",invalidPlaceholder:true}
                        },
                        { title:"Ultimo aggiornamento", field:"updated_at", accessorDownload:notNull,formatter:"datetime",
                            formatterParams:{inputFormat:"YYYY-MM-DD hh:mm:ss",outputFormat:"DD/MM/YYYY hh:mm:ss",invalidPlaceholder:true}
                        },
			],
		},
        ];
        //TODO serve?
		var associazione = {!! json_encode($associazione->toArray()) !!};

//al caricamento della pagina
$(document).ready(function(){
	//creo la tabella
	create_table(columns_config);
	//carica i dati //TODO associazione prenderla da javascript?
	load_table( '{{ route('listaUtenti') }}',token,associazione);
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

//visualizza
$('#btn_visualizza').on('click',function (){
	if (row_selected_id >= 0)
	{
		$('#title').text('Visualizza utente');
		//popolo il form
		get_element(row_selected_id,true);
	}
	else{
		console.error("Id selezionato non valido! id:"+row_selected_id);
	}
});

//aggiungi
$('#btn_aggiungi').on('click',function(){
	form_reset();
	$('#title').text('Nuovo utente');
    //popolo il select livello
    get_options( $("[name='fk_utenti_livelli']") ,"fk_utenti_livelli");
    
});

//modifica
$('#btn_modifica').on('click',function()
{
	$('#title').text('Modifica utente');
	//popolo il form
	get_element(row_selected_id,false);

});

//elimina
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

//stampa
$('#btn_stampa').on('click',function(){});

//stampa lista
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

//EVENTI FORM 

$('#btn_annulla').on('click',function (e) {
	form_read_only(false);
	checkbox_default()
	form_reset();
	//metto a null la var globale persona
	persona = null;
})

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

</script>





{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        @if ($errors->any())    
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    @endif
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="nome" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>
                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>
                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                             <label for="livello" class="col-md-4 col-form-label text-md-right">Livello</label>
                                <input id="livello" type="text" class="form-control{{ $errors->has('livello') ? ' is-invalid' : '' }}" name="livello" value="{{ old('livello') }}"  autofocus>
                        
                                @if ($errors->has('livello'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('livello') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>


                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}


@endsection