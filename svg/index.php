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
        <link rel="stylesheet" href="CSS/index.css" >
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
                //console.log(obj[i]);
                var strReturn = "";
                strReturn += '<div class="mySlides'+j+'">';
                strReturn += '<img src="assets/figures/svg/'+obj[i]+'">'; 
                strReturn += '</div>';

                $('#figur'+j).children('#slideshow').prepend(strReturn); 
            }
            
        }
    });


}

//Spielerzahl schreiben/holen
function getSpielerZahl(spielerzahl){

     



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
                
            //<!-- Next and previous buttons -->
            strReturn += '<a class="prev" onclick="plusSlides(-1,'+i+')">&#10094;</a>';
            strReturn += '<a class="next" onclick="plusSlides(1,'+i+')">&#10095;</a>';
            strReturn += '</div>';
        
          strReturn += '</td></tr>';
        }
        document.getElementById("spielertable").innerHTML = strReturn;

        var btnSafe = document.getElementById("safe");
        btnSafe.style.display = "";

        //Hier kommen die Bilder dazu
        getSpielFiguren();
    }

}

function getParam(){

    var spielerzahl = document.getElementById("spielerzahl").value;
    var strDaten ='?';

    for (var i = 0; i < spielerzahl; i++) {

      var spielerName = document.getElementById("spielerName"+i).value;

      if(i!=0){
        strDaten+="&";
      }

      strDaten += 'spielerName'+i+'='+spielerName;

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

var slideIndex = [1,1];
var slideId = ["mySlides0", "mySlides1"]
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
