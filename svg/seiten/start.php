<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../CSS/start.CSS">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link href="../assets/font_awesome/css/all.css" rel="stylesheet">
        <script src="../js/mechanik.js"></script>
        <script>
            //Das Mobile CSS laden wenn der Parameter gesetzt ist.
            var isMobile = findGetParameter("mobil");
            if(isMobile){
                alert("Du bist auf der Mobilen Seite unterwegs. Diese befindet sich allerdings noch in Arbeit. Es funktioniert trotzdem alles schaut nur nicht so gut aus.");
                //$('head').append('<link rel="stylesheet" href="../CSS/mobil.CSS">');
                $.ajax({
                    url:"../CSS/mobil.CSS",
                    success:function(data){
                        $("<style></style>").appendTo("head").html(data);
                    }
                })
            }
        </script>
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

function getFieldPos(fieldNr){

//neue FeldID
var neuesFeld = "Feld"+fieldNr;

//Die Koordinaten des neuen Feldes
var mySVG = document.getElementById('svg_obj').contentDocument;

        var svgItem = mySVG.getElementById(neuesFeld);
        //Koordinaten vom nächsten Feld holen
        var x = svgItem.getBoundingClientRect();
        var top = Math.round(x.top + pageYOffset);
        var left = Math.round(x.left + pageXOffset);

        var arReturn = [
          top,
          left
        ];
        return arReturn;
}

</script>

<body>
  <div id="svg_div">
    <object id="svg_obj" data="../assets/BasicmitID.svg" type="image/svg+xml"  height="100%" width="100%"></object>
  </div>

    <br>

    <?php
            $spielerinsgesammt = count($_GET);
            $spielerinsgesammt = $spielerinsgesammt / 2;
            $StrTable ="";

            // Die Tabelle links oben
              $StrTable .= '<table class="spielerinfo" id="spielerinfo" style="left:1%; position: absolute;  top: 1%;">';

              //Platz für den Würfel
              for ($i=0; $i < 3 ; $i++) {

                if(!isset($_GET['spielerName'.$i])){
                  break;
                }
                if(!isset($_GET['figur'.$i])){
                  break;
                }

                  $spielername = $_GET['spielerName'.$i];
                  $spielerFigur = $_GET['figur'.$i];

                  //SpaltenInhalt für jeden spieler anlegen
                  $StrTable .="<tr>";

                  $StrTable .='<td id="name'.$i.'">'.$spielername.'</td>';

                  $StrTable .='<td id=würfel'.$i.' style="width: 50px;">';

                  if($i == 0){
                    //$StrTable .= '<button onclick="javaskript:roll(this)">Würfeln</button>';
                    $StrTable .= '<i class="fas fa-dice" onclick="javaskript:roll(this)"></i>';
                  }

                  $StrTable .= '</td>';

                  //$StrTable .='<td id=schluck'.$i.' style="width: 100px;">0</td>';

                  $StrTable .='<td id=position'.$i.' style="display: none">1</td>';

                  $StrTable .='<td id="figur'.$i.'" style="display: none">'.$spielerFigur.'</td>';

                  $StrTable .='<td style="width: 30px;"><img src="../assets/figures/svg/'.$spielerFigur.'"> </td>';

                  $StrTable .="</tr>";

                }
                $StrTable .="</table>";
  echo $StrTable;

              //Die Tabelle Rechts oben
              $StrTable = '<table class="spielerinfo" id="spielerinfo2" style="right:1%; position: absolute;  top: 1%;">';

              //Platz für den Würfel
              for ($i=3; $i < 6 ; $i++) {

                  if(!isset($_GET['spielerName'.$i])){
                    break;
                  }
                  if(!isset($_GET['figur'.$i])){
                    break;
                  }

                  $spielername = $_GET['spielerName'.$i];
                  $spielerFigur = $_GET['figur'.$i];


                  //SpaltenInhalt für jeden spieler anlegen
                  $StrTable .= "<tr>";

                  $StrTable .='<td id="name'.$i.'">'.$spielername.'</td>';

                  $StrTable .='<td id=würfel'.$i.' style="width: 100px;"></td>';

                  //$StrTable .='<td id=schluck'.$i.' style="width: 100px;">0</td>';

                  $StrTable .='<td id=position'.$i.' style="display: none">1</td>';

                  $StrTable .='<td id="figur'.$i.'" style="display: none">'.$spielerFigur.'</td>';

                  $StrTable .='<td style="width: 50px;"><img src="../assets/figures/svg/'.$spielerFigur.'"> </td>';

                  $StrTable .="</tr>";

                }
                $StrTable .="</table>";

  echo $StrTable;

              //Die Tabelle links unten
              $StrTable = '<table  class="spielerinfo" id="spielerinfo3" style="width: 48  0px; left:1%; position: absolute;  bottom: 1%;">';

              //Platz für den Würfel
              for ($i=6; $i < 9 ; $i++) {

                if(!isset($_GET['spielerName'.$i])){
                  break;
                }
                if(!isset($_GET['figur'.$i])){
                  break;
                }

                  $spielername = $_GET['spielerName'.$i];
                  $spielerFigur = $_GET['figur'.$i];

                  //SpaltenInhalt für jeden spieler anlegen
                  $StrTable .= "<tr>";

                  $StrTable .="<td>".$spielername."</td>";

                  $StrTable .='<td id=würfel'.$i.' style="width: 100px;">';

                  $StrTable .= '</td>';

                  //$StrTable .='<td id=schluck'.$i.' style="width: 100px;">0</td>';

                  $StrTable .='<td id=position'.$i.' style="display: none">1</td>';

                  $StrTable .='<td id="figur'.$i.'" style="display: none">'.$spielerFigur.'</td>';

                  $StrTable .='<td style="width: 50px;"><img src="../assets/figures/svg/'.$spielerFigur.'"> </td>';

                  $StrTable .="</tr>";

                }
                $StrTable .="</table>";
  echo $StrTable;
            // Die TZabellle links unten
              $StrTable = '<table class="spielerinfo" id="spielerinfo4" style="width: 48  0px; right:1%; position: absolute;  bottom: 1%;">';

              //Platz für den Würfel
              for ($i=9; $i < 12 ; $i++) {

                if(!isset($_GET['spielerName'.$i])){
                  break;
                }
                if(!isset($_GET['figur'.$i])){
                  break;
                }

                  $spielername = $_GET['spielerName'.$i];
                  $spielerFigur = $_GET['figur'.$i];


                  //SpaltenInhalt für jeden spieler anlegen
                  $StrTable .= "<tr>";

                  $StrTable .="<td>".$spielername."</td>";

                  $StrTable .='<td id=würfel'.$i.' style="width: 100px;">';

                  $StrTable .= '</td>';

                  //$StrTable .='<td id=schluck'.$i.' style="width: 100px;">0</td>';

                  $StrTable .='<td id=position'.$i.' style="display: none">1</td>';

                  $StrTable .='<td id="figur'.$i.'" style="display: none">'.$spielerFigur.'</td>';

                  $StrTable .='<td style="width: 50px;"><img src="../assets/figures/svg/'.$spielerFigur.'"> </td>';

                  $StrTable .="</tr>";

                }
                $StrTable .="</table>";
                echo $StrTable;

             ?>
<script>


</script>
</body>
