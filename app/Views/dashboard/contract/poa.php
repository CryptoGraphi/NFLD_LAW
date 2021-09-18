<?php 


function generateProvinceList()
{
    $provinceName = ['Ontario', 'Quebec', 'Nove Soctia', 'New Brunswick', 'Manitoba', 'British Columbia', 
    'Prince Edward Island', 'Saskatchewan', 'Alberta', 'NewFoundland and Labrador'];
    $provinceValue = ['ON', 'QC', 'NS', 'NB', 'MB', 'BC', 'PE', 'SK', 'AB', 'NL'];

    for ($i = 0; $i < sizeof($provinceValue); $i++) {
        echo "<option value='". $provinceValue[$i]."'> ".$provinceName[$i]."</option>";
    }


}
?>

<div class='container' style='margin-top: 10%;'>

    <div class='row'>
        <h1 class='text-center'> <?php echo $headerTitle; ?> </h1>
        <small style='color: slategray; font-style: italic;' class='mt-4'> Please go though our interactive wizard to
            generate your <b> "Personalized" </b> legal contract </small>
    </div>

    <div class='row mt-4'>
        <div class='col-sm iconTile'>
            <img src='/img/SVG/document_choose.svg' class='img-fluid' />
            <span> Choose your document </span>
        </div>

        <div class='col-sm iconTile'>
            <img src='/img/SVG/fill_form.svg' class='img-fluid' />
            <span> Answer a few simple questions</span>
        </div>
        <div class='col-sm iconTile'>
            <img src='/img/SVG/clock.svg' class='img-fluid' />
            <span> It take(s) just 5 minute(s) </span>
        </div>

    </div>

    <div class='row mt-4'>
    <div class="progress" >
  <div class="progress-bar" id='progressBar' role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"' '></div>
</div>
    </div>

    <div class='row mt-4'>
        <ul class="nav nav-tabs">
            <li id='nav-tab-started' class="nav-item"><a class="nav-link active" href="#">Get Started</a></li>
            <li id='nav-tab-executor' class="nav-item"><a class="nav-link" href="#">Executor </a></li>
            <li id='nav-tab-backupExecutor' class='nav-item'> <a class='nav-link' href='#'> Backup Executor </a></li>
            <li  id='nav-tab-children' class="nav-item"><a class="nav-link" href="#">Children</a></li>
            <li id='nav-tab-gifts' class='nav-item'><a class='nav-link' href='#'> Gifts </a></li>
            <li class='nav-item' id='nav-tab-remainder'> <a class='nav-link' href='#'> Remainder </a></li>
            <li class='nav-item' id='nav-tab-final'> <a class='nav-link' href='#'> Final Details </a></li>
            <li class='nav-item' id='nav-tab-signing'> <a class='nav-link' href='#'> Signing </a></li>
        </ul>
    </div>

    <div class='row mt-4' style='margin: 0px; padding: 0px;'>

    </div>
</div>