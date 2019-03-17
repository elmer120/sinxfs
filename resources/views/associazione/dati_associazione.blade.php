@extends("templates.template")
@section('tab_title',$tab_title) <!-- titolo tab come 2° parametro stringa o variabile -->
@section('page_title',$page_title) <!-- titolo pagina/sezione -->
@section('page_content')
{{ $associazione }}
<form id="form_dati_associazione" class="uk-form-horizontal" enctype="multipart/form-data">
<fieldset class="uk-fieldset"> <!-- si occupa del padding nel form necessario per il form "orizzontali" -->

<!--label class="uk-form-label">Logo</label>
    <div class="uk-form-controls uk-margin">  
    <img class="uk-border-circle" width="150" height="150" src="<?php //echo base_url('assets/img/associazione/logo/').$_SESSION['association']['logo'];?>">
        <div class="js-upload" uk-form-custom>
          <input type="file"  name="logo" multiple>
          <button class="uk-button uk-button-default" type="button" tabindex="-1">Cambia logo</button>
        </div>
    </div-->

     <label class="uk-form-label">Logo</label>
    <div class="uk-form-controls uk-margin">  
        <div class="js-upload" uk-form-custom="target: #filename"> <!-- target: #id recupera nome del file caricato e lo aggiunge ad id-->
        <img id="preview" width="150" height="150" src="<?php //echo base_url('assets/img/associazione/logo/').$_SESSION['association']['logo'];?>">
          <input id="file" type="file" name="logo" onchange="previewFile()" accept="image/*">
          <input id="filename" class="uk-input uk-form-width-medium" type="text" placeholder="Cambia logo">
        </div>
    </div>

<label class="uk-form-label">Nome</label>
    <div class="uk-form-controls uk-margin">
      <input class="uk-input uk-form-width-medium" type="text" name="nome" placeholder="Nome associazione" pattern="[A-Za-z\s]+" value="{{ $associazione->nome }}" required>
    </div>

<label class="uk-form-label">Tipologia</label>
    <div class="uk-form-controls">
      <input class="uk-input uk-form-width-medium" type="text" name="tipo" placeholder="asd" value="{{ $associazione->tipo }}">
    </div>
  
<label class="uk-form-label">Anno fondazione</label>
    <div class="uk-form-controls">
      <input class="uk-input uk-form-width-medium" type="text" name="anno_fondazione" placeholder="1950" value="{{ $associazione->anno_fondazione }}">
    </div>

<label class="uk-form-label">Regione</label>
    <div class="uk-form-controls">
      <select class="uk-select uk-form-width-medium" id="select_regioni">
		<option value="" selected></option>
      </select>
    </div>

<label class="uk-form-label">Provincia</label>
    <div class="uk-form-controls">
      <select class="uk-select uk-form-width-medium" id="select_province" required disabled>
        <option value="<?php //echo $_SESSION['association']['p_id'];?>" selected><?php //echo $_SESSION['association']['p_nome'];?></option>
      </select>
    </div>

<label class="uk-form-label">Comune</label>
    <div class="uk-form-controls">
      <select class="uk-select uk-form-width-medium" id="select_comuni" name="fk_comuni" required disabled>
        <option value="<?php //echo $_SESSION['association']['c_id'];?>" selected><?php //echo $_SESSION['association']['c_nome'];?></option>
      </select>
    </div>

<label class="uk-form-label">Indirizzo</label>
    <div class="uk-form-controls">
        <input class="uk-input uk-form-width-medium" class="uk-input" type="text" name="indirizzo" placeholder="Via Dante, 8" value="{{ $associazione->indirizzo }}">
    </div>
  
	<label class="uk-form-label">Codice Fiscale</label>
    <div class="uk-form-controls">
      <input class="uk-input uk-form-width-medium" type="text" name="codice_fiscale" placeholder="codice_fiscale" value="{{ $associazione->codice_fiscale }}">

    </div>
    
    <label class="uk-form-label">Partita iva</label>
    <div class="uk-form-controls">
      <input class="uk-input uk-form-width-medium" type="text" name="partita_iva" placeholder="codice_fiscale" value="{{ $associazione->partita_iva }}">
	</div>
	
	<label class="uk-form-label">VAT</label>
    <div class="uk-form-controls">
      <input class="uk-input uk-form-width-medium" type="text" name="vat" placeholder="22%" value="{{ $associazione->vat }}">

    </div>

<label class="uk-form-label">Telefono</label>
    <div class="uk-form-controls">
      <input class="uk-input uk-form-width-medium" type="text" name="telefono" placeholder="0462458135" value="{{ $associazione->telefono }}">
    </div>
    
<label class="uk-form-label">Cellulare</label>
    <div class="uk-form-controls">
      <input class="uk-input uk-form-width-medium" type="text" name="telefono_ext" placeholder="3331234567" value="{{ $associazione->telefono_ext }}">
    </div>


<label class="uk-form-label">Indirizzo e-mail</label>
    <div class="uk-form-controls">
      <input class="uk-input uk-form-width-medium" type="email" name="email" placeholder="info@mail.it" value="{{ $associazione->email }}">

    </div>
  
<label class="uk-form-label">Indirizzo e-mail(PEC)</label>
    <div class="uk-form-controls">
      <input class="uk-input uk-form-width-medium" type="email" name="email_pec" placeholder="info@mailPec.it" value="{{ $associazione->email_pec }}">

    </div>
  
<label class="uk-form-label">Iscrizione (odv/aps)</label>
    <div class="uk-form-controls">
      <input class="uk-input uk-form-width-medium" type="text" name="registration" placeholder="" value="{{ $associazione->registration }}">
    </div>    

    <button class="uk-button uk-button-default" type="submit" onclick="set_enable()">Invia</button>
    </fieldset>

</form>

        </div> <!-- fine container -->

</div> <!-- fine sezione -->

</div> <!--fine colonna -->

<script>

//al caricamento della pagina
$(document).ready(function(){
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
	get_province('{{ $associazione->fk_province }}','#select_province');
   // get_province(null,'#select_province');
});
// ---- EVENTI ----
//alla selezione della regione di residenza carico le corrispondenti province
$('#select_regioni').on('change',function(){
	get_province(this.value,'#select_province');
});

//alla selezione della provincia di nascita carico i corrispondenti comuni
$('#select_province').on('change',function(){
	get_comuni(this.value,'#select_comuni_nascita');
});

//alla selezione della provincia di residenza carico i corrispondenti comuni
$('#select_comuni').on('change',function(){
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

</script>

@endsection