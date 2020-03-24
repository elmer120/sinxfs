<form id="form" class="uk-grid-small" enctype="multipart/form-data" uk-grid>
										
    <!--div class="uk-width-auto">  
        <img id="preview" class="uk-border-circle" style="display:block" width="75" height="75" src="<?php //echo base_url('assets/img/associati/default/avatar.png');?>">
    </div-->

    <div class="uk-width-1-6@m uk-form-custom">  
        <label class="uk-form-label">Immagine</label>
        <div class="js-upload" uk-form-custom="target: #filename"> <!-- target: #id recupera nome del file caricato e lo aggiunge ad id-->
            <input id="file"  class="uk-input" type="file" name="avatar" onchange="previewFile()" accept="image/*">
            <input id="filename" class="uk-input" type="text" placeholder="Scegli file">
        </div>
    </div>
    
<legend class="uk-legend">Utente</legend>
    
    <div class="uk-width-1-6@m">
        <label class="uk-form-label uk-text-danger">Nome *</label>
        <input class="uk-input uk-form-small" type="text" name="nome" placeholder="Ugo" pattern="[A-Za-z]+" value="" required>
    </div>

    
    <div class="uk-width-1-6@m">
        <label class="uk-form-label uk-text-danger">Username *</label>
        <input class="uk-input uk-form-small" class="uk-input" type="text" name="username" pattern="[A-Za-z]+" value="" placeholder="Rossi">
        
    </div>

    <div class="uk-width-1-6@m">
        <label class="uk-form-label">Livello</label>
        <select class="uk-select uk-form-small" id="select_livello" name="fk_utenti_livelli" data-url="livelliutenti">
                <option value="" selected>Livello</option>
        </select>
    </div>

    <div class="uk-width-1-6@m">
        <label class="uk-form-label">Data creazione</label>
        <input class="uk-input uk-form-small" type="date" name="created_at" value="" placeholder="nd" readonly>
    </div>

    <div class="uk-width-1-6@m">
        <label class="uk-form-label">Ultimo accesso</label>
        <input class="uk-input uk-form-small" type="date" name="ultimo_accesso" value="" placeholder="nd">
    </div>

    <div class="uk-width-1-6@m">
        <label class="uk-form-label">Ultimo aggiornamento</label>
        <input class="uk-input uk-form-small" type="date" name="updated_at" value="" placeholder="nd">
    </div>
