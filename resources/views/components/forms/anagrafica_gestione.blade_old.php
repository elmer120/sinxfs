<form id="form" class="uk-grid-small" enctype="multipart/form-data" uk-grid>
										
    <!--div class="uk-width-auto">  
        <img id="preview" class="uk-border-circle" style="display:block" width="75" height="75" src="<?php //echo base_url('assets/img/associati/default/avatar.png');?>">
    </div-->

    <div class="uk-width-1-6@m uk-form-custom">  
        <label class="uk-form-label">Immagine</label>
        <div class="js-upload" uk-form-custom="target: #filename"> <!-- target: #id recupera nome del file caricato e lo aggiunge ad id-->
            <input id="file"  class="uk-input" type="file" name="image" onchange="previewFile()" accept="image/*">
            <input id="filename" class="uk-input" type="text" placeholder="Scegli file">
        </div>
    </div>
    
<legend class="uk-legend">Dati anagrafici</legend>
    
    <div class="uk-width-1-6@m">
        <label class="uk-form-label uk-text-danger">Nome *</label>
        <input class="uk-input uk-form-small" type="text" name="nome" placeholder="Ugo" pattern="[A-Za-z]+" value="" required>
    </div>

    
    <div class="uk-width-1-6@m">
        <label class="uk-form-label uk-text-danger">Cognome *</label>
        <input class="uk-input uk-form-small" class="uk-input" type="text" name="cognome" pattern="[A-Za-z]+" value="" placeholder="Rossi">
        
    </div>


    <div class="uk-width-1-6@m">
        <label class="uk-form-label">Data di nascita</label>
        <input class="uk-input uk-form-small" type="date" name="data_nascita" value="" placeholder="01/07/1975">
    </div>
            
    <div class="uk-width-1-6@m">
        <label class="uk-form-label">Provincia di nascita</label>
        <select class="uk-select uk-form-small" id="select_province_nascita" name="provincia_nascita" data-url="{{ route("province") }}">
                <option value="" selected>Scegli la provincia</option>
        </select>
    </div>

    <div class="uk-width-1-6@m">
        <label class="uk-form-label uk-text-danger">Comune di nascita *</label>
        <select class="uk-select uk-form-small" id="select_comuni_nascita" name="comune_nascita" data-url="{{ route("comuni") }}" value="">
                <option value="" selected>Scegli il comune</option>
        </select>
    </div>

    
    <div class="uk-width-1-6@m">
        <label class="uk-form-label">Codice fiscale</label>
        <input class="uk-input uk-form-small" type="text" name="codice_fiscale" pattern="[a-zA-Z]{6}[0-9]{2}[a-zA-Z][0-9]{2}[a-zA-Z][0-9]{3}[a-zA-Z]" value="" placeholder="RSSMRA75L01H501A">
    </div>

    
    <div class="uk-width-1-6@m">
        <label class="uk-form-label">Partita iva</label>
        <input class="uk-input uk-form-small" type="text" name="partita_iva" value="" placeholder="12365421">
    </div>

    
    <div class="uk-width-1-6@m">
        <label class="uk-form-label">Regione di residenza</label>
        <select class="uk-select uk-form-small" id="select_regioni" name="regione_residenza" data-url="{{ route("regioni") }}">
                <option value="" selected>Scegli la regione</option>
        </select>
    </div>
    
    <div class="uk-width-1-6@m">
        <label class="uk-form-label">Provincia di residenza</label>
        <select class="uk-select uk-form-small" id="select_province" name="provincia_residenza" data-url="{{ route("province") }}">
            <option value="" selected>Scegli la provincia</option>
        </select>
    </div>

    
    <div class="uk-width-1-6@m">
        <label class="uk-form-label uk-text-danger">Comune di residenza *</label>
        <select class="uk-select uk-form-small" id="select_comuni" value="" name="comune_residenza" data-url="{{ route("comuni") }}">
            <option value="" selected>Scegli il comune</option>
        </select>
    </div>

    <div class="uk-width-1-6@m">
        <label class="uk-form-label">Indirizzo di residenza</label>
        <input class="uk-input uk-form-small" type="text" name="indirizzo" value="" placeholder="Via Alle spezie, 8">
    </div>

    <div class="uk-width-1-6@m uk-margin">
        <label class="uk-form-label">Consenso privacy</label>
        <input id="privacy" class="uk-checkbox" type="checkbox" name="privacy">
    </div>

<legend class="uk-legend">Contatti</legend>

    <div class="uk-width-1-6@m">
        <label class="uk-form-label">Telefono</label>
        <input class="uk-input uk-form-small" type="text" name="telefono" value="" placeholder="0464598547">
    </div>

    
    <div class="uk-width-1-6@m">
        <label class="uk-form-label">Telefono secondario</label>
        <input class="uk-input uk-form-small" type="text" name="telefono_ext" value="" placeholder="3219876543">
    </div>

    
    <div class="uk-width-1-6@m">
        <label class="uk-form-label">Indirizzo e-mail</label>
        <input class="uk-input uk-form-small" type="email" name="email" value="" placeholder="ugo.rossi@gmail.com">
    </div>

<legend class="uk-legend">Varie</legend>

    <div class="uk-width-1-6@m">
        <label class="uk-form-label">Sotto la responsabilità di ..</label>
        <select class="uk-select uk-form-small" name="responsabile" id="select_responsabile" data-url="{{ route("responsabile") }}">
                <option value="" selected>Responsabile..</option>
        </select>
    </div>

    <div class="uk-width-1-6@m">
        <label class="uk-form-label">Iban</label>
        <input class="uk-input uk-form-small" type="text" name="iban" value="" placeholder="IT60X0542811101000000123456">
    </div>


    <div class="uk-width-1-6@m">
        <label class="uk-form-label">Nome Banca</label>
        <input class="uk-input uk-form-small" type="text" name="banca" value="" placeholder="Cassa rurale">
    </div>


    <div class="uk-width-1-6@m">
        <label class="uk-form-label">Note aggiuntive</label>
        <textarea class="uk-textarea uk-form-small" name="note" rows="2"></textarea>
    </div>
    
<fieldset id="socio_fieldset" class="uk-fieldset">
<legend id="socio_legend" class="uk-legend uk-text-muted">Socio
<input id="socio_checkbox" class="uk-checkbox" type="checkbox" name="socio"> 


        <label class="uk-form-label uk-text-danger">Tipo associato *</label>
        <select class="uk-select uk-form-small" id="select_tipo" name="soci_tipologia" value="" data-url="{{ route("soci_tipologie") }}" disabled>
            <option value="">*Tipo associato...</option>
        </select>



        <label class="uk-form-label">Richiesta iscrizione *</label>
        <input class="uk-input uk-form-small" type="date" name="richiesta_data" value="" placeholder="01/01/2019" disabled>


        <label class="uk-form-label uk-text-danger">Approvazione iscrizione *</label>
        <input class="uk-input uk-form-small" type="date" name="approvazione_data" value="" placeholder="03/01/2019" disabled>


        <label class="uk-form-label">Scadenza iscrizione</label>
        <input class="uk-input uk-form-small" type="date" name="scadenza_data" value="" placeholder="13/01/2020" disabled>

</fieldset> 
<!--legend id="certificato_medico_legend" class="uk-legend uk-text-muted">Certificato medico </legend-->

    <div class="uk-width-1-6@m">
        <label class="uk-form-label">Scadenza certificato</label>
        <input class="uk-input uk-form-small" type="date" name="certificato_scadenza_al" value="" placeholder="13/01/2020" disabled>
    </div>

<legend id="carica_sociale_legend" class="uk-legend uk-text-muted"> Carica sociale 
<input class="uk-checkbox" name="carica_sociale" type="checkbox" disabled> </legend>

    <div class="uk-width-1-6@m">  
        <label class="uk-form-label uk-text-danger">Carica *</label>
        <select class="uk-select uk-form-small" id="select_carica" name="carica_sociale_tipologia" value="" data-url="{{ route("cariche_direttivo") }}" disabled>
            <option value="">*Carica direttivo</option>
        </select>
    </div>

    <div class="uk-width-1-6@m">
        <label class="uk-form-label">Inizio carica</label>
        <input class="uk-input uk-form-small" type="date" name="carica_direttivo_dal" value="" placeholder="13/01/2020" disabled>
    </div>
    <div class="uk-width-1-6@m">
        <label class="uk-form-label">Fine carica</label>
        <input class="uk-input uk-form-small" type="date" name="carica_direttivo_al" value="" placeholder="13/01/2020" disabled>
    </div>
            
<legend id="tessera_legend" class="uk-legend uk-text-muted">Tesserato
<input class="uk-checkbox" name="tessera" type="checkbox" disabled> </legend>

    <div class="uk-width-1-6@m">
        <label class="uk-form-label uk-text-danger">Numero tessera *</label>
        <input class="uk-input uk-form-small" type="text" name="numero" value="" placeholder="formato libero" disabled>
    </div>

    <div class="uk-width-1-6@m">
        <label class="uk-form-label">Valida dal</label>
        <input class="uk-input uk-form-small" type="date" name="tessere_dal" value="" placeholder="13/01/2020" disabled>
    </div>
    <div class="uk-width-1-6@m">
        <label class="uk-form-label">Scadenza al</label>
        <input class="uk-input uk-form-small" type="date" name="tessere_al" value="" placeholder="13/01/2020" disabled>
    </div>

    <div class="uk-width-1-6@m">
        <label class="uk-form-label">Tipo tessera</label>
        <input class="uk-input uk-form-small" type="text" name="tessere_tipo" value="" placeholder="formato libero" disabled>
    </div>
