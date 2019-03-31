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

<body class="uk-background-muted">
<div class="uk-grid" uk-grid> <!-- inizio griglia-->
  <div class="uk-width-1-1">         <!-- inizio colonna -->  
    <nav class="uk-background-primary uk-box-shadow-medium" uk-navbar> <!-- navbar -->
        <div class="uk-navbar-left">
          <ul class="uk-navbar-nav">
            <li> <!-- logo -->
              <a href="" class="uk-navbar-item uk-logo">
                <img class="uk-height-1-1" src="{{ asset('storage/images/logo.png') }}" style="width: 75px" alt="Sinx"/>
              </a>
            </li>
            <li> <!-- versione -->
            <span class="uk-label uk-label-success uk-text-lowercase"> @lang('navbar.version')</span>
            </li>
          </ul>
        </div>
        <div class="uk-navbar-center">
          <div class="uk-navbar-item">
            <!-- breve descrizione -->
                <div class="uk-light uk-text-small uk-visible@m">@lang('navbar.presentation_sw') </div>
          </div>
        </div>
        <div class="uk-navbar-right uk-width-auto uk-margin-small-right">
            <!-- Menu principale -->
            <ul class="uk-navbar-nav ">
                        <li>
                            <!-- pulsante -->
                            <div class="uk-navbar-item">
                                    <a href="" class="uk-light" uk-icon="icon: grid; ratio: 2;"></a>
                                    
                            </div>
                            <!-- dropdown-->
                            <div class="uk-navbar-dropdown uk-width-large" uk-drop="mode: click">
                        
                                <ul class="uk-nav-primary uk-nav-parent-icon" uk-nav>

                                          <li class="uk-parent">
                                              <!--Associazione-->
                                              <a href="#"> 
                                                  <span class="uk-margin-small-right" uk-icon="bookmark"></span> <!-- icona -->
                                                   @lang('menu.associazione')
                                              </a>
                                                  <ul class="uk-nav-sub">
                                                      <li><a class="item" href='{{ route("dati_associazione") }}' title="Per gestire l'Associazione">
                                                        <span class="uk-margin-small-right" uk-icon="italic"></span>A--- @lang('menu.dati_associazione') </a></li>
                                                  </ul>
                                          </li>
                            
                                          <li class="uk-parent"> 
                                              <!-- anagrafica -->
                                              <a href="#">
                                                  <span class="uk-margin-small-right" uk-icon="users"></span> <!-- icona -->
                                                  @lang('menu.anagrafica')
                                              </a>
                                                <ul class="uk-nav-sub">
                                                    <li><a class="item" href='{{ route("gestione") }}'><span class="uk-margin-small-right" uk-icon="users"></span>Aox- -@lang('menu.gestione')</a></li>
                                                    <li><a class="item" href='<?// echo site_url("anagrafica/csv")?>'><span class="uk-margin-small-right" uk-icon="copy"></span>Axxx -@lang('menu.importa_csv')</a></li>
                                                    <li><a class="item" href='{{ route("rubrica") }}'><span class="uk-margin-small-right" uk-icon="list"></span>Aola -@lang('menu.rubrica')</a></li>
                                                    <li><a class="item" href='{{ route("libro_soci") }}'><span class="uk-margin-small-right" uk-icon="push"></span>Aola -@lang('menu.libro_soci')</a></li>     
                                                </ul>
                                          </li>
                                              
                                          <li class="uk-parent"> 
                                            <!--contabilitĂ -->
                                            <a href="#">
                                                <span class="uk-margin-small-right" uk-icon="album"></span> <!-- icona -->
                                                @lang('menu.contabilita')
                                            </a>
                                              
                                                  <ul class="uk-nav-sub">
                                                      <li><a class="item" href='./InsPrimanota.php'><span class="uk-margin-small-right" uk-icon="italic"></span>Aoxx -@lang('menu.prima_nota')</a></li>
                                                      <li><a class="item" href='./InsRicFisc.php'><span class="uk-margin-small-right" uk-icon="italic"></span>Aoxx -@lang('menu.ricevuta')</a></li>
                                                      <li><a class="item" href='./InsFattura.php'><span class="uk-margin-small-right" uk-icon="italic"></span>Aoxx -@lang('menu.fattura')</a></li>
                                                      <li><a class="item" href='./InsContoEconomico.php'><span class="uk-margin-small-right" uk-icon="italic"></span>Aox- -@lang('menu.conto_economico')</a></li>
                                                      <li><a class="item" href='./InsStatoPatrimoniale.php'><span class="uk-margin-small-right" uk-icon="italic"></span>Aox- -@lang('menu.stato_patrimoniale')</a></li>
                                                      <li><a class="item" href='./Rendiconto.php'><span class="uk-margin-small-right" uk-icon="italic"></span>Aox- -@lang('menu.rendiconto')</a></li>
                                                      <li><a class="item" href='./Nuovo_Anno_soc.php'><span class="uk-margin-small-right" uk-icon="italic"></span>Axxx -@lang('menu.nuovo_anno_sociale')</a></li> 
                                                  </ul>
                                          </li>
                                                     
                                          <li class="uk-parent"> 
                                               <!--gestione-->
                                            <a href="#">
                                                <span class="uk-margin-small-right" uk-icon="cog"></span> <!-- icona -->
                                                @lang('menu.gestione')
                                            </a>         
                                                  
                                                  <ul class="uk-nav-sub">
                                                      <li><a class="item" href='<?// echo site_url("gestione/moduli")?>'><span class="uk-margin-small-right" uk-icon="italic"></span>Aoxa -@lang('menu.moduli')</a></li>
                                                      <li><a class="item" href='<?// echo site_url("gestione/calendario")?>'><span class="uk-margin-small-right" uk-icon="italic"></span>Aox- -@lang('menu.calendario')</a></li>
                                                      <li><a class="item" href='<?// echo site_url("gestione/rapidi")?>'><span class="uk-margin-small-right" uk-icon="link"></span>Axxx - @lang('menu.rapidi')</a></li>     
                                                      <li><a class="item" href='<?// echo site_url("gestione/blocco_note")?>'><span class="uk-margin-small-right" uk-icon="italic"></span>Ao-a - @lang('menu.blocco_note')</a></li>
                                                      <li><a class="item" href='<?// echo site_url("gestione/e_mail")?>'><span class="uk-margin-small-right" uk-icon="italic"></span>Aox- -@lang('menu.e_mail')</a></li>
                                                      <li><a class="item" href='{{ route("utenti") }}'><span class="uk-margin-small-right" uk-icon="italic"></span>Aola -@lang('menu.utenti')</a></li>
                                                      <li><a class="item" href='<?// echo site_url("gestione/files")?>'><span class="uk-margin-small-right" uk-icon="italic"></span>Axx- -@lang('menu.files_immagini')</a></li>
                                                      <li><a class="item" href='<?// echo site_url("gestione/log")?>'><span class="uk-margin-small-right" uk-icon="italic"></span>Axxx -@lang('menu.log')</a></li>
                                                      <li><a class="item" href='<?// echo site_url("gestione/backup")?>'><span class="uk-margin-small-right" uk-icon="italic"></span>Axxx - @lang('menu.backup')</a></li>        
                                                  </ul>
                                          </li>
                            
                                          <li class="uk-parent"> 
                                            <!--specifiche-->
                                            <a href="#">
                                                <span class="uk-margin-small-right" uk-icon="info"></span> <!-- icona -->
                                                @lang('menu.specifiche')
                                            </a>
                                                  
                                                  <ul class="uk-nav-sub">
                                                      <li><a class="item" href='./Scheda_regioni.php'><span class="uk-margin-small-right" uk-icon="italic"></span>A-x- -Regioni Province e Comuni</a></li>
                                                      <li><a class="item" href='./nclasse.php'><span class="uk-margin-small-right" uk-icon="italic"></span>A-x- -@lang('menu.funzioni_associati')</a></li>
                                                      <li><a class="item" href='./nmateria.php'><span class="uk-margin-small-right" uk-icon="italic"></span>A-x- -@lang('menu.tipologia_associati')</a></li>
                                                      <li><a class="item" href='./Licenza.php'><span class="uk-margin-small-right" uk-icon="italic"></span>Aola -@lang('menu.licenza')</a></li>        
                                                  </ul>
                                          </li>
                            
                                            <li>
                                                <a class="item" href='./Manuale.php'>
                                                    <span class="uk-margin-small-right" uk-icon="question"></span> <!-- icona -->
                                                    @lang('menu.manuale')
                                                </a>
                                            </li>
                            
                                            <li class="uk-nav-divider"></li>
                                                <!--dati associazione-->
                                                    <ul class="uk-list">
                                                        <li>
                                                            <span uk-icon="info"></span>
                                                            <span class="uk-text-small uk-text-meta uk-text-capitalize">{{ $associazione->nome }}</span>
                                                        </li>
                                                        <li>
                                                            <span uk-icon="location"></span>
                                                            <span class="uk-text-small uk-text-meta uk-text-capitalize">{{ $associazione->indirizzo }}</span>
                                                        </li>
                                                    </ul>
                                                <!-- link rapidi ai siti attinenti all'associazione -->
                                            <?// $links=quick_links(); //var_dump($links);
                                            ?>
                                                <h6 class="uk-heading-line uk-text-center uk-margin-remove-top"><span>Link rapidi</span></h6>
                                                <ul class="uk-iconnav">
                                                    <li uk-tooltip="title:@lang('menu.sito_web'); pos: bottom"><a href="<?(!empty($links['web_site']))? $links['web_site'] : '' ?>" target="_blank" uk-icon="icon: world"></a></li>
                                                    <li uk-tooltip="title:@lang('menu.web_mail'); pos: bottom"><a href="<?(!empty($links['web_mail'])) ? $links['web_mail'] : '' ?>" target="_blank" uk-icon="icon: mail"></a></li>
                                                    <li uk-tooltip="title:@lang('menu.web_mail_pec'); pos: bottom"><a href="<?(!empty($links['web_mail_pec'])) ? $links['web_mail_pec'] : '' ?>" target="_blank" uk-icon="icon: mail"></a></li>
                                                    <li uk-tooltip="title:@lang('menu.facebook'); pos: bottom"><a href="<?(!empty($links['facebook'])) ? $links['facebook'] : '' ?>" target="_blank" uk-icon="icon: facebook"></a></li>
                                                    <li uk-tooltip="title:@lang('menu.instagram'); pos: bottom"><a href="<?(!empty($links['instagram'])) ? $links['instagram'] : '' ?>" target="_blank" uk-icon="icon: instagram"></a></li>
                                                    <li uk-tooltip="title:@lang('menu.youtube'); pos: bottom"><a href="<?(!empty($links['youtube'])) ? $links['youtube'] : '' ?>" target="_blank" uk-icon="icon: youtube"></a></li>
                                                    <li uk-tooltip="title:<?// echo lang('twitter'); ?>; pos: bottom"><a href="@(!empty($links['twitter'])) ? $links['twitter'] : '' ?>" target="_blank" uk-icon="icon: twitter"></a></li>
                                                    <li uk-tooltip="title:<?// echo lang('home_banking'); ?>; pos: bottom"><a href="@(!empty($links['home_banking'])) ? $links['home_banking'] : '' ?>" target="_blank" uk-icon="icon: home"></a></li>
                                                </ul>
                                </ul>      

                            </div>

                        </li>
            </ul>
            <!-- Menu utente -->
            <ul class="uk-navbar-nav ">
                        <li>
                            <!-- pulsante utente -->
                            <div class="uk-navbar-item">
                                    <a href="">
                                            <img class="uk-border-circle" src="http://i.pravatar.cc/50" width="50" height="50" alt="Border circle">
                                    </a>
                            </div>
                            <!-- dropdown -->
                            <div class="uk-navbar-dropdown uk-width-medium uk-padding-remove" uk-drop="mode: click; pos: bottom-left;">
                        
                                    <ul class="uk-nav-default uk-nav-parent-icon" uk-nav>
                                        <!-- dati utente -->
                                            <!-- card -->
                                            <div class="uk-card uk-card-default">
                                                    <div class="uk-card-header">
                                                            <div class="uk-grid-small uk-flex-middle" uk-grid>
                                                                    <div class="uk-width-auto">
                                                                        <img class="uk-border-circle" width="75" height="75" src="http://i.pravatar.cc/75">
                                                                    </div>
                                                                    <div class="uk-width-expand">
                                                                        <h3 class="uk-card-title uk-margin-remove-bottom">{{ Auth::user()->username }}</h3>
                                                                        <p class="uk-text-meta uk-margin-remove-top">{{ Auth::user()->livello }}</p>
                                                                    </div>
                                                                </div>
                                                    </div>
                                                    <div class="uk-card-body">
                                                            <!-- list -->
                                                        <ul class="uk-list">
                                                            <li>
                                                                <span uk-icon="user"></span>
                                                                <span class="uk-text-small uk-text-meta uk-text-capitalize"> {{ Auth::user()->username }} </span>
                                                            </li>
                                                            <li>
                                                                <span uk-icon="info"></span>
                                                                <span class="uk-text-small uk-text-meta uk-text-capitalize"> {{ Auth::user()->nome }} </span>
                                                            </li>
                                                            <li>
                                                                <span uk-icon="bolt"></span>
                                                                <span class="uk-text-small uk-text-meta uk-text-capitalize"> {{ Auth::user()->livello }} </span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="uk-card-footer">
                                                            <li>
                                                                    <a uk-toggle="target: #logout" class="uk-button uk-button-primary" href='./logout.php'>
                                                                    <span class="uk-margin-small-right" uk-icon="sign-out"></span> <!-- icona -->
                                                                        @lang('navbar.logout')
                                                                    </a>
                                                            </li>
                                                    </div>
                                            
                                        </div>
                                          

                                    </ul>      
    
                            </div>
                        </li>
            </ul>
        </div>


        <!-- Finestra conferma logout-->
        <div id="logout" uk-modal>
          <div class="uk-modal-dialog uk-modal-body">
            <h2 class="uk-modal-title">Conferma logout</h2>
              <p>Sei sicuro di uscire dall applicazione?</p>
              <p class="uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
            <a href="" uk-toggle="target: #logout" class="uk-button uk-button-primary">Ok</a>
        </p>
        </div>
        
</div>
    </nav>
  </div> <!--fine colonna -->
 
  <!--colonna menu mobile (mostrata < 960px)-->
<div class="uk-width-auto uk-hidden@m"> 
  <!-- icona hamburger per aperture menu mobile -->
  <a class="uk-navbar-toggle" uk-navbar-toggle-icon href="" uk-toggle="target: #menu_mobile"></a>
  <div id="menu_mobile" uk-offcanvas>
      <div class="uk-offcanvas-bar">
          <!-- dati utente -->
          <ul class="uk-list">
                 @lang('menu.auth.failed')
              <li>
                  <span uk-icon="user"><?php echo __('auth.failed'); ?></span>
                  <span class="uk-text-small uk-text-meta uk-text-capitalize"><?// //echo $_SESSION['user']['nome'];?></span>
              </li>
              <li>
                  <span uk-icon="bolt"></span>
                  <span class="uk-text-small uk-text-meta uk-text-capitalize"><?// //echo $_SESSION['user']['livello']; ?></span>


              </li>
          </ul>
          <ul class="uk-nav uk-nav-default uk-nav-parent-icon" uk-nav="multiple: true">
          <li class="uk-parent">
                  <!--Associazione-->
                  <a href="#"> 
                      <span class="uk-margin-small-right" uk-icon="bookmark"></span> <!-- icona -->
                      <?//php //echo lang('associazione'); ?>
                      <? echo trans('auth.failed');?>
                  </a>
                      <ul class="uk-nav-sub">
                          <li><a class="item" href='<?// echo site_url("associazione/dati_associazione") ?>' title="Per gestire l'Associazione"><span>A--- -<?// echo lang('dati_associazione'); ?></span></a></li>
                      </ul>
              </li>

              <li class="uk-parent"> 
                  <!-- anagrafica -->
                  <a href="#"><?////php echo lang('anagrafica'); ?></a>
                  <ul class="uk-nav-sub">
                      <li><a class="item" href='<?//// echo site_url("anagrafica/associati") ?>'>Axxx -<?////php echo lang('associati'); ?></a></li>
                      <li><a class="item" href='<?//// echo site_url("anagrafica/collaboratori")?>'>Axxx -<?////php echo lang('altri'); ?></a></li>
                      <li><a class="item" href='<?//// echo site_url("anagrafica/csv")?>'>Axxx -@lang('menu.importa_csv'); ?></a></li>
                      <li><a class="item" href='<?// echo site_url("anagrafica/ricerca")?>'>Aox- -@lang('menu.cerca'); ?></a></li>
                      <li><a class="item" href='<?// echo site_url("anagrafica/rubrica")?>'>Aola -@lang('menu.rubrica'); ?></a></li>
                      <li><a class="item" href='<?// echo site_url("anagrafica/libro_soci")?>'>Aola -@lang('menu.libro_soci'); ?></a></li>     
                  </ul>
              </li>
                  

              <li class="uk-parent"> 
              <!--contabilitĂ -->
              <a href="#">@lang('menu.contabilita'); ?></a>
                  
                      <ul class="uk-nav-sub">
                          <li><a class="item" href='./InsPrimanota.php'>Aoxx -@lang('menu.prima_nota'); ?></a></li>
                          <li><a class="item" href='./InsRicFisc.php'>Aoxx -@lang('menu.ricevuta'); ?></a></li>
                          <li><a class="item" href='./InsFattura.php'>Aoxx -@lang('menu.fattura'); ?></a></li>
                          <li><a class="item" href='./InsContoEconomico.php'>Aox- -@lang('menu.conto_economico'); ?></a></li>
                          <li><a class="item" href='./InsStatoPatrimoniale.php'>Aox- -@lang('menu.stato_patrimoniale'); ?></a></li>
                          <li><a class="item" href='./Rendiconto.php'>Aox- -@lang('menu.rendiconto'); ?></a></li>
                          <li><a class="item" href='./Nuovo_Anno_soc.php'>Axxx -@lang('menu.nuovo_anno_sociale'); ?></a></li> 
                      </ul>
                  </li>
                  

              <li class="uk-parent"> 
              <!--gestione-->
              <a href="#">@lang('menu.gestione'); ?></a>         
                      
                      <ul class="uk-nav-sub">
                          <li><a class="item" href='./CompModuli.php'>Aoxa -@lang('menu.moduli'); ?></a></li>
                          <li><a class="item" href='./Calendario2.php'>Aox- -@lang('menu.calendario'); ?></a></li>
                          <li><a class="item" href='./InsNotepad.php'>Ao-a - @lang('menu.blocco_note'); ?></a></li>
                          <li><a class="item" href='./Comp_email.php'>Aox- -@lang('menu.e_mail');?></a></li>
                          <li><a class="item" href='./InsUtente.php'>Aola -@lang('menu.utenti'); ?></a></li>
                          <li><a class="item" href='./Files.php'>Axx- -@lang('menu.files_immagiini'); ?></a></li>
                          <li><a class="item" href='./Log.php'>Axxx -@lang('menu.log'); ?></a></li>
                          <li><a class="item" href='./Rip_database.php'>Axxx - <?//php lang('backup'); ?></a></li>        
                      </ul>
              </li>

              <li class="uk-parent"> 
              <!--specifiche-->
              <a href="#"><?//php  echo lang('specifiche'); ?></a>
                      
                      <ul class="uk-nav-sub">
                          <li><a class="item" href='./Scheda_regioni.php'>A-x- -Regioni Province e Comuni</a></li>
                          <li><a class="item" href='./nclasse.php'>A-x- -@lang('menu.funzioni_associati'); ?></a></li>
                          <li><a class="item" href='./nmateria.php'>A-x- -@lang('menu.tipologia_associati'); ?></a></li>
                          <li><a class="item" href='./Licenza.php'>Aola -<?// echo lang('licenza'); ?></a></li>        
                      </ul>
              </li>

              <li><a class="item" href='./Manuale.php'>@lang('menu.manuale'); ?></a></li>

              <li><a class="item"href='./logout.php'>@lang('menu.uscita'); ?></a></li>
              
          </ul>
          <!--dati associazione-->    
          <?//php $_SESSION['association']['r_nome']; ?></span>
                  </li>
              </ul>
      </div>
  </div>
</div>

<!--colonna menu desktop (mostrata > 960px)-->
<!--div class="uk-width-1-6 uk-visible@m" style=""-->   <!-- inizio colonna 1/6 -->
    


</div> <!--fine colonna -->

<div class="uk-width-expand@m">   <!-- inizio colonna (prende il posto che rimane della "riga")  -->

   @component('components.breadcrumb') @endcomponent

  <div class="uk-section uk-padding-small"> <!-- sezione -->
        
        <div class="uk-container uk-container-expand"> <!-- container (padding) -->
            
            <h3 class="uk-text-center uk-heading-line"> <!-- titolo pagina -->
                    <span>@yield('page_title','No title page!')</span>
            </h3>

                    @yield('page_content','No page content!')

        </div> <!-- fine container -->
    
    </div> <!-- fine sezione -->
    
</div> <!--fine colonna -->





<!-- script x orologio -->
<script src="<?php // //echo base_url('assets/js/get_time.js');?>"></script> 
<link rel="stylesheet" type="text/css" href="<?php //echo base_url('assets/css/calendario.css');?>">

<div class="uk-width-auto">   <!-- inizio colonna 1/6 -->

<div class="uk-offcanvas-content">

<button class="uk-button uk-button-default" type="button" uk-toggle="target: #offcanvas-flip"><</button>

<div id="offcanvas-flip" uk-offcanvas="flip: true; overlay: true">
	<div class="uk-offcanvas-bar">

		<button class="uk-offcanvas-close" type="button" uk-close></button>

		<div class="uk-inline">
		<link href='https://fonts.googleapis.com/css?family=Orbitron' rel='stylesheet' type='text/css'>
				<div class="uk-position-relative uk-position-top-center uk-box-shadow-medium"> <!-- orologio -->
					<span class="uk-margin-small-right" uk-icon="clock"  style="font-family: 'Orbitron', sans-serif;"></span> <!-- icona -->
					<span id="clock" class="uk-text-bold"></span>
				</div>
				<!-- Wrapper -->
				<div class="uk-position-relative" id="wrapper">
					<!-- elementi del calendario -->
					<div id="events-calendar"></div>
					<!-- appuntamenti -->
					<div id="events"></div>
					<!-- Clear -->
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
		</div>
				<script src="<?php //echo base_url('assets/js/calendario.js');?>"></script> 
		
	</div>
</div>

</div>
</div> <!-- fine colonna -->


<div class="uk-width-1-1 uk-text-center uk-text-bottom">         <!-- inizio colonna -->  
    
  <span class="uk-text-meta uk-text-bottom">
  Sinx From Scratch &copy; Copyright 2018 by Marco Pedrazzi <br>
  Ogni aiuto รจ ben accetto, per maggiori informazioni: <tt><a target='_target' href="https://github.com/elmer120/Sinx_Fs">Clicca qui</a></tt> <br>
  This is free software, and you are welcome to redistribute it
  under certain conditions: <tt><a target='_target' href="http://www.gnu.org/licenses/gpl-3.0.html">Click here</a></tt> for details.
  </span>
</div>
</div> <!-- fine griglia -->
</div>

</body>
</html>
