#Vision
<table>
    <tr>
        <th>Datum</th>
        <th>H�ndelse</th>
        <th>F�rfattare</th>
    </tr>
    <tr>
        <td>18/9-2014</td>
        <td>Skapades</td>
        <td>Svante Arvedson</td>
    </tr>
    <tr>
        <td>14/10-2014</td>
        <td>Ändrat CSS-ramverk fron Bootstrap till Foundation</td>
        <td>Svante Arvedson</td>
    </tr>
</table>

##Problem/Bakgrundsbeskrivning
Det �r sv�rt f�r studenter p� webbprogrammerarutbildningen att p� ett snabbt 
och enkelt s�tt under kursernas g�ng veta om de har l�rt sig de viktiga 
teoretiska delarna av kursinneh�llet. I nul�get �r det egentligen f�rst i 
slutet av kursen som studenten har en m�jlighet att veta hur v�l man har l�rt 
sig de teoretiska delarna och hur v�l man har l�st exempelvis kurslitteraturen.    
Den h�r applikationen skall underl�tta den l�pande kollen att studenten har 
l�rt sig r�tt saker genom att l�ta hen g�ra quiz p� de enskilda kursdelarna. 
Quizen skapas av kursl�rarna och handlar om de f�r kursen relevanta teoretiska 
kunskaperna. Quizen skall inte vara detsamma som prov och skall inte heller 
anv�ndas som redskap f�r exempelvis tentamens, utan endast vara ett st�d f�r 
studenten s� att hen vet att hen har l�rt sig r�tt saker. Studenten ska f�rutom 
att kunna g�ra quiz ocks� kunna f� upp en sammanst�llning �ver sina resultat 
och vilka delar som hen har kvar att testa sig p�.

##Anv�ndare
+   **Studenter**    
    Gruppen best�r av de studenter som �r registrerade p� programmet 
    f�r webbprogrammering p� LNU. De vill kunna kolla och kontrollera 
    att de har l�rt sig den teoretiska delan av kursernas inneh�ll. 
    De vill kunna f� upp en sammanst�llning �ver hur v�l de har klarat 
    av de olika quizen.

+   **Kursl�rare**    
    Kursl�rarna vill kunna skriva och skapa quiz som deras studenter ska kunna 
    g�ra. L�rarna vill kunna g� inoch �ndra quiz som redan skapats f�r att 
    f�rb�ttar dem eller uppdatera dem om kursinneh�llet �ndras. De vill kunna 
    se sammanst�llningar �ver jur bra studenterna har klarat av quizen f�r att 
    exempelvis kunna hitta sv�rformulerade fr�gor eller f�r att kunnase vilka 
    saker som verkar vara sv�rt f�r studenterna att l�ra sig.    
    Kursl�rarna har ochs� ansvar f�r att l�gga till studenter och att ansluta 
    studenter till r�tt kurser.

+   **Administrat�r**    
    Administrat�ren vill kunna l�gga till och ta bort kursl�rare fr�n systemet. 
    Administrat�ren ska ochs� kunna redigera quiz om det exempelvis kommer 
    klagom�l p� formuleringar fr�n anv�ndarna.

##Liknande system
Det finns flera andra system som underl�ttar skapande och genomf�rande av quiz, 
exempelvis p� facebook.

##Intressenter
+   **Svante Arvedson**    
    Skapare och f�rfattare till systemet. G�r projektet som en del av 
    kursen *Webbutveckling med PHP*.

+   **Daniel Toll och Emil Carlsson, LNU**    
    L�rare i kursen *Webbutveckling med PHP*. Handleder projektet och 
    betygs�tter resultatet.

##Tekniker
Applikationen skall skrivas med skr�ket [PHP](http://php.net/) p� serversidan 
och med spr�ken JavaSqript, CSS och HTML p� klientsidan. Till klientkoden skall 
ramverket [Foundation](http://foundation.zurb.com/) anv�ndas. Applikationens 
databas �r av typen [MySQL](http://www.mysql.com/).

##Baskrav
+   **BF1** - Applikationen ska g� att anv�nda fr�n desktopmilj�er s�v�l som 
    fr�n handh�llna enheter.
+   **BF2** - Applikationen ska kunna fungera i de nyare versionerna av 
    webbl�sarna IE, FireFox, Chrome och Safari.
+   **BF3** - Kursl�rare och administrat�rer ska snabbt och enkelt kunna 
    hantera quiz, kurser och studenter.