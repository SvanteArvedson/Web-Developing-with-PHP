#AF14 G�r quiz - Tester

<table>
	<tr>
		<th>TestID</th>
		<th>Beskrivning</th>
		<th>Indata</th>
		<th>F�rv�ntad utdata</th>
	</tr>
	<tr>
		<td>AF14.1</td>
		<td>Efterfr�ga quiz utan att vara inloggad</td>
		<td>beg�r URL'en index.php?action=doQuiz&quiz=1</td>
		<td>Redirectad till index.php</td>
	</tr>
	<tr>
		<td>AF14.2</td>
		<td>Efterfr�ga att se quiz</td>
		<td>Logga in som Admin, beg�r URL'en index.php?action=doQuiz&quiz=1</td>
		<td>Det valda quizet visas</td>
	</tr>
	<tr>
		<td>AF14.3</td>
		<td>Efterfr�ga att se quiz utan att ha r�ttigheter till det</td>
		<td>Logga in som Student [anv�ndarnamn: "Student", l�senord: "L�senord"], beg�r URL'en index.php?action=doQuiz&quiz=3</td>
		<td>Redirectad till "Mina kurser", felmeddelande: "Du har inte beh�rgihet att se den beg�rda sidan"</td>
	</tr>
	<tr>
		<td>AF14.4</td>
		<td>Efterfr�ga att se quiz som inte finns</td>
		<td>Logga in som Admin, beg�r URL'en index.php?action=doQuiz&quiz=3000</td>
		<td>Redirectad till "Alla kurser", felmeddelande: "Det efterfr�gade quizet existerar inte"</td>
	</tr>
	<tr>
		<td>AF14.5</td>
		<td>F�rs�ka se resultat utan att ha gjort quiz f�rst</td>
		<td>Logga in som Admin, beg�r URL'en index.php?action=showResult utan att ha gjort qtt quiz f�rst</td>
		<td>Redirectad till "Mina kurser", felmeddelande: "Du kan inte g�ra detta just nu"</td>
	</tr>
	<tr>
		<td>AF14.6</td>
		<td>F�rs�ka se resultat utan att vara inloggad</td>
		<td>Beg�r URL'en index.php?action=showResult utan att vara inloggad</td>
		<td>Redirectad till index.php</td>
	</tr>
	<tr>
		<td>AF14.7</td>
		<td>Skicka in quiz utan att ha svarat p� alla fr�gorna</td>
		<td>Logga in som Admin, beg�r URL'en index.php?action=doQuiz&quiz=1, skicka in svar utan att ha svarat p� alla fr�gorna</td>
		<td>Felmeddelande: "Svara p� samtliga fr�gor innan du skickar in"</td>
	</tr>
	<tr>
		<td>AF14.8</td>
		<td>Avbryt ett quiz genom att trycka p� knappen "Avbryt"</td>
		<td>Logga in som Admin, beg�r URL'en index.php?action=doQuiz&quiz=1, klicka p� knappen "Avbryt"</td>
		<td>Redirectad till kurssidan</td>
	</tr>
	<tr>
		<td>AF14.9</td>
		<td>G�r ett quiz och f� ett resultat</td>
		<td>Logga in som Admin, beg�r URL'en index.php?action=doQuiz&quiz=1, svara p� fr�gorna och skicka in quizet</td>
		<td>En resultatsida visas med din po�ng och r�tt svar p� alla fr�gorna</td>
	</tr>
	<tr>
		<td>AF14.10</td>
		<td>G�r ett quiz och f� ett resultat, klicka p� "Tillbaks till kurssidan"</td>
		<td>G�r AF14.11, klicka sedan p� knappen "Tillbaks till kurssidan"</td>
		<td>Kurssidan visas</td>
	</tr>
</table>