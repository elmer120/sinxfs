<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <!--link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css"-->

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet"> 
        <script src="{{ asset('js/app.js') }}"></script>
       
        
    </head>
    <body>
    <div class="uk-grid" uk-grid> <!-- inizio griglia small gutter-->
  <div class="uk-width-1-1">         <!-- inizio colonna -->  
    <nav class="uk-background-primary" uk-navbar> <!-- navbar -->
        <div class="uk-navbar-left">
          <ul class="uk-navbar-nav">
            <li> <!-- logo -->
              <a href="" class="uk-navbar-item uk-logo">
                <img class="uk-height-1-1" src="https://picsum.photos/75" alt="Sinx"/>
              </a>
            </li>
            <li> <!-- versione -->
            <span class="uk-label uk-label-success uk-text-lowercase"> 0.0.1 </span>
            </li>
          </ul>
        </div>
        <div class="uk-navbar-center">
          <div class="uk-navbar-item">
            <!-- breve descrizione -->
                <div class="uk-light uk-text-small uk-visible@m"> test progetto </div>
          </div>
        </div>
        <div class="uk-navbar-right">
          <div class="uk-navbar-item"> <!-- logout -->
            <a uk-toggle="target: #logout" class="uk-button uk-button-secondary">Logout</a>
          </div>
        </div>
        <!-- Finestra conferma logout-->
        <div id="logout" uk-modal>
          <div class="uk-modal-dialog uk-modal-body">
            <h2 class="uk-modal-title">Conferma logout</h2>
              <p>Sei sicuro di uscire dall'applicazione?</p>
              <p class="uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
            <a href="" uk-toggle="target: #logout" class="uk-button uk-button-primary">Ok</a>
        </p>
        </div>
</div>
    </nav>
  </div> <!--fine colonna -->
    </body>
</html>
