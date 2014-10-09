#AF14 - Gör quiz
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

En använadare svarar på ett quiz.

##Primär aktör
+   Student

##Sekundär aktör
+   Systemet

##Förkrav
+   **DF1** Logga in

##Efterkrav
+   Resultatet av quizet har sparats.

##Scenario
+ 1 - AF14 startar när en användare vill svara på ett quiz
+ 2 - Systemet visar upp kurserna som användaren är registrerad på
+ 3 - Användaren väljer vilken kurs hen vill göra ett quiz inom
+ 4 - Systemet visar upp quiz som tillhör kursen, samt information om vilka quiz som användaren redan har gjort
+ 5 - Användaren väljer vilket quiz som hen vill svara på
+ 6 - Systemet visar frågorna och svarsalternativen som tillhör quizet
+ 7 - Användaren svarar på frågorna och skickar in svaret
+ 8 - Systemet presenterar användarens resultat och sparar resultatet

##Alternativscenario
+ 2a - Användaren är inte registrerad på någon kurs
    + 1 - Systemet visar ett informationsmeddelande
    + 2 - *AF14 slut*
+ 4a - Det finns inga quiz skapade inom den valda kursen
    + 1 - Systemet visar ett informationsmeddelande och erbjuder val av annan kurs
    + 2 - *Tillbaka till punkt 2*
+ 7a - Ett fel inträffar när användaren skickar in svaren
    + 1 - Systemet visar ett felmeddelande och erbjuder använadren att göra om quizet
    + 2 -*Tillbaka till punkt 6*