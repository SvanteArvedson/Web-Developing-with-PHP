#Vision
<table>
    <tr>
        <th>Datum</th>
        <th>Händelse</th>
        <th>Författare</th>
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
Det är svårt för studenter på webbprogrammerarutbildningen att på ett snabbt 
och enkelt sätt under kursernas gång veta om de har lärt sig de viktiga 
teoretiska delarna av kursinnehållet. I nuläget är det egentligen först i 
slutet av kursen som studenten har en möjlighet att veta hur väl man har lärt 
sig de teoretiska delarna och hur väl man har läst exempelvis kurslitteraturen.    
Den här applikationen skall underlätta den löpande kollen att studenten har 
lärt sig rätt saker genom att låta hen göra quiz på de enskilda kursdelarna. 
Quizen skapas av kurslärarna och handlar om de får kursen relevanta teoretiska 
kunskaperna. Quizen skall inte vara detsamma som prov och skall inte heller 
användas som redskap för exempelvis tentamens, utan endast vara ett stöd för 
studenten så att hen vet att hen har lärt sig rätt saker. Studenten ska förutom 
att kunna göra quiz också kunna få upp en sammanställning över sina resultat 
och vilka delar som hen har kvar att testa sig på.

##Användare
+   **Studenter**    
    Gruppen består av de studenter som är registrerade på programmet 
    för webbprogrammering på LNU. De vill kunna kolla och kontrollera 
    att de har lärt sig den teoretiska delan av kursernas innehåll. 
    De vill kunna få upp en sammanställning över hur väl de har klarat 
    av de olika quizen.

+   **Kurslärare**    
    Kurslärarna vill kunna skriva och skapa quiz som deras studenter ska kunna 
    göra. Lärarna vill kunna gå inoch ändra quiz som redan skapats för att 
    förbättar dem eller uppdatera dem om kursinnehållet ändras. De vill kunna 
    se sammanställningar över jur bra studenterna har klarat av quizen för att 
    exempelvis kunna hitta svårformulerade frågor eller för att kunnase vilka 
    saker som verkar vara svårt för studenterna att lära sig.    
    Kurslärarna har ochså ansvar för att lägga till studenter och att ansluta 
    studenter till rätt kurser.

+   **Administratör**    
    Administratören vill kunna lägga till och ta bort kurslärare från systemet. 
    Administratören ska också kunna lägga till, ändra och ta bort studentkonton.

##Liknande system
Det finns flera andra system som underlättar skapande och genomförande av quiz, 
exempelvis på facebook.

##Intressenter
+   **Svante Arvedson**    
    Skapare och författare till systemet. Gör projektet som en del av 
    kursen *Webbutveckling med PHP*.

+   **Daniel Toll och Emil Carlsson, LNU**    
    Lärare i kursen *Webbutveckling med PHP*. Handleder projektet och 
    betygsätter resultatet.

##Tekniker
Applikationen skall skrivas med skråket [PHP](http://php.net/) på serversidan 
och med språken JavaSqript, CSS och HTML på klientsidan. Till klientkoden skall 
ramverket [Foundation](http://foundation.zurb.com/) användas. Applikationens 
databas är av typen [MySQL](http://www.mysql.com/).

##Baskrav
+   **BF1** - Applikationen ska gå att använda från desktopmiljöer såväl som 
    från handhållna enheter.
+   **BF2** - Applikationen ska kunna fungera i de nyare versionerna av 
    webbläsarna IE, FireFox, Chrome och Safari.
+   **BF3** - Kurslärare och administratörer ska snabbt och enkelt kunna 
    hantera quiz, kurser och studenter.