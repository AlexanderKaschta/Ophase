<div class="contact-form-title" style="background-image: url(images/schloss.jpg);">        
  <div class="topnav"  id="myTopnav">
    <a class="<?php if ($title == "Willkommen!") {echo(active);}; ?>" href="<?= dirname($_SERVER['PHP_SELF'])?>/">O-Phase</a>
    <a class="<?php if ($title == "Anmeldung") {echo(active);}; ?>" href="<?= dirname($_SERVER['PHP_SELF'])?>/anmeldung">Anmeldung</a>
    <a class="<?php if ($title == "FAQ") {echo(active);}; ?>" href="<?= dirname($_SERVER['PHP_SELF'])?>/faq">FAQ</a>
    <a class="<?php if ($title == "Kontakt") {echo(active);}; ?>" href="https://fachschaft.physik.kit.edu/drupal/content/kontakt" target="_blank">Kontakt</a>
    <a class="right" href="https://fachschaft.physik.kit.edu/drupal/" target="_blank">Fachschaft Physik</a>
    <a href="javascript:void(0);" class="icon" onclick="hamburgernav()"><i class="fa fa-bars"></i></a>
  </div>
  <span class="contact-form-title-1">
    <?= $title ;?> 
  </span>
  <span class="contact-form-title-2">
    O-Phase WS20/21
  </span>
</div>

