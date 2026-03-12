<?php
    $pluginImagePath  = trailingslashit(plugins_url());
?>
<link rel="stylesheet" type="text/css" href="<?php echo  $pluginImagePath."critters_plugin/css/style.css"; ?>">
<div class="main_section">
    <h1>Begrafenissen detailpagina werkt voor Nieuwe begrafenis toevoegen [critters_detail]</h1><br>
    <p class="paragraph_data">critter Plugin is een van de plug-ins voor WordPress die de details van de overledene bevat, zoals naam, geboortedatum, overlijdensdatum, reden van overlijden, enz. Via deze plug-in kunnen mensen een notitie/sympathiebericht over de overledene schrijven detailpagina. Het maakt het voor nabestaanden van overledenen mogelijk om de condoleances te lezen van degenen die niet naar zijn/haar begrafenis zijn gekomen.
</p>
    <p>Via deze plugin kan de beheerder/familielid die de uitvaart kan toevoegen de uitvaartgegevens wijzigen en ook deze condoleanceberichten lezen</p>
    <h1 class="detail_head">critter Plugin alle pagina's beschrijving is hier</h1><br>
    <table class="page_des">
        <tr>
            <th>Pagina pad</th>
            <th>Paginanaam</th>
            <th>Beschrijving</th>
        </tr>
        <tr>
            <td><a href="<?php echo $url = home_url()."/critters-detail-page"; ?>">Klik hier</a></td>
            <td>Begrafenis Detailpagina</td>
            <td>Deze pagina wordt gebruikt om nieuwe begrafenisgegevens/informatie toe te voegen.</td>
        </tr>
        <tr>
            <td><a href="<?php echo $url = home_url()."/rouwberichten-condoleren"; ?>">Klik hier</a></td>
            <td>Begrafenis Reactie Pagina</td>
            <td>Deze pagina toont alle begrafenissen met hun details toegevoegd door admin.</td>
        </tr>
        <tr>
            <td><a href="">Klik hier</a></td>
            <td>Begrafenisshow enkele pagina</td>
            <td>Deze pagina toont het individuele persoonsdetail met het antwoordformulier.</td>
        </tr>
        <tr>
            <td><a href="<?php echo $url = home_url()."/show-critter-details"; ?>#redirect_form">Klik hier</a></td>
            <td>Begrafenis Condoleance Berichten Formulier</td>
            <td>Deze pagina moet worden geopend wanneer iemand een bericht wil sturen naar een specifieke persoon die er niet meer is</td>
        </tr>
    </table>
</div>
