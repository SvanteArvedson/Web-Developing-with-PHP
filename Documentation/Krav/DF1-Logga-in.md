#DF1 - Logga in
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
</table>

Användaren autentiserar sig och loggar in i systemet.

##Primär aktör
+   Användare

##Sekundär aktör
+   Systemet

##Förkrav
Inga förkrav.

##Efterkrav
Användaren ska vara inloggad.

##Scenario
+ 1 - DF1 startar när en användare vill autentisera sig och logga in
+ 2 - Systemet presenterar ett inloggningsformulär
+ 3 - Användaren matar in sina [autentisieringsuppgifter](../Ordlista.md)
+ 4 - Systemet loggar in användaren

##Alternativscenario
+ 3a - Användarens uppgifter är felaktiga
    + 1 - Systemet visar felmeddelande
    + 2 - *Gå tillbaka till punkt 3*
+ 4a - Ett fel inträffar när systemet ska logga in personen
    + 1 - Systemet visar ett felmeddelande
    + 2 - *Gå tillbaka till punkt 3*