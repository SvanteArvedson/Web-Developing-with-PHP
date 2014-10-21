#AF14 Gör quiz - Tester

<table>
	<tr>
		<th>TestID</th>
		<th>Beskrivning</th>
		<th>Indata</th>
		<th>Förväntad utdata</th>
	</tr>
	<tr>
		<td>AF14.1</td>
		<td>Efterfråga quiz utan att vara inloggad</td>
		<td>begör URL'en index.php?action=doQuiz&quiz=1</td>
		<td>Redirectad till index.php</td>
	</tr>
	<tr>
		<td>AF14.2</td>
		<td>Efterfråga att se quiz</td>
		<td>Logga in som Admin, begär URL'en index.php?action=doQuiz&quiz=1</td>
		<td>Det valda quizet visas</td>
	</tr>
	<tr>
		<td>AF14.3</td>
		<td>Efterfråga att se quiz utan att ha rättigheter till det</td>
		<td>Logga in som Student [användarnamn: "Student", lösenord: "Lösenord"], begär URL'en index.php?action=doQuiz&quiz=3</td>
		<td>Redirectad till "Mina kurser", felmeddelande: "Du har inte behörgihet att se den begärda sidan"</td>
	</tr>
	<tr>
		<td>AF14.4</td>
		<td>Efterfråga att se quiz som inte finns</td>
		<td>Logga in som Admin, begär URL'en index.php?action=doQuiz&quiz=3000</td>
		<td>Redirectad till "Alla kurser", felmeddelande: "Det efterfrågade quizet existerar inte"</td>
	</tr>
	<tr>
		<td>AF14.5</td>
		<td>Försöka se resultat utan att ha gjort quiz först</td>
		<td>Logga in som Admin, begär URL'en index.php?action=showResult utan att ha gjort qtt quiz först</td>
		<td>Redirectad till "Mina kurser", felmeddelande: "Du kan inte göra detta just nu"</td>
	</tr>
	<tr>
		<td>AF14.6</td>
		<td>Försöka se resultat utan att vara inloggad</td>
		<td>Begär URL'en index.php?action=showResult utan att vara inloggad</td>
		<td>Redirectad till index.php</td>
	</tr>
	<tr>
		<td>AF14.7</td>
		<td>Skicka in quiz utan att ha svarat på alla frågorna</td>
		<td>Logga in som Admin, begär URL'en index.php?action=doQuiz&quiz=1, skicka in svar utan att ha svarat på alla frågorna</td>
		<td>Felmeddelande: "Svara på samtliga frågor innan du skickar in"</td>
	</tr>
	<tr>
		<td>AF14.8</td>
		<td>Avbryt ett quiz genom att trycka på knappen "Avbryt"</td>
		<td>Logga in som Admin, begär URL'en index.php?action=doQuiz&quiz=1, klicka på knappen "Avbryt"</td>
		<td>Redirectad till kurssidan</td>
	</tr>
	<tr>
		<td>AF14.9</td>
		<td>Gör ett quiz och få ett resultat</td>
		<td>Logga in som Admin, begär URL'en index.php?action=doQuiz&quiz=1, svara på frågorna och skicka in quizet</td>
		<td>En resultatsida visas med din poäng och rätt svar på alla frågorna</td>
	</tr>
	<tr>
		<td>AF14.10</td>
		<td>Gör ett quiz och få ett resultat, klicka på "Tillbaks till kurssidan"</td>
		<td>Gör AF14.11, klicka sedan på knappen "Tillbaks till kurssidan"</td>
		<td>Kurssidan visas</td>
	</tr>
</table>