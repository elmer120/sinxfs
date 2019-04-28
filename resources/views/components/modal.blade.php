<!-- Finestra modal {{ $modal_id }}-->

<div id="{{ $modal_id }}" class="uk-modal-container" uk-modal='{"bg-close":false}'>
		
	<div class="uk-modal-dialog" uk-overflow-auto>
			
			<!-- header -->
			<div class="uk-modal-header">
						<h2 class="uk-modal-title" id="title">{{ $title }}</h2>
				<span class="uk-text-danger">Richiesto *</span>
			</div>
			<!-- body -->  
			<div class="uk-modal-body">
			
				{{ $slot }}
				
			<div id="modal_loading" class="uk-position-cover uk-overlay uk-overlay-default uk-flex uk-flex-center uk-flex-middle uk-hidden">
				<div uk-spinner="ratio: 3"></div>
			</div>
				
			</div>
			<!-- footer -->
			<div class="uk-modal-footer">
				<button id="btn_annulla" class="uk-button uk-button-default uk-modal-close" type="button">Annulla</button>
				<input  id="btn_submit" class="uk-button uk-button-primary" type="submit" name="submit" value="{{ $btn_text }}">
			</div>
			
				</form>
				
	</div>
</div>


	