	<!-- barra azioni -->
	<div class="uk-placeholder uk-display-inline-block uk-background-default uk-margin-remove">
		<div class="uk-button-group">
        	<button id="btn_visualizza" class="uk-button uk-button-primary uk-button-small" uk-toggle="target: #modal" type="button" disabled>Visualizza <span class="uk-margin-small-left" uk-icon="icon: expand; ratio: 0.8"></span></button>
			<button id="btn_aggiungi" class="uk-button uk-button-primary uk-button-small" uk-toggle="target: #modal" type="button">Aggiungi <span class="uk-margin-small-left" uk-icon="plus-circle"></span></button>
			<button id="btn_modifica" class="uk-button uk-button-primary uk-button-small" uk-toggle="target: #modal" type="button" disabled>Modifica<span class="uk-margin-small-left" uk-icon="pencil"></span></button>
			<button id="btn_elimina" class="uk-button uk-button-primary uk-button-small" disabled>Elimina<span class="uk-margin-small-left" uk-icon="trash"></button>	
			<button id="btn_stampa_lista" class="uk-button uk-button-primary uk-button-small">Stampa lista<span class="uk-margin-small-left" uk-icon="print"></button>	
			<button id="btn_stampa" class="uk-button uk-button-primary uk-button-small" disabled>Stampa ricevuta<span class="uk-margin-small-left" uk-icon="print"></button>	
		</div>
		<div class="uk-search uk-search-default">
			<span class="uk-search-icon-flip" uk-search-icon></span>
			<input id="input_search" class="uk-search-input uk-form-small" type="search" name="text_search" value="" placeholder="Cerca...">
		</div>
</div>