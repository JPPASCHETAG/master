<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../CSS/start.CSS">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">
        <script src="../js/mechanik.js"></script>
    </head>
    <body>
    <!-- The Modal -->
    <div id="modalWindow" class="modal">
      <!-- Modal content -->
      <div class="modal-content">
        <span class="close">&times;</span>
        <p id="modalContent"></p>
      </div>
    </div>
    <!-- Script für modal -->
    <script>
// Get the modal
var modal = document.getElementById("modalWindow");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

<body>
  <div id="svg_div" style="width:70%;">
    <object id="svg_obj" data="../assets/BasicmitID.svg" type="image/svg+xml" height="100%" width="100%"></object>
  </div>

    <br>

    <table id="spielerinfo" style="width: 48  0px; right:1%; position: absolute;  top: 1%;">
      
            <?php
            $spielerinsgesammt = count($_GET);

            //echo '<tr><th></th><th>Würfel</th><th>Schluck</th><th style="display: none"></th></tr>';

            $strZeile ="";

            //Platz für den Würfel
            for ($i=0; $i < $spielerinsgesammt ; $i++) {

                $spielername = $_GET['spielerName'.$i];

                //SpaltenInhalt für jeden spieler anlegen
                $strZeile ="<tr>";

                $strZeile .="<td>".$spielername."</td>";

                $strZeile .='<td id=würfel'.$i.' style="width: 100px;">';

                if($i == 0){
                  $strZeile .= '<button onclick="javaskript:roll(this)">Würfeln</button>';
                }
                
                $strZeile .= '</td>';

                $strZeile .='<td id=schluck'.$i.' style="width: 100px;">0</td>';

                $strZeile .='<td id=position'.$i.' style="display: none">1</td>';
            
                $strZeile .="</tr>";

                echo $strZeile;
              }

             ?>

        </table>

</body>