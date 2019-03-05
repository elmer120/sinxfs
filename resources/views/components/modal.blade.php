<!-- Finestra modal aggiungi -->
<div id="modal_aggiungi" class="uk-modal-container" uk-modal='{"bg-close":false}'>
    <div class="uk-modal-dialog" uk-overflow-auto>
		<!-- header -->
		<div class="uk-modal-header">
        	<h2 class="uk-modal-title">Aggiungi persona/socio</h2>
			<span class="uk-text-danger">Richiesto *</span>
		</div>
		<!-- body -->  
		<div class="uk-modal-body">
		
		<form id="form_aggiungi" class="uk-grid-small" enctype="multipart/form-data" uk-grid>
						
						
						
						<!--div class="uk-width-auto">  
							<img id="preview" class="uk-border-circle" style="display:block" width="75" height="75" src="<?php //echo base_url('assets/img/associati/default/avatar.png');?>">
						</div-->

						<div class="uk-width-1-6@m uk-form-custom">  
							<label class="uk-form-label">Immagine</label>
							<div class="js-upload" uk-form-custom="target: #filename"> <!-- target: #id recupera nome del file caricato e lo aggiunge ad id-->
							<input id="file"  class="uk-input" type="file" name="avatar" onchange="previewFile()" accept="image/*">
							<input id="filename" class="uk-input" type="text" placeholder="Scegli file <?php //echo set_value('avatar'); ?>">
							<?php //echo form_error('avatar'); ?>
							</div>
						</div>
						
				<legend class="uk-legend">Dati anagrafici</legend>
						
						<div class="uk-width-1-6@m">
							<label class="uk-form-label uk-text-danger">Nome *</label>
							<input class="uk-input uk-form-small" type="text" name="nome" placeholder="Ugo" pattern="[A-Za-z]+" value="<?php //echo set_value('nome'); ?>" required>
							<?php //echo form_error('nome'); ?>
						</div>
					
						
						<div class="uk-width-1-6@m">
							<label class="uk-form-label uk-text-danger">Cognome *</label>
							<input class="uk-input uk-form-small" class="uk-input" type="text" name="cognome" pattern="[A-Za-z]+" value="<?php //echo set_value('cognome'); ?>" placeholder="Rossi">
							
						</div>
					
					
						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Data di nascita</label>
							<input class="uk-input uk-form-small" type="date" name="data_nascita" value="<?php //echo set_value('data_nascita'); ?>" placeholder="01/07/1975">
							<?php //echo form_error('data_nascita'); ?>
						</div>
								
						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Provincia di nascita</label>
							<select class="uk-select uk-form-small" id="select_province_nascita">
						</select>
						</div>

						<div class="uk-width-1-6@m">
							<label class="uk-form-label uk-text-danger">Comune di nascita *</label>
							<select class="uk-select uk-form-small" id="select_comuni_nascita" name="fk_comuni_nascita" value="<?php //echo set_value('fk_comuni_nascita'); ?>">
							<option value="" selected>Scegli il comune</option>
							</select>
							<?php //echo form_error('fk_comuni_nascita'); ?>
						</div>

						
						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Codice fiscale</label>
							<input class="uk-input uk-form-small" type="text" name="codice_fiscale" pattern="[a-zA-Z]{6}[0-9]{2}[a-zA-Z][0-9]{2}[a-zA-Z][0-9]{3}[a-zA-Z]" value="<?php //echo set_value('codice_fiscale'); ?>" placeholder="RSSMRA75L01H501A">
							<?php //echo form_error('codice_fiscale'); ?>
						</div>

						
						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Partita iva</label>
							<input class="uk-input uk-form-small" type="text" name="partita_iva" value="<?php //echo set_value('partita_iva'); ?>" placeholder="12365421">
							<?php //echo form_error('partita_iva'); ?>
						</div>
					
						
						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Regione di residenza</label>
							<select class="uk-select uk-form-small" id="select_regioni" >
						</select>
						</div>

						
						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Provincia di residenza</label>
							<select class="uk-select uk-form-small" id="select_province" >
								<option value="" selected>Scegli la provincia</option>
							</select>
						</div>

						
						<div class="uk-width-1-6@m">
							<label class="uk-form-label uk-text-danger">Comune di residenza *</label>
							<select class="uk-select uk-form-small" id="select_comuni" name="fk_comuni" value="<?php //echo set_value('fk_comuni'); ?>" >
								<option value="" selected>Scegli il comune</option>
							</select>
							<?php //echo form_error('fk_comuni'); ?>
						</div>

						
						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Indirizzo di residenza</label>
							<input class="uk-input uk-form-small" type="text" name="indirizzo" value="<?php //echo set_value('indirizzo'); ?>" placeholder="Via Alle spezie, 8">
							<?php //echo form_error('indirizzo'); ?>
						</div>

						<div class="uk-width-1-6@m uk-margin">
							<label class="uk-form-label">Consenso privacy</label>
							<input class="uk-checkbox" name="privacy" type="hidden" value="0">
							<input class="uk-checkbox" name="privacy" type="checkbox" value="1">
						</div>
						
				<legend class="uk-legend">Contatti</legend>

						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Telefono</label>
							<input class="uk-input uk-form-small" type="text" name="telefono" value="<?php //echo set_value('telefono'); ?>" placeholder="0464598547">
							<?php //echo form_error('telefono'); ?>
						</div>
					
						
						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Telefono secondario</label>
							<input class="uk-input uk-form-small" type="text" name="telefono_ext" value="<?php //echo set_value('telefono_ext'); ?>" placeholder="3219876543">
							<?php //echo form_error('telefono_ext'); ?>
						</div>
					
						
						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Indirizzo e-mail</label>
							<input class="uk-input uk-form-small" type="email" name="email" value="<?php //echo set_value('email'); ?>" placeholder="ugo.rossi@gmail.com">
							<?php //echo form_error('email'); ?>
						</div>
				
				<legend class="uk-legend">Varie</legend>

						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Sotto la responsabilità di ..</label>
							<select class="uk-select uk-form-small" name="fk_responsabile" id="select_responsabile">
									<option value="" selected>Responsabile..</option>
						</select>
						</div>

						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Iban</label>
							<input class="uk-input uk-form-small" type="text" name="iban" value="<?php //echo set_value('iban'); ?>" placeholder="IT60X0542811101000000123456">
							<?php //echo form_error('iban'); ?>
						</div>


						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Nome Banca</label>
							<input class="uk-input uk-form-small" type="text" name="banca" value="<?php //echo set_value('banca'); ?>" placeholder="Cassa rurale">
							<?php //echo form_error('banca'); ?>
						</div>


						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Note aggiuntive</label>
							<textarea class="uk-textarea uk-form-small" name="note" rows="2"><?php //echo set_value('note'); ?></textarea>
							<?php //echo form_error('note'); ?>
						</div>

				<legend id="socio_legend" class="uk-legend uk-text-muted">Dati iscrizione 
				<input id="socio_checkbox" class="uk-checkbox" type="checkbox" name="socio"> </legend> 

						<div class="uk-width-1-6@m">
							<label class="uk-form-label uk-text-danger">Tipo associato *</label>
							<select class="uk-select uk-form-small" id="select_tipo" name="fk_soci_tipologie" value="<?php //echo set_value('fk_soci_tipologie'); ?>" disabled>
								<option value="">*Tipo associato...</option>
							</select>
							<?php //echo form_error('fk_soci_tipologie'); ?>
						</div>

						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Richiesta iscrizione *</label>
							<input class="uk-input uk-form-small" type="date" name="richiesta_data" value="<?php //echo set_value('richiesta_data'); ?>" placeholder="01/01/2019" disabled>
							<?php //echo form_error('richiesta_data'); ?>
						</div>
						<div class="uk-width-1-6@m">
							<label class="uk-form-label uk-text-danger">Approvazione iscrizione *</label>
							<input class="uk-input uk-form-small" type="date" name="approvazione_data" value="<?php //echo set_value('approvazione_data'); ?>" placeholder="03/01/2019" disabled>
							<?php //echo form_error('approvazione_data'); ?>
						</div>

						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Scadenza iscrizione</label>
							<input class="uk-input uk-form-small" type="date" name="scadenza_data" value="<?php //echo set_value('scadenza_data'); ?>" placeholder="13/01/2020" disabled>
							<?php //echo form_error('scadenza_data'); ?>
						</div>

				<legend id="certificato_medico_legend" class="uk-legend uk-text-muted">Certificato medico </legend>

						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Scadenza certificato</label>
							<input class="uk-input uk-form-small" type="date" name="certificato_scadenza_al" value="<?php //echo set_value('certificato_scadenza_al'); ?>" placeholder="13/01/2020" disabled>
							<?php //echo form_error('certificato_scadenza_al'); ?>
						</div>

				<legend id="carica_direttivo_legend" class="uk-legend uk-text-muted"> Carica sociale 
				<input id="carica_direttivo_checkbox" class="uk-checkbox" name="carica_direttivo" type="checkbox" disabled> </legend>

						<div class="uk-width-1-6@m">  
							<label class="uk-form-label uk-text-danger">Carica *</label>
							<select class="uk-select uk-form-small" id="select_carica" name="fk_cariche_direttivo" value="<?php //echo set_value('fk_cariche_direttivo'); ?>" disabled>
								<option value="">*Carica direttivo</option>
							</select>
							<?php //echo form_error('fk_cariche_direttivo'); ?>
						</div>

						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Inizio carica</label>
							<input class="uk-input uk-form-small" type="date" name="carica_direttivo_dal" value="<?php //echo set_value('carica_direttivo_dal'); ?>" placeholder="13/01/2020" disabled>
							<?php //echo form_error('carica_direttivo_dal'); ?>
						</div>
						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Fine carica</label>
							<input class="uk-input uk-form-small" type="date" name="carica_direttivo_al" value="<?php //echo set_value('carica_direttivo_al'); ?>" placeholder="13/01/2020" disabled>
							<?php //echo form_error('carica_direttivo_al'); ?>
						</div>
								
				<legend id="tessere_legend" class="uk-legend uk-text-muted">Dati tesseramento 
				<input id="tessere_checkbox" class="uk-checkbox" name="tessere" type="checkbox" disabled> </legend>

						<div class="uk-width-1-6@m">
							<label class="uk-form-label uk-text-danger">Numero tessera *</label>
							<input class="uk-input uk-form-small" type="text" name="numero" value="<?php //echo set_value('numero'); ?>" placeholder="formato libero" disabled>
							<?php //echo form_error('numero'); ?>
						</div>

						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Valida dal</label>
							<input class="uk-input uk-form-small" type="date" name="tessere_dal" value="<?php //echo set_value('tessere_dal'); ?>" placeholder="13/01/2020" disabled>
							<?php //echo form_error('tessere_dal'); ?>
						</div>
						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Scadenza al</label>
							<input class="uk-input uk-form-small" type="date" name="tessere_al" value="<?php //echo set_value('tessere_al'); ?>" placeholder="13/01/2020" disabled>
							<?php //echo form_error('tessere_al'); ?>
						</div>

						<div class="uk-width-1-6@m">
							<label class="uk-form-label">Tipo tessera</label>
							<input class="uk-input uk-form-small" type="text" name="tessere_tipo" value="<?php //echo set_value('tessere_tipo'); ?>" placeholder="formato libero" disabled>
							<?php //echo form_error('tessere_tipo'); ?>
						</div>
		
		</div>
		<!-- footer -->
		<div class="uk-modal-footer">
			<button class="uk-button uk-button-default uk-modal-close" type="button">Annulla</button>
         	<input class="uk-button uk-button-primary" type="submit" name="submit" value="Salva">
		</div>
		</form>
	</div>
</div>