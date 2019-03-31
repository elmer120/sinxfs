<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link href="{{ asset('css/app.css') }}" rel="stylesheet"> 
        <script src="{{ asset('js/app.js') }}"></script>
        <!--carico jquery-->
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script> -->
        <!-- jsCalendar style -->
        <!-- <link rel="stylesheet" type="text/css" href="<?//php //echo base_url('assets/jsCalendar/source/jsCalendar.css');?>"> -->
        <!-- jsCalendar script -->
        <!-- <script type="text/javascript" src="<?//php //echo base_url('assets/jsCalendar/source/jsCalendar.js');?>"></script> -->
        <!-- jsCalendar Italian language -->
        <!-- <script type="text/javascript" src="<?//php //echo base_url('assets/jsCalendar/source/jsCalendar.lang.it.js');?>"></script> -->
        <title>@yield('tab_title','No tab_title!')</title>
</head>

<body>
    <!-- header -->
                <div class="uk-card uk-card-small">
                    <div class="uk-text-center uk-text-meta uk-card-body">
                    <img class="uk-border-circle" width="50" height="50" src="">
                        <span class="uk-text-emphasis uk-text-bold">{{ $associazione->nome }}</span><br>
                        <span>{{ $associazione->indirizzo }}, - {{ $associazione->cap }} {{ $associazione->comune }} {{ "(".$associazione->provincia_sigla.")" }} </span>                       
                        <br>
                        <span>{{ "Tel: ".$associazione->telefono }} - {{ "Tel: ".$associazione->telefono_ext }} - {{ "Email: ".$associazione->email }}</span>
                        <br>
                        <span>{{ "Cf: ".$associazione->codice_fiscale }} - {{ "Pi: ".$associazione->partita_iva }} </span>
                        
                    </div>
                </div>
        <hr>
        
        <!-- contenuto pagina -->
        @yield('page_content','No page content!')
        

        <div class="uk-position-relative uk-position-bottom-left uk-text-meta">Generato il {{ date('d/m/Y') }} da Sinxfs - www.sinxfs.it</div>

</body>
</html>
