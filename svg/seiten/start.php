<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../CSS/start.CSS">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link href="../assets/font_awesome/css/all.css" rel="stylesheet">
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

    var isMobile = false; //initiate as false
// device detection
if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent)
    || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) {
    isMobile = true;
}
if(isMobile == true){
  //alert("mobile");
  $('head').append('<link rel="stylesheet" href="../CSS/mobil.CSS">');
}



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
var mySVG = document.getElementById('svg_obj');
    mySVG.addEventListener("load",function(){
        mySVG.contentDocument;
        
        //console.log(mySVG);

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
            });


}


</script>

<body>
  <div id="svg_div" style="width:100%; margin-top: 50px;">
    <object id="svg_obj" data="../assets/BasicmitID.svg" type="image/svg+xml" height="100%" width="100%"></object>
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

                  $StrTable .='<td id=würfel'.$i.' style="width: 100px;">';

                  if($i == 0){
                    //$StrTable .= '<button onclick="javaskript:roll(this)">Würfeln</button>';
                    $StrTable .= '<i class="fas fa-dice" onclick="javaskript:roll(this)"></i>';
                  }

                  $StrTable .= '</td>';

                  //$StrTable .='<td id=schluck'.$i.' style="width: 100px;">0</td>';

                  $StrTable .='<td id=position'.$i.' style="display: none">1</td>';

                  $StrTable .='<td id="figur'.$i.'" style="display: none">'.$spielerFigur.'</td>';

                  $StrTable .='<td style="width: 50px;"><img src="../assets/figures/svg/'.$spielerFigur.'"> </td>';

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
