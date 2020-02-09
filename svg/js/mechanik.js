  function roll(elem){

    var idgesamt = elem.parentNode.id;
    var id = idgesamt.substr(-1);
    var nextID = parseInt(id)+1;
    var spieler = document.getElementById('spielerinfo').rows[0].cells.length;
    spieler = parseInt(spieler);
    spieler--;
  
  //wenn der letzte spieler erreicht wurde wieder am anfang setzen
  if (nextID == spieler) {
    nextID = 0;
  }

    //den Würfel-Button weitergeben
    nextSpieler(idgesamt,nextID);

    //aktuelles Feld holen neues Feld berechnen & einfärben
    var fieldID = NextField(id);

    // Feldtext Ausgabe
    var FieldText = getFeldText(fieldID);
    Output(FieldText);


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

    //Das neue feld einfäreben und das Alte wieder auf weiß
    var svgItem = svgDoc.getElementById(neuesFeld);
    var x = svgItem.getBoundingClientRect();

    var top = x.top + pageYOffset;
    var left = x.left + pageXOffset;
    left = left + 25;
    top += "px";
    left += "px";

    var figur = getSpielerFigur(id);

    var svg = document.getElementById('svg_obj');
    document.getElementById("svg_div").innerHTML += figur;
    
    var spielFigur = "svg_figur"+id;

    figur = document.getElementById(spielFigur);
    figur.style.left = left;
    figur.style.top = top;


    return nextPosition;

 }

 function getFeldText(FieldID){

    var felder =[
        "",
        "Start",
        "Alle trinken",
        "Geh auf Feld 32",
        "Trink 5 und gehe zum Start",
        "(Ich hab noch nie)",
        "Du bist jetzt Questionmaster",
        "Kategorie",
        "Alle Mädls trinken",
        "WdL-Frage",
        "Abstimmung, dann der nüchternste trinkt",
        "Der Älteste trinkt",
        "Du bist jetzt Nosemaster",
        "Regel",
        "P-Frage",
        "Wwae-Frage8Stimmt ab)",
        "Stein/Schere/Papier um 5 Schluckk",
        "Such dir einen aus der trinkt",
        "Kopf oder Zahl",
        "TRINK",
        "WdL-Frage",
        "Pferderennen",
        "BONUS: TRINKE IMMER 2x so viel",
        "Kategorie",
        "Du bist jetzt Questionmaster",
        "Kopf oder Zahl",
        "(Ich hab noch nie)",
        "Wwae-Frage",
        "Alle Ausländer trinken",
        "Alle Jungs trinken",
        "WdL-Frage",
        "Regel",
        "Du bist jetzt Nosemaster",
        "P-Frage",
        "Hole alles auf was du auf den weitesten zurückliegst.",
        "Gehe auf Start",
        "Wasserfall",
        "Gehe 2 Felde zurück",
        "Pantomime",
        "Kategorie",
        "Abstimmung, dann der nüchternste trinkt",
        "(Ich hab noch nie)",
        "Alle Dummen trinken",
        "Die kleinste trinkt",
        "Der größte trinkt",
        "Such dir einen aus der trinkt",
        "P-Frage",
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
        "P-Frage",
        "Mädels trinekn ihre Körbchen in Schluck(A=1,B=2,...)",
        "WdL-Frage",
        "Alle Jungs trinken",
        "(Ich hab noch nie)",
        "Pferderennen",
        "Du bist jetzt Nosemaster",
        "Montagsmaler",
        "Würfel nochmal",
        "Wwae-Frage",
        "Alle die Single sind trinken",
        "Abstimmung, dann der nüchternste trinkt",
        "Wasserfall",
        "Der, der zuletzt auf dem Klo war muss trinken",
        "Stimme einen Schlager an. Wenn mehr als 2 mitsingen trinken alle.",
        "Montagsmaler",
        "Würfel noch mal und gehe rückwärts",
        "Stein/Schere/Papier um 10 Schluckk",
        "Wwae-Frage",
        "Pantomime",
        "Hol SpielerXY ein neues Getränk",
        "Gehe auf Feld 69",
        "Bestimme, wer 5 Schlucke trinken muss",
        "Kategorie",
        "Regel",
        "HAU REIN",
        "Alle Raucher trinken die Anzahl an Kippen, die sie dabei haben",
        "P-Frage",
        "Du bist jetzt Nosemaster",
        "Alle Mädls trinken",
        "Such dir einen aus der trinkt",
        "(Ich hab noch nie)",
        "Pferderennen",
        "Verteile 8 Schluck",
        "Wwae-Frage",
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
     var figuren = [
         '<object style="position: absolute;" id="svg_figur0" data="../assets/figures/svg/002-kraken.svg" type="image/svg+xml" height="5%" width="5%"></object>',
         '<object style="position: absolute;" id="svg_figur1" data="../assets/figures/svg/008-mushroom.svg" type="image/svg+xml" height="5%" width="5%"></object>',
         '<object style="position: absolute;" id="svg_figur2" data="../assets/figures/svg/014-alien.svg" type="image/svg+xml" height="5%" width="5%"></object>',
         '<object style="position: absolute;" id="svg_figur3" data="../assets/figures/svg/017-satyr.svg" type="image/svg+xml" height="5%" width="5%"></object>',
         '<object style="position: absolute;" id="svg_figur4" data="../assets/figures/svg/021-scarecrow.svg" type="image/svg+xml" height="5%" width="5%"></object>',
         '<object style="position: absolute;" id="svg_figur5" data="../assets/figures/svg/020-werewolf.svg" type="image/svg+xml" height="5%" width="5%"></object>',
     ]

     var spieler = figuren[id];
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
        break;
        case 3:
              sipsWas = parseInt(sipsWas);
    
              var sipsNow = schluck + sipsWas;
              tableField.innerHTML = sipsNow;
              return;
        break;
    
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
      var HTMLbutton = '<button onclick="javaskript:roll(this)">Würfeln</button>';
  
      var spieler = document.getElementById(idgesamt);
      spieler.innerHTML = '';
  
      var nextSpieler = document.getElementById("würfel" + nextID);
      nextSpieler.innerHTML = HTMLbutton;
  }
  
  //die zugeordnete Farbe für jeden Spieler
  function getSPielerFarbe(id){
  
    var farben = [
             "#33cccc",
             "#0066ff",
             "#ff0000",
             "#00cc00",
             "#ffff00",
             "#ff00ff"
         ];
  
  var spielerFarbe = farben[id];
  
  return spielerFarbe;
  
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
  
    //feld einfärben
    var nextFeld = document.getElementById(fieldNR);
    var feld = document.getElementById(position);
  
    nextFeld.style.backgroundColor  = getSPielerFarbe(id);
    feld.style.backgroundColor  = "white";
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