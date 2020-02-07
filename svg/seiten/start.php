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
  <div id="svg_div">
    <object id="svg_obj" data="../assets/Feld2.svg" type="image/svg+xml" height="50%" width="50%"></object>
  </div>

    <br>

    <table id="spielerinfo">
          <th></th>
            <?php
            $spielerinsgesammt = count($_GET);

            //Spalten für die Spieler anlegen
            for ($i=0; $i < $spielerinsgesammt; $i++) {
              $j = $i+1;

              $spielername = $_GET['spielerName'.$i];

              echo '<th id="spielerName'.$i.'">'.$spielername.'</th>';
            }

            //SpaltenInhalt für jeden spieler anlegen
            $strZeile ="<tr>";

            //Platz für den Würfel
            for ($i=0; $i < $spielerinsgesammt ; $i++) {
              if($i==0){
                $strZeile .="<td>Würfel</td>";

                $strZeile .='<td id=würfel'.$i.'><button onclick="javaskript:roll(this)">Würfeln</button></td>';
              }else {
                $strZeile .="<td id=würfel".$i."></td>";
              }


            }

            $strZeile .="</tr><tr>";

            //Schlücke
            for ($i=0; $i < $spielerinsgesammt ; $i++) {
              if($i==0){
                $strZeile .="<td>Schlücke</td>";
              }
              $strZeile .='<td id=schluck'.$i.' style="text-align:center;">0</td>';

            }

            $strZeile .='</tr><tr style="display:none;">';
            //Feldnummer
            for ($i=0; $i < $spielerinsgesammt ; $i++) {

              if($i==0){
                $strZeile .="<td>Feld</td>";
              }

              $strZeile .='<td id=position'.$i.' style="text-align:center;">1</td>';

            }

            echo $strZeile;
             ?>

        </table>

</body>