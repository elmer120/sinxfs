<form id="form" class="uk-grid-small" enctype="multipart/form-data" uk-grid>
    
    <legend class="uk-legend">Emissione</legend>
        
    {{-- Ricevuta di pagemanto viene inserita nella prima nota come voce indipendente con la propria causale (aggiungere R.), mentre nel conto economico viene aggiunto solo l'importo alla voce già presente  --}}
        
        <div class="uk-width-1-6@m">
            <label class="uk-form-label">Numero</label>
            <span uk-icon="icon: info; ratio: 0.8" uk-tooltip="Il numero viene generato automaticamente in ordine progressivo"></span>
            <input class="uk-input uk-form-small" type="text" name="numero" value="" readonly>
        </div>
    
        <div class="uk-width-1-6@m">
            <label class="uk-form-label">Data emissione</label>
            <input class="uk-input uk-form-small" type="date" name="data_emissione" value="" placeholder="01/01/2019">
        </div>
    
        <div class="uk-width-1-6@m">
            <label class="uk-form-label">Ricevuta da</label>
            <select class="uk-select uk-form-small" name="persona" id="select_persona">
                    <option value="" selected>Scegli il pagante</option>
            </select>
        </div>
    
        <div class="uk-width-1-6@m">
            <label class="uk-form-label">Causale</label> {{-- voce indipendente nella prima nota --}}
            <span uk-icon="icon: info; ratio: 0.8" uk-tooltip="La causale viene inserita come voce nella prima nota"></span>
            <input class="uk-input uk-form-small" type="text" name="causale" value="" placeholder="Tesseramento di Ennio morricone">
        </div>
    
        <div class="uk-width-1-6@m">
            <label class="uk-form-label">Importo</label>
            <input class="uk-input uk-form-small" type="text" name="importo" value="" placeholder="20€">
        </div>
    
    <legend class="uk-legend">Pagamento</legend>
    
        <div class="uk-width-1-6@m">
            <label class="uk-form-label">Data pagamento</label>
            <input class="uk-input uk-form-small" type="date" name="data_pagamento" value="" placeholder="07/01/2019">
        </div>
    
        <div class="uk-width-1-6@m">
            <label class="uk-form-label">Versata su fondo</label>
            <select class="uk-select uk-form-small" name="fondo" id="select_fondo">
                    <option value="" selected>Scegli il fondo</option>
            </select>
        </div>
    
    <legend class="uk-legend">Registrazione</legend>
        
        <div class="uk-width-1-6@m">
            <label class="uk-form-label">Voce conto economico</label>
            <span uk-icon="icon: info; ratio: 0.8" uk-tooltip="L'importo della ricevuta verrà aggiunto alla voce del conto economico qui selezionata"></span>
            <select class="uk-select uk-form-small" name="voce_conto_economico" id="select_voce_conto_economico">
                    <option value="" selected>Scegli la voce</option>
            </select>
        </div>
    
    