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

    //den Würfel-Button weitergeben
    nextSpieler(idgesamt,nextID);
    

    //aktuelles Feld holen neues Feld berechnen & einfärben
    var fieldID = NextField(id);        

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

            } else {
              Output(obj[zahl]);
            }  
    
          });
        break;
        default:
          Output(FieldText);
      }


  

    // //Funktionen der Felder ausführen
    // var functionName = "Feld"+fieldID;
    // executeFunctionByName(functionName,window,id);

 }


 function NextField(id){

    //Zahl generieren
    var zahl = Math.floor(Math.random() * 6) + 1;   

    //position holen
    var positionFeld = document.getElementById('position'+id);
    var position = positionFeld.innerHTML;
    position = parseInt(position);

    //neue Position berechnen und setzen
    var nextPosition = position + zahl;
    positionFeld.innerHTML = nextPosition;


    // das SVG Element holen
    var mySVG = document.getElementById('svg_obj'),
    svgDoc;
    svgDoc = mySVG.contentDocument;

    //neue FeldID
    var neuesFeld = "Feld"+nextPosition;

    //Die Koordinaten des neuen Feldes
    var svgItem = svgDoc.getElementById(neuesFeld);
    
    //Die Koordinaten von Feld1 holen
    var Feld1 = svgDoc.getElementById("Feld2").getBoundingClientRect();
    var Feld1Top =  Feld1.x;    
    Feld1Top = Feld1Top-30;
    var Feld1Left = Feld1.y;
    Feld1Left = Feld1Left-15;   
    

    //Koordinaten vom nächsten Feld holen
    var x = svgItem.getBoundingClientRect();
    var top = Math.round(x.top + pageYOffset);
    var left = Math.round(x.left + pageXOffset);
    
    left = left + 25;
    topPX = top+"px";
    leftPX = left+"px";

    //Spielerfigur holen
    var figur = getSpielerFigur(id);

    //Spielfigur hinzufügen
    document.getElementById("svg_div").innerHTML += figur;
    
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
        var pos = allefiguren.item(i).getBoundingClientRect();  
        
        if (top == Math.round(pos.top) && left == Math.round(pos.left)) {
          
          //Die Spielfigur auf Feld1 setzen          
          var spielerAufEins = document.getElementById("svg_figur"+i);

          //Positionsfeld auf 1 setzen
          var PositionsfeldSpieler = document.getElementById("position"+i); 
          PositionsfeldSpieler.innerHTML = "1";
          
          spielerAufEins.style.top = Feld1Left+"px";
          spielerAufEins.style.left = Feld1Top+"px";

          addModalContent("Tut mir leid, dass du geschlagen wurdest.")
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
        "Geh auf Feld 32",
        "Trink 5 und gehe zum Start",
        "IHNN",
        "Du bist jetzt Questionmaster",
        "Kategorie",
        "Alle Mädls trinken",
        "WDL",
        "Abstimmung, dann der nüchternste trinkt",
        "Der Älteste trinkt",
        "Du bist jetzt Nosemaster",
        "Regel",
        "P",
        "Wwae-Frage8Stimmt ab)",
        "Stein/Schere/Papier um 5 Schluckk",
        "Such dir einen aus der trinkt",
        "Kopf oder Zahl",
        "TRINK",
        "WDL",
        "Pferderennen",
        "BONUS: TRINKE IMMER 2x so viel",
        "Kategorie",
        "Du bist jetzt Questionmaster",
        "Kopf oder Zahl",
        "IHNN",
        "WWAE",
        "Alle Ausländer trinken",
        "Alle Jungs trinken",
        "WDL",
        "Regel",
        "Du bist jetzt Nosemaster",
        "P",
        "Hole alles auf was du auf den weitesten zurückliegst.",
        "Gehe auf Start",
        "Wasserfall",
        "Gehe 2 Felde zurück",
        "Pantomime",
        "Kategorie",
        "Abstimmung, dann der nüchternste trinkt",
        "IHNN",
        "Alle Dummen trinken",
        "Die kleinste trinkt",
        "Der größte trinkt",
        "Such dir einen aus der trinkt",
        "P",
        "Gehe auf Feld 38",
        "Der Jüngste trinkt",
        "Alle mit kleinen Geschwistern trinken",
        "Sing ein Lied von Mia Julia oder Trink 5 Schluck",
        "Such jemanden aus der wieder auf Start geht",
        "SAUF",
        "Pantomime",
        "Kopf oder Zahl",
        "Kategorie",
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
        "Montagsmaler",
        "Würfel nochmal",
        "WWAE",
        "Alle die Single sind trinken",
        "Abstimmung, dann der nüchternste trinkt",
        "Wasserfall",
        "Der, der zuletzt auf dem Klo war muss trinken",
        "Stimme einen Schlager an. Wenn mehr als 2 mitsingen trinken alle.",
        "Montagsmaler",
        "Würfel noch mal und gehe rückwärts",
        "Stein/Schere/Papier um 10 Schluckk",
        "WWAE",
        "Pantomime",
        "Hol SpielerXY ein neues Getränk",
        "Gehe auf Feld 69",
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
        "Pantomime",
        "Montagsmaler",
        "Ex und jemand anderes muss auch exen",
        "Wasserfall",
        "Ex und hop",
        "Gehe auf Feld 38(Fick dich Animation)",
        "ZIEL"
    ];

    var FeldText = felder[FieldID];

    return FeldText;


 }

 function getSpielerFigur(id){
    
    var figur = $('#figur'+id).html();

     var spieler = '<object class="figur" style="position: absolute;" id="svg_figur'+id+'" data="../assets/figures/svg/'+figur+'" type="image/svg+xml" height="5%" width="5%"></object>';
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
    var positionFeld = document.getElementById('position'+id);
    var position = positionFeld.innerHTML;
    position = parseInt(position);
  
    positionFeld.innerHTML = fieldNR;
  

    feldText = nextFeld.firstChild.innerHTML;
  
    return feldText;
  }
  
  function close(){
    var modal = document.getElementById("modalWindow");
    modal.style.display = "none";
  }
  
  function CoinToss(){
  
    var zahl = Math.floor(Math.random() * 1);
  
    if(zahl > 0){
      return "Kopf";
    }else{
      return "Zahl";
    }
  
  }
  
  function NewRoll(){
  
    var zahl = Math.floor(Math.random() * 6) + 1;
  
    return zahl;
  
  }







function Feld2(){
  return;
}

function Feld3(id){
  setNewField(id,32);

}

























