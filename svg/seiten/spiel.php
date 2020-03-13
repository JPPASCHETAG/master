<?php
session_start();
if(!isset($_SESSION['SPIELNR'])){
    $_SESSION['SPIELNR'] = uniqid();
}

$farben = [
        0 => "#33cccc",
        1 => "#0066ff",
        2 => "#ff0000",
        3 => "#00cc00",
        4 => "#ffff00",
        5 => "#ff00ff"
    ];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link rel="stylesheet" href="../CSS/index.css" >
        <title>Spiele zum Saufen</title>
    </head>
<script>
window.onload = function(){
    var modal = document.getElementById("myModal");
    modal.style.display = "none";

    var btnSafe = document.getElementById("safe");
    btnSafe.style.display = "none";

}

function getSpielFiguren(){
    var id = $('#spielerzahl').val();
    
    $.post("externPHP/gallery.php", "" ,function(data){

        var obj = JSON.parse(data);
        var length = Object.keys(obj).length

        for (var j = 0; j < id; j++) {
            
            for (var i = 3; i < length; i++) {
                
                var strReturn = "";
                strReturn += '<div class="mySlides'+j+' Figuren">';
                strReturn += '<img src='+obj[i]+'"../assets/figures/svg">';
                strReturn += '</div>';

                $('#figur'+j).children('#slideshow').prepend(strReturn); 
            }
        }
    });
}

var isMobile = false; //initiate as false
// device detection
if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent)
    || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) {
    isMobile = true;
}

//Spielerzahl schreiben/holen
function getSpielerZahl(spielerzahl){

    //Falls der Wert geändert wird alles löschen
    $('#spielertable').html("");

  var farben = [
           "#33cccc",
           "#0066ff",
           "#ff0000",
           "#00cc00",
           "#ffff00",
           "#ff00ff"
       ];

    if(spielerzahl > 12){
      strReturn = 'Es können nur maximal 6 Leute gleichzeitig spielen';
    }else {
        var strReturn = '';
      strReturn +='<table>';
        strReturn +='<tr><th>Spieler</th><th>Spielername</th><th>Spielerfarbe</th></tr>';
        for (var i = 0; i < spielerzahl; i++) {
          j= i+1;
          strReturn +='<tr><td>'+j+'</td><td><input id="spielerName'+i+'" type="text" placeholder="Spielername"></td>';
          //strReturn +='<td><input id="spielerFarbe'+i+'" type="color" value="'+farben[i]+'" disabled></td>';
          strReturn +='<td id="figur'+i+'">';
          strReturn += '<div id="slideshow" class="slideshow-container">';
          strReturn += '<div class="mySlides'+i+'" style="display: block;"><img src="../assets/figures/svg/002-kraken.svg"></div>';
            //<!-- Next and previous buttons -->
            strReturn += '<a class="prev" onclick="plusSlides(-1,'+i+')">&#10094;</a>';
            strReturn += '<a class="next" onclick="plusSlides(1,'+i+')">&#10095;</a>';
            strReturn += '</div>';
        
          strReturn += '</td></tr>';
        }
        $('#spielertable').append(strReturn);


        $('#safe').show();

        //Hier kommen die Bilder dazu
        getSpielFiguren();
    }

}

function getParam(){

    var spielerzahl = $("#spielerzahl").val();
    
    var strDaten ='?';
    if (isMobile == true){
        strDaten += "mobil=true&";
    }

    for (var i = 0; i < spielerzahl; i++) {

      var spielerName = $("#spielerName"+i).val();

      var spielFigur = $(".mySlides"+i+":visible").html();
      spielFigur = spielFigur.slice(29 , -2);      

      if(i!=0){
        strDaten+="&";
      }

      strDaten += 'spielerName'+i+'='+spielerName;
      strDaten += '&figur'+i+'='+spielFigur;

    }
    
    window.open("seiten/start.php"+strDaten,"_self");

}



</script>

    <body style="font-family: 'Open Sans', sans-serif;">
    <div class="background">
        <div class="logo">
    </div>
    <div id="spielfiguren"></div>

    <div class="welcome">
        <p>Griaß eich, Servus und Hallo!</p>
        <hr>
        <br>
        <button class="btn_a" id="btn_a">Anleitung</button>
        <button class="btn" id="btn">Neues Spiel starten</button>
        <br>

        <div id="myModal" class="modal">
            <div class="modal-content" >
                <span class="close">&times;</span>
                <div class="spielerzahl">
                    <label for="spielerzahl">Wie viele spielen?</label>
                    <input id="spielerzahl" placeholder="Bitte eine Zahl eingeben..." type="text" onkeyup="getSpielerZahl(this.value)" style ="display: <?php if(isset($_GET['ZAHL'])){echo "none"; } ?>">
                    <label style="margin-left:25;" id="spielerzahlID"><?php echo @$_GET['ZAHL'] ?></label>
                </div>
                <div id="spielertable" class="table">
                  <!-- Wird durch JS befüllt -->
                </div>
                <button onclick="getParam()" class="btn" id="safe">Speichern</button>
            </div>
        </div>
        </div>
        <script>
            // Get the modal
            var modal = document.getElementById("myModal");
            // Get the button that opens the modal
            var btn = document.getElementById("btn");
            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            // When the user clicks the button, open the modal
            btn.onclick = function() {
            modal.style.display = "block";
            btn.style.display="none";
            }
            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
            modal.style.display = "none";
            btn.style.display="block";
            }
            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
                btn.style.display="block";
            }
            }

var slideIndex = [1,1,1,1,1,1,1,1,1,1,1,1,1,1,1];
var slideId = ["mySlides0", "mySlides1", "mySlides2", "mySlides3", "mySlides4", "mySlides5", "mySlides6", "mySlides7", "mySlides8", "mySlides10", "mySlides11", "mySlides12", "mySlides13", "mySlides14", "mySlides15"]
showSlides(1, 0);
showSlides(1, 1);

function plusSlides(n, no) {
  showSlides(slideIndex[no] += n, no);
}

function showSlides(n, no) {
  var i;
  var x = document.getElementsByClassName(slideId[no]);
  
  if (n > x.length) {slideIndex[no] = 1}    
  if (n < 1) {slideIndex[no] = x.length}
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";  
  }  
  
  x[slideIndex[no]-1].style.display = "block";  
}

        </script>
    </div>
    </body>
    <?php




    ?>

</html>
