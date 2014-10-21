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
		<td>Efterfråga att se quiz utan at ha rättigheter till det</td>
		<td>Logga in som Student [användarnamn: "Student", lösenord: "Lösenord"], begär URL'en index.php?action=doQuiz&quiz=3</td>
		<td>Redirectad till "Mina kurser", felmeddelande: "Du har inte rättigheter att se den begärda sidan"</td>
	</tr>
	<tr>
		<td>AF14.4</td>
		<td>Efterfråga att se quiz som inte finns</td>
		<td>Logga in som Admin, begär URL'en index.php?action=doQuiz&quiz=3000</td>
		<td>Redirectad till "Mina kurser", felmeddelande: "Du har inte rättigheter att se den begärda sidan"</td>
	</tr>
</table>