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
              <li>
                  <span uk-icon="user"></span>
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
                      <li><a class="item" href='<?//// echo site_url("anagrafica/csv")?>'>Axxx -<?//php echo lang('importa_csv'); ?></a></li>
                      <li><a class="item" href='<?// echo site_url("anagrafica/ricerca")?>'>Aox- -<?//php echo lang('cerca'); ?></a></li>
                      <li><a class="item" href='<?// echo site_url("anagrafica/rubrica")?>'>Aola -<?//php echo lang('rubrica'); ?></a></li>
                      <li><a class="item" href='<?// echo site_url("anagrafica/libro_soci")?>'>Aola -<?//php echo lang('libro_soci'); ?></a></li>     
                  </ul>
              </li>
                  

              <li class="uk-parent"> 
              <!--contabilitĂ -->
              <a href="#"><?//php echo lang('contabilita'); ?></a>
                  
                      <ul class="uk-nav-sub">
                          <li><a class="item" href='./InsPrimanota.php'>Aoxx -<?//php echo lang('prima_nota'); ?></a></li>
                          <li><a class="item" href='./InsRicFisc.php'>Aoxx -<?//php echo lang('ricevuta'); ?></a></li>
                          <li><a class="item" href='./InsFattura.php'>Aoxx -<?//php echo lang('fattura'); ?></a></li>
                          <li><a class="item" href='./InsContoEconomico.php'>Aox- -<?//php echo lang('conto_economico'); ?></a></li>
                          <li><a class="item" href='./InsStatoPatrimoniale.php'>Aox- -<?//php echo lang('stato_patrimoniale'); ?></a></li>
                          <li><a class="item" href='./Rendiconto.php'>Aox- -<?//php echo lang('rendiconto'); ?></a></li>
                          <li><a class="item" href='./Nuovo_Anno_soc.php'>Axxx -<?//php echo lang('nuovo_anno_sociale'); ?></a></li> 
                      </ul>
                  </li>
                  

              <li class="uk-parent"> 
              <!--gestione-->
              <a href="#"><?//php echo lang('gestione'); ?></a>         
                      
                      <ul class="uk-nav-sub">
                          <li><a class="item" href='./CompModuli.php'>Aoxa -<?//php echo lang('moduli'); ?></a></li>
                          <li><a class="item" href='./Calendario2.php'>Aox- -<?//php echo lang('calendario'); ?></a></li>
                          <li><a class="item" href='./InsNotepad.php'>Ao-a - <?//php echo lang('blocco_note'); ?></a></li>
                          <li><a class="item" href='./Comp_email.php'>Aox- -<?//php echo lang('e_mail');?></a></li>
                          <li><a class="item" href='./InsUtente.php'>Aola -<?//php echo lang('utenti'); ?></a></li>
                          <li><a class="item" href='./Files.php'>Axx- -<?//php echo lang('files_immagiini'); ?></a></li>
                          <li><a class="item" href='./Log.php'>Axxx -<?//php echo lang('log'); ?></a></li>
                          <li><a class="item" href='./Rip_database.php'>Axxx - <?//php lang('backup'); ?></a></li>        
                      </ul>
              </li>

              <li class="uk-parent"> 
              <!--specifiche-->
              <a href="#"><?//php  echo lang('specifiche'); ?></a>
                      
                      <ul class="uk-nav-sub">
                          <li><a class="item" href='./Scheda_regioni.php'>A-x- -Regioni Province e Comuni</a></li>
                          <li><a class="item" href='./nclasse.php'>A-x- -<?//php echo lang('funzioni_associati'); ?></a></li>
                          <li><a class="item" href='./nmateria.php'>A-x- -<?//php echo lang('tipologia_associati'); ?></a></li>
                          <li><a class="item" href='./Licenza.php'>Aola -<?// echo lang('licenza'); ?></a></li>        
                      </ul>
              </li>

              <li><a class="item" href='./Manuale.php'><?//php echo lang('manuale'); ?></a></li>

              <li><a class="item"href='./logout.php'><?//php echo lang('uscita'); ?></a></li>
              
          </ul>
          <!--dati associazione-->    
          <?//php $_SESSION['association']['r_nome']; ?></span>
                  </li>
              </ul>
      </div>
  </div>
</div>

<!--colonna menu desktop (mostrata > 960px)-->
<div class="uk-width-auto uk-visible@m" style="min-width: 250px">   <!-- inizio colonna 1/6 -->

  <div class="uk-card uk-card-default uk-card-small uk-card-hover">
      <div class="uk-card-header">
          <!-- dati utente -->
        
          <ul class="uk-list">
              <li>
                  <span uk-icon="user"></span>
                  <span class="uk-text-small uk-text-meta uk-text-capitalize"><?// echo $_SESSION['user']['nome'];?></span>
              </li>
              <li>
                  <span uk-icon="info"></span>
                  <span class="uk-text-small uk-text-meta uk-text-capitalize"><?// echo $_SESSION['user']['email'];?></span>
              </li>
              <li>
                  <span uk-icon="bolt"></span>
                  <span class="uk-text-small uk-text-meta uk-text-capitalize"><?// echo $_SESSION['user']['livello']; ?></span>
              </li>
          </ul>
      </div>
      <div class="uk-card-body uk-link-reset">
          <ul class="uk-nav uk-nav-default uk-nav-parent-icon" uk-nav="multiple: true">
              <li class="uk-parent">
                  <!--Associazione-->
                  <a href="#"> 
                      <span class="uk-margin-small-right" uk-icon="bookmark"></span> <!-- icona -->
                      <?//php echo lang('associazione'); ?>
                  </a>
                      <ul class="uk-nav-sub">
                          <li><a class="item" href='<?// echo site_url("associazione/dati_associazione") ?>' title="Per gestire l'Associazione"><span class="uk-margin-small-right" uk-icon="italic"></span>A--- -<?// echo lang('dati_associazione'); ?></a></li>
                      </ul>
              </li>

              <li class="uk-parent"> 
                  <!-- anagrafica -->
                  <a href="#">
                      <span class="uk-margin-small-right" uk-icon="users"></span> <!-- icona -->
                      <?//php echo lang('anagrafica'); ?>
                  </a>
                  <ul class="uk-nav-sub">
                      <li><a class="item" href='<?// echo site_url("anagrafica/associati")?>'><span class="uk-margin-small-right" uk-icon="users"></span>Axxx -<?//php echo lang('associati'); ?></a></li>
                      <li><a class="item" href='<?// echo site_url("anagrafica/collaboratori")?>'><span class="uk-margin-small-right" uk-icon="user"></span>Axxx -<?//php echo lang('altri'); ?></a></li>
                      <li><a class="item" href='<?// echo site_url("anagrafica/csv")?>'><span class="uk-margin-small-right" uk-icon="copy"></span>Axxx -<?//php echo lang('importa_csv'); ?></a></li>
                      <li><a class="item" href='<?// echo site_url("anagrafica/ricerca")?>'><span class="uk-margin-small-right" uk-icon="search"></span>Aox- -<?//php echo lang('cerca'); ?></a></li>
                      <li><a class="item" href='<?// echo site_url("anagrafica/rubrica")?>'><span class="uk-margin-small-right" uk-icon="list"></span>Aola -<?//php echo lang('rubrica'); ?></a></li>
                      <li><a class="item" href='<?// echo site_url("anagrafica/libro_soci")?>'><span class="uk-margin-small-right" uk-icon="push"></span>Aola -<?//php echo lang('libro_soci'); ?></a></li>     
                  </ul>
              </li>
                  

              <li class="uk-parent"> 
                <!--contabilitĂ -->
          <a href="#">
            <span class="uk-margin-small-right" uk-icon="album"></span> <!-- icona -->
            <?//php echo lang('contabilita'); ?>
          </a>
                  
                      <ul class="uk-nav-sub">
                          <li><a class="item" href='./InsPrimanota.php'><span class="uk-margin-small-right" uk-icon="italic"></span>Aoxx -<?//php echo lang('prima_nota'); ?></a></li>
                          <li><a class="item" href='./InsRicFisc.php'><span class="uk-margin-small-right" uk-icon="italic"></span>Aoxx -<?//php echo lang('ricevuta'); ?></a></li>
                          <li><a class="item" href='./InsFattura.php'><span class="uk-margin-small-right" uk-icon="italic"></span>Aoxx -<?//php echo lang('fattura'); ?></a></li>
                          <li><a class="item" href='./InsContoEconomico.php'><span class="uk-margin-small-right" uk-icon="italic"></span>Aox- -<?//php echo lang('conto_economico'); ?></a></li>
                          <li><a class="item" href='./InsStatoPatrimoniale.php'><span class="uk-margin-small-right" uk-icon="italic"></span>Aox- -<?//php echo lang('stato_patrimoniale'); ?></a></li>
                          <li><a class="item" href='./Rendiconto.php'><span class="uk-margin-small-right" uk-icon="italic"></span>Aox- -<?//php echo lang('rendiconto'); ?></a></li>
                          <li><a class="item" href='./Nuovo_Anno_soc.php'><span class="uk-margin-small-right" uk-icon="italic"></span>Axxx -<?//php echo lang('nuovo_anno_sociale'); ?></a></li> 
                      </ul>
              </li>
                  

              <li class="uk-parent"> 
                   <!--gestione-->
          <a href="#">
            <span class="uk-margin-small-right" uk-icon="cog"></span> <!-- icona -->
            <?//php echo lang('gestione'); ?>
          </a>         
                      
                      <ul class="uk-nav-sub">
                          <li><a class="item" href='<?// echo site_url("gestione/moduli")?>'><span class="uk-margin-small-right" uk-icon="italic"></span>Aoxa -<?//php echo lang('moduli'); ?></a></li>
                          <li><a class="item" href='<?// echo site_url("gestione/calendario")?>'><span class="uk-margin-small-right" uk-icon="italic"></span>Aox- -<?//php echo lang('calendario'); ?></a></li>
                          <li><a class="item" href='<?// echo site_url("gestione/rapidi")?>'><span class="uk-margin-small-right" uk-icon="link"></span>Axxx - <?//php echo lang('rapidi'); ?></a></li>     
                          <li><a class="item" href='<?// echo site_url("gestione/blocco_note")?>'><span class="uk-margin-small-right" uk-icon="italic"></span>Ao-a - <?//php echo lang('blocco_note'); ?></a></li>
                          <li><a class="item" href='<?// echo site_url("gestione/e_mail")?>'><span class="uk-margin-small-right" uk-icon="italic"></span>Aox- -<?//php echo lang('e_mail');?></a></li>
                          <li><a class="item" href='<?// echo site_url("gestione/utenti")?>'><span class="uk-margin-small-right" uk-icon="italic"></span>Aola -<?//php echo lang('utenti'); ?></a></li>
                          <li><a class="item" href='<?// echo site_url("gestione/files")?>'><span class="uk-margin-small-right" uk-icon="italic"></span>Axx- -<?//php echo lang('files_immagini'); ?></a></li>
                          <li><a class="item" href='<?// echo site_url("gestione/log")?>'><span class="uk-margin-small-right" uk-icon="italic"></span>Axxx -<?//php echo lang('log'); ?></a></li>
                          <li><a class="item" href='<?// echo site_url("gestione/backup")?>'><span class="uk-margin-small-right" uk-icon="italic"></span>Axxx - <?//php echo lang('backup'); ?></a></li>        
                      </ul>
              </li>

              <li class="uk-parent"> 
          <!--specifiche-->
          <a href="#">
            <span class="uk-margin-small-right" uk-icon="info"></span> <!-- icona -->
            <?//php  echo lang('specifiche'); ?>
          </a>
                      
                      <ul class="uk-nav-sub">
                          <li><a class="item" href='./Scheda_regioni.php'><span class="uk-margin-small-right" uk-icon="italic"></span>A-x- -Regioni Province e Comuni</a></li>
                          <li><a class="item" href='./nclasse.php'><span class="uk-margin-small-right" uk-icon="italic"></span>A-x- -<?//php echo lang('funzioni_associati'); ?></a></li>
                          <li><a class="item" href='./nmateria.php'><span class="uk-margin-small-right" uk-icon="italic"></span>A-x- -<?//php echo lang('tipologia_associati'); ?></a></li>
                          <li><a class="item" href='./Licenza.php'><span class="uk-margin-small-right" uk-icon="italic"></span>Aola -<?// echo lang('licenza'); ?></a></li>        
                      </ul>
              </li>

                  <li>
                      <a class="item" href='./Manuale.php'>
                      <span class="uk-margin-small-right" uk-icon="question"></span> <!-- icona -->
                      <?//php echo lang('manuale'); ?>
                      </a>
                  </li>

                  <li>
                      <a class="item"href='./logout.php'>
                      <span class="uk-margin-small-right" uk-icon="sign-out"></span> <!-- icona -->
                      <?//php echo lang('uscita'); ?>
                      </a>
                  </li>

          </ul>
      </div>
      <div class="uk-card-footer">
          <!--dati associazione-->
              <ul class="uk-list">
                  <li>
                      <span uk-icon="info"></span>
                      <span class="uk-text-small uk-text-meta uk-text-capitalize"><?// echo $_SESSION['association']['nome'];?></span>
                  </li>
                  <li>
                      <span uk-icon="location"></span>
                      <span class="uk-text-small uk-text-meta uk-text-capitalize"><?// echo $_SESSION['association']['indirizzo'].' - '.$_SESSION['association']['cap'].' - <br>'.$_SESSION['association']['c_nome'].' - '.$_SESSION['association']['p_sigla']; ?></span>
                  </li>
              </ul>
          <!-- link rapidi ai siti attinenti all'associazione -->
    <?// $links=quick_links(); //var_dump($links);
    ?>
          <h6 class="uk-heading-line uk-text-center"><span>Link rapidi</span></h6>
          <ul class="uk-iconnav">
      <li uk-tooltip="title:<?// echo lang('sito_web'); ?>; pos: bottom"><a href="<?//php echo (!empty($links['web_site']))? $links['web_site'] : '' ?>" target="_blank" uk-icon="icon: world"></a></li>
      <li uk-tooltip="title:<?// echo lang('web_mail'); ?>; pos: bottom"><a href="<?//php echo (!empty($links['web_mail'])) ? $links['web_mail'] : '' ?>" target="_blank" uk-icon="icon: mail"></a></li>
      <li uk-tooltip="title:<?// echo lang('web_mail_pec'); ?>; pos: bottom"><a href="<?//php echo (!empty($links['web_mail_pec'])) ? $links['web_mail_pec'] : '' ?>" target="_blank" uk-icon="icon: mail"></a></li>
      <li uk-tooltip="title:<?// echo lang('facebook'); ?>; pos: bottom"><a href="<?//php echo (!empty($links['facebook'])) ? $links['facebook'] : '' ?>" target="_blank" uk-icon="icon: facebook"></a></li>
      <li uk-tooltip="title:<?// echo lang('instagram'); ?>; pos: bottom"><a href="<?//php echo (!empty($links['instagram'])) ? $links['instagram'] : '' ?>" target="_blank" uk-icon="icon: instagram"></a></li>
      <li uk-tooltip="title:<?// echo lang('youtube'); ?>; pos: bottom"><a href="<?//php echo (!empty($links['youtube'])) ? $links['youtube'] : site_url("gestione/rapidi") ?>" target="_blank" uk-icon="icon: youtube"></a></li>
    </ul>
    <ul class="uk-iconnav">
          <li uk-tooltip="title:<?// echo lang('twitter'); ?>; pos: bottom"><a href="<?//php echo (!empty($links['twitter'])) ? $links['twitter'] : '' ?>" target="_blank" uk-icon="icon: twitter"></a></li>
            <li uk-tooltip="title:<?// echo lang('home_banking'); ?>; pos: bottom"><a href="<?//php echo (!empty($links['home_banking'])) ? $links['home_banking'] : '' ?>" target="_blank" uk-icon="icon: home"></a></li>
          </ul>
          
      </div>
  </div>
</div> <!--fine colonna -->

<div class="uk-width-expand@m">   <!-- inizio colonna (prende il posto che rimane della "riga")  -->
   @component('components.breadcrumb')
   @endcomponent

    <div class="uk-section uk-section-muted uk-padding-small"> <!-- sezione -->
    <div class="uk-container uk-container-expand uk-padding-remove"> <!-- container (padding) -->
    
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
