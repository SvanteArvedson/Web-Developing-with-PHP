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
		<td>Efterfr�ga att se quiz utan at ha r�ttigheter till det</td>
		<td>Logga in som Student [anv�ndarnamn: "Student", l�senord: "L�senord"], beg�r URL'en index.php?action=doQuiz&quiz=3</td>
		<td>Redirectad till "Mina kurser", felmeddelande: "Du har inte r�ttigheter att se den beg�rda sidan"</td>
	</tr>
	<tr>
		<td>AF14.4</td>
		<td>Efterfr�ga att se quiz som inte finns</td>
		<td>Logga in som Admin, beg�r URL'en index.php?action=doQuiz&quiz=3000</td>
		<td>Redirectad till "Mina kurser", felmeddelande: "Du har inte r�ttigheter att se den beg�rda sidan"</td>
	</tr>
</table>