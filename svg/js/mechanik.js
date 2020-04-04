  function roll(elem){

    var idgesamt = elem.parentNode.id;
    var id = idgesamt.substr(-1);
    var nextID = parseInt(id)+1;
    
    //Alle Spieler zählen
    var alleSpieler = 0;
    var spieler = document.getElementsByClassName("spielerinfo");
    for (var i = 0; i < spieler.length; i++) {
      var index = spieler[i];
      alleSpieler = alleSpieler + index.rows.length;
      
    }    
  
  //wenn der letzte spieler erreicht wurde wieder am anfang setzen
  if (nextID == alleSpieler) {
    nextID = 0;
  }

    
    

    //aktuelles Feld holen neues Feld berechnen & einfärben
    var fieldID = NextField(id);
    if(fieldID == 100){
        Output("Du bist im Ziel");
        var positionFeld = document.getElementById('position'+id);
        positionFeld.innerHTML = "101";
        return;
    }else if(fieldID < 100){
        //dann passiert nichts
    }else{
        nextSpieler(idgesamt,nextID);
        return;
      }
      //den Würfel-Button weitergeben
      nextSpieler(idgesamt,nextID);
  
    // Feldtext Ausgabe
    var FieldText = getFeldText(fieldID);
    

    //Im Text nach der Art suchen und dann alles ersetzen mit der Frage
      switch(FieldText){
        case "P":
        case "WWAE":
        case "IHNN":
        case "WDL":
          var filename = FieldText+"-Fragen.txt";
          $.post("../externPHP/ajxTXT.php",'filename='+filename,function(data){
            
            var obj = JSON.parse(data);

            var length = Object.keys(obj).length;
            var zahl = Math.floor(Math.random() * length) + 1; 

            //Automatische Spieler Auswahl  
            if(FieldText == "P"){
              var strReturn = obj[zahl].toString();              
                            
              var zahl2  = Math.floor(Math.random() * alleSpieler); 
              var SpielerNameSpiel = $("#name"+zahl2).text();
              
              strReturn = strReturn.replace("SPIELER", SpielerNameSpiel);              
              Output(strReturn);
            
            }else if (FieldText == "WWAE"){

              var zahl3  = Math.floor(Math.random() * alleSpieler); 
              var spieler1 = $("#name"+zahl3).text();
              var zahl4  = Math.floor(Math.random() * alleSpieler); 
              var spieler2 = $("#name"+zahl4).text();
              
              Output(obj[zahl]);
              addModalContent("<br>"+spieler1+" oder "+spieler2+"?");

            } else if(FieldText == "IHNN") {
                var strReturn = "Trinken muss: " + obj[zahl];

                Output(strReturn);
            }else{
              Output(obj[zahl]);
            }  
    
          });
        break;
      case "TTT": //Tic Tac Toe
          if(isMobile){
              $(".modal").css("padding-top", 0);
          }
          Output('Spiel eine Runde Tic Tac Toe mit einem Gegner deiner Wahl um 10 Schluck.<br><iframe src="../seiten/TicTacToe.html" frameborder="0" height="350px" ></iframe>');
          break;
      case "CT": //CoinToss
          if(isMobile){
              $(".modal").css("padding-top", 0);
          }
          Output('Setzt alle beliebig viele Schlucke auf Titte oder Zahl<br><iframe src="../seiten/CoinToss.html" frameborder="0" height="200px" ></iframe>');
          break;
      case "Pferderennen":
          Output("Pferderennen.<br> Wenn Ihr bereit seit öffnet sich ein neuer Tab. <br> <br> <button onclick='openPferderennen()'>Hier klicken</button>");
          break;
      case "Reaktionstest":
          if(isMobile){
              $(".modal").css("padding-top", 0);
          }
          Output('Mal sehen wie fit du noch bist<br><iframe src="../seiten/ReactionTest.html" frameborder="0" height="200px" ></iframe>');
          break;
        default:
          Output(FieldText);
          break;
      }

 }

 function openPferderennen() {
     window.open("../seiten/PferdeRennen.html");
 }


 function NextField(id){

    var isMobile = findGetParameter("mobil");

    //Zahl generieren
    var zahl = Math.floor(Math.random() * 6) + 1; 
    //zahl = 51;

    //position holen
    var positionFeld = document.getElementById('position'+id);
    var position = positionFeld.innerHTML;
    position = parseInt(position);
    if(position == 101){
        return position;
    }

    //neue Position berechnen und setzen
    var nextPosition = position + zahl;
    if(nextPosition >= 100){
        nextPosition = 100;
    }
    positionFeld.innerHTML = nextPosition;


    //neue FeldID

    var nextPos = getFieldPos(nextPosition);
    if(isMobile){
        topPX = nextPos[0]+0+"px";
        leftPX = nextPos[1]+0+"px";
    }else {
        topPX = nextPos[0]+0+"px";
        leftPX = nextPos[1]+20+"px";
    }

    
    //Die Koordinaten von Feld1 holen
    var Feld1 = getFieldPos(1);
    var Feld1Left =  Feld1[0];
    var Feld1Top = Feld1[1];
    if(isMobile){
        Feld1Left = Feld1Left;
        Feld1Top = Feld1Top;
    }else{
        Feld1Left = Feld1Left;
        Feld1Top = Feld1Top+40;
    }
    //Spielerfigur holen
    var figur = getSpielerFigur(id);

    //Spielfigur hinzufügen
     if(document.getElementById("svg_figur"+id) == null){
        document.getElementById("svg_div").innerHTML += figur;
     }

    //position setzen
    var spielFigur = "svg_figur"+id;
    figur = document.getElementById(spielFigur);
    figur.style.left = leftPX;
    figur.style.top = topPX;

    //Überprüfen ob jmd geschlagen wird
    var allefiguren = document.getElementsByClassName("figur");

    for(var i = 0; i < allefiguren.length; i++)
    {
      if(i != id){
        var pos = document.getElementById("svg_figur"+i);

        var schlagenTop = pos.style.top ;
        var schlagenLeft = pos.style.left ;

        if (topPX == schlagenTop && leftPX == schlagenLeft) {

            console.log("geschlagen");
          
          //Die Spielfigur auf Feld1 setzen          
          var spielerAufEins = document.getElementById("svg_figur"+i);

          //Positionsfeld auf 1 setzen
          var PositionsfeldSpieler = document.getElementById("position"+i); 
          PositionsfeldSpieler.innerHTML = "1";
          
          spielerAufEins.style.top = Feld1Left+"px";
          spielerAufEins.style.left = Feld1Top+"px";

          //funktioniert nicht
          //addModalContent("Tut mir leid, dass du geschlagen wurdest.")
        }
      }
    }
    return nextPosition;
 }

 function getFeldText(FieldID){

    var felder =[
        "",
        "Start",
        "Alle trinken",
        "TTT",//"Geh auf Feld 32",                                                   //FELD3
        "TTT",//"Trink 5 und gehe zum Start",                                        //FELD4
        "IHNN",
        "Du bist jetzt Questionmaster",
        "Kategorie",
        "Alle Mädls trinken",
        "WDL",
        "Stimmt ab, wer der nüchternste ist. Derjenige muss trinken.",
        "Der Älteste trinkt",
        "Du bist jetzt Nosemaster",
        "Regel",
        "P",
        "WWAE",
        "Stein/Schere/Papier um 5 Schluckk",
        "Such dir einen aus der trinkt",
        "CT",
        "TRINK",
        "WDL",
        "TTT",
        "BONUS: TRINKE IMMER 2x so viel",
        "Pferderennen",
        "Du bist jetzt Questionmaster",
        "CT",
        "IHNN",
        "WWAE",
        "Alle Ausländer trinken",
        "Alle Jungs trinken",
        "WDL",
        "Regel",
        "Du bist jetzt Nosemaster",
        "P",
        "Hole alles an Shlucken auf was du auf den weitesten zurückliegst. Bist du am weitesten, kannst du dir jemanden aussuchen, der alles aufholen muss.",
        "TTT",//"Gehe auf Start",                                                         //FELD34
        "Wasserfall",
        "Reaktionstest",//"Gehe 2 Felde zurück",                                                    //FELD36
        "Pantomime. Derjenige, der es errät darf doppelt soviele Schluck verteilen, wie Spieler mitspielen.",
        "Kategorie",
        "Abstimmung, dann der nüchternste trinkt",
        "IHNN",
        "Alle Dummen trinken",
        "Die kleinste trinkt",
        "Der größte trinkt",
        "Such dir einen aus der trinkt",
        "P",
        "TTT",//"Gehe auf Feld 38",                                                       //FELD47
        "Der Jüngste trinkt",
        "Alle mit kleinen Geschwistern trinken",
        "Sing ein Lied von Mia Julia oder Trink 5 Schluck",
        "TTT",//"Gehe auf Feld 53",                                                       //FELD51
        "SAUF",
        "Pantomime. Derjenige, der es errät darf doppelt soviele Schluck verteilen, wie Spieler mitspielen.",
        "CT",
        "Reaktionstest",
        "Wasserfall",
        "Du bist jetzt Questionmaster",
        "Regel",
        "Such dir einen aus der trinkt",
        "P",
        "Mädels trinekn ihre Körbchen in Schluck(A=1,B=2,...)",
        "WDL",
        "Alle Jungs trinken",
        "IHNN",
        "Pferderennen",
        "Du bist jetzt Nosemaster",
        "Nine make a rhyme",
        "Würfel nochmal",
        "WWAE",
        "Alle Singles müssen trinken",
        "Stimmt ab, wer der nüchternste ist. Derjenige muss trinken.",
        "Wasserfall",
        "Der, der zuletzt auf dem Klo war muss trinken",
        "Stimme einen Schlager an. Wenn mehr als 2 mitsingen trinken alle.",
        "Nine make a rhyme",
        "TTT",//"Gehe auf Feld 72",                                                         //FELD75
        "Stein/Schere/Papier um 10 Schluckk",
        "WWAE",
        "Pantomime. Derjenige, der es errät darf doppelt soviele Schluck verteilen, wie Spieler mitspielen.",
        "Hol "+ $("#name"+1).text() +" ein neues Getränk. Es muss natürlich leeer sein, wenn du wieder da bist.",
        "Reaktionstest",//"Gehe auf Feld 69",                                                         //FELD80
        "Bestimme, wer 5 Schlucke trinken muss",
        "Kategorie",
        "Regel",
        "HAU REIN",
        "Alle Raucher trinken die Anzahl an Kippen, die sie dabei haben",
        "P",
        "Du bist jetzt Nosemaster",
        "Alle Mädls trinken",
        "Such dir einen aus der trinkt",
        "IHNN",
        "Pferderennen",
        "Verteile 8 Schluck",
        "WWAE",
        "Pantomime. Derjenige, der es errät darf doppelt soviele Schluck verteilen, wie Spieler mitspielen.",
        "Nine make a rhyme",
        "Ex und jemand anderes muss auch exen",
        "Wasserfall",
        "Ex und hop",
        "Gehe auf Feld 38",                                                          //FELD99
        "ZIEL"
    ];

    var FeldText = felder[FieldID];

    return FeldText;


 }

 function getSpielerFigur(id){
    
    var figur = $('#figur'+id).html();

     var spieler = '<object class="figur" style="position: absolute;" id="svg_figur'+id+'" data="../assets/figures/svg/'+figur+'" type="image/svg+xml" height="7%" width="7%"></object>';
     return spieler;
     
 }

 function addSips(mode,id=0,schluck=0){
    var fieldID = document.getElementById('position'+id).innerHTML;
    var tableField = document.getElementById('schluck'+id);
    var sipsWas = tableField.innerHTML;
    
    switch (mode) {
        case 2:
              var spieler = document.getElementById('spielerinfo').rows[0].cells.length;
              spieler = parseInt(spieler);
              spieler = spieler-1;
    
              for (var i = 0; i < spieler; i++) {
    
                var tableField2 = document.getElementById('schluck'+i);
                var sipsWas = tableField2.innerHTML;
                sipsWas = parseInt(sipsWas);
    
                var sipsNow = sipsWas + 1;
                tableField2.innerHTML = sipsNow;
              }
              return;
        case 3:
              sipsWas = parseInt(sipsWas);
    
              var sipsNow = schluck + sipsWas;
              tableField.innerHTML = sipsNow;
              return;    
    }
       
}

      //eine Funktion aus Strings callen
function executeFunctionByName(functionName, context /*, args */) {
    var args = Array.prototype.slice.call(arguments, 2);
    var namespaces = functionName.split(".");
    var func = namespaces.pop();
    for(var i = 0; i < namespaces.length; i++) {
      context = context[namespaces[i]];
    }
    return context[func].apply(context, args);
}
  
  //den button an den nächsten Spieler übergeben
  function nextSpieler(idgesamt,nextID){
    
      //var HTMLbutton = '<button onclick="javaskript:roll(this)">Würfeln</button>';
      var HTMLbutton = '<i class="fas fa-dice" onclick="javaskript:roll(this)"></i>';
  
      var spieler = document.getElementById(idgesamt);
      spieler.innerHTML = '';
  
      var nextSpieler = document.getElementById("würfel" + nextID);
      nextSpieler.innerHTML = HTMLbutton;
  }
  
  
  function Output(strOutput){
  
    var modal = document.getElementById("modalWindow");
    var modalContent = document.getElementById("modalContent").innerHTML = strOutput;
  
    modal.style.display = "block";
  
  }
  
  function SpielerListbox(){
  
    var spieler = document.getElementById('spielerinfo').rows[0].cells.length;
    spieler = parseInt(spieler);
    spieler--;
  
    var strReturn = '<select class="selectSpieler">';
  
    for (var i = 0; i < spieler; i++) {
      var spielername = document.getElementById('spielerName' + i).innerHTML;
      strReturn +="<option>"+ spielername +"</option>";
    }
  
    strReturn += "<option selected>Keine Auswahl</option></select>";
    return strReturn;
  }
  
  //um verschiedene Prameter zu finden
  function findGetParameter(parameterName) {
      var result = null,
          tmp = [];
      location.search
          .substr(1)
          .split("&")
          .forEach(function (item) {
            tmp = item.split("=");
            if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
          });
      return result;
  }
  
  function addModalContent(strContent){
    var modalContent = document.getElementById("modalContent");
    var modal = document.getElementById("modalContent").innerHTML;
    modal += strContent;
  
    modalContent.innerHTML = modal;
  }


  
  function setNewField(id,fieldNR){
    //aktuelle Position holen
    $('#position'+id).text(fieldNR);
    console.log("neues Feld");
    var Pos = getFieldPos(fieldNR);
    var top = Pos[0];
    var left = Pos[1]; 
   console.log(top);
   console.log(left);
   
    var feldText = getFeldText(fieldNR);
    console.log(feldText);

    return feldText;
  }
  
  function close(){
    var modal = document.getElementById("modalWindow");
    modal.style.display = "none";
  }



























