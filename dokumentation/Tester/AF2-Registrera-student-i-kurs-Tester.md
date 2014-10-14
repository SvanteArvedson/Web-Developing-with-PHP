#AF2 Registrera student i kurs - Tester

<table>
	<tr>
		<th>TestID</th>
		<th>Beskrivning</th>
		<th>Indata</th>
		<th>Förväntad utdata</th>
	</tr>
	<tr>
		<td>AF2.1</td>
		<td>Öppna registreringsformuläret inloggad som student</td>
		<td>Logga in som student, begär url'en index.php?action=addStudent</td>
		<td>Tillbaka till startsidan</td>
	</tr>
	<tr>
		<td>AF2.2</td>
		<td>Öppna registreringsformuläret utan att vara inloggad</td>
		<td>Begär url'en index.php?action=addStudent</td>
		<td>Tillbaka till login sidan</td>
	</tr>
	<tr>
		<td>AF2.3</td>
		<td>Öppna registreringsformuläret inloggad som lärare</td>
		<td>Logga in som lärare, klicka på länken "Lägg student till kurs"</td>
		<td>Registreringsformulär visas</td>
	</tr>
	<tr>
		<td>AF2.4</td>
		<td>Öppna registreringsformuläret inloggad som administratör</td>
		<td>Logga in som administratör, klicka på länken "Lägg student till kurs"</td>
		<td>Registreringsformulär visas</td>
	</tr>
</table>