#DF1 Logga in - Tester

<table>
	<tr>
		<th>TestID</th>
		<th>Beskrivning</th>
		<th>Indata</th>
		<th>Förväntad utdata</th>
	</tr>
	<tr>
		<td>DF1.1</td>
		<td>Inloggning utan uppgifter</td>
		<td>användarnamn: "", lösenord: ""</td>
		<td>Felmeddelande: Användarnamn saknas</td>
	</tr>
	<tr>
		<td>DF1.2</td>
		<td>Inloggning med endast användarnamn</td>
		<td>användarnamn: "Student", lösenord: ""</td>
		<td>Lösenord saknas</td>
	</tr>
	<tr>
		<td>DF1.3</td>
		<td>Inloggning med endast lösenord</td>
		<td>användarnamn: "", lösenord: "Lösenord"</td>
		<td>Användarnamn saknas</td>
	</tr>
	<tr>
		<td>DF1.4</td>
		<td>Inloggning med fel användarnamn</td>
		<td>användarnamn: "Lovisa", lösenord: "Lösenord"</td>
		<td>Felaktigt användarnamn och/eller lösenord</td>
	</tr>
	<tr>
		<td>DF1.5</td>
		<td>Inloggning med fel lösenord</td>
		<td>användarnamn: "Student", lösenord: "hedenhös"</td>
		<td>Felaktigt användarnamn och/eller lösenord</td>
	</tr>
	<tr>
		<td>DF1.6</td>
		<td>Lyckad inloggning som student</td>
		<td>användarnamn: "Student", lösenord: "Lösenord"</td>
		<td>Studentvyn visas</td>
	</tr>
	<tr>
		<td>DF1.7</td>
		<td>Lyckad inloggning som lärare</td>
		<td>användarnamn: "Lärare", lösenord: "Lösenord"</td>
		<td>Lärarvyn visas</td>
	</tr>
	<tr>
		<td>DF1.8</td>
		<td>Lyckad inloggning som administratör</td>
		<td>användarnamn: "Admin", lösenord: "Lösenord"</td>
		<td>Administratörsvyn visas</td>
	</tr>
	<tr>
		<td>DF1.2</td>
		<td>Försök logga in när du redan är inloggad</td>
		<td>Gör testfall DF1.6, begär sedan url'en index.php?action=login</td>
		<td>Studentvyn visas</td>
	</tr>
	<tr>
		<td>DF1.10</td>
		<td>Alla ovanstående testfall fast med javascript avstängt</td>
		<td></td>
		<td></td>
	</tr>
</table>