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


@endsection