#AF2, AF3, AF8, AF9, AF12 - Tester

<table>
	<tr>
		<th>TestID</th>
		<th>Beskrivning</th>
		<th>Indata</th>
		<th>Förväntad utdata</th>
	</tr>
	<tr>
		<td>AF2.1</td>
		<td>Öppna redigeringsformulär utan att vara inloggad</td>
		<td>Logga in som student, begär url'en index.php?action=editCourse&course=1 (eller ett annat kurs-id som studenten är registrerad på)</td>
		<td>Redirectad till index.php</td>
	</tr>
	<tr>
		<td>AF2.2</td>
		<td>Öppna redigeringsformulär inloggad som student</td>
		<td>Logga in som student, begär url'en index.php?action=editCourse&course=1</td>
		<td>Redirectad till index.php?action=showCourse&course=1</td>
	</tr>
	<tr>
		<td>AF2.3</td>
		<td>Öppna redigeringsformulär inloggad som lärare</td>
		<td>Logga in som lärare, begär url'en index.php?action=editCourse&course=1</td>
		<td>Redigeringsformulär för vald kurs visas med möjlighet att redigera kursinformation och kursdeltagare</td>
	</tr>
	<tr>
		<td>AF2.4</td>
		<td>Öppna redigeringsformulär inloggad som administratör</td>
		<td>Logga in som lärare, begär url'en index.php?action=editCourse&course=1</td>
		<td>Redigeringsformulär för vald kurs visas med möjlighet att redigera kursinformation, kurslärare och kursdeltagare</td>
	</tr>
	<tr>
		<td>AF2.5</td>
		<td>Öppna redigeringsformulär som inloggad med felaktig kursId i url'en</td>
		<td>Logga in, begär url'en index.php?action=editCourse&course=1000</td>
		<td>Redirectad till index.php?action=showCourses</td>
	</tr>
	<tr>
		<td>AF12.6</td>
		<td>Försök uppdatera en kurs med tomt kursnamn</td>
		<td>Logga in, begär url'en index.php?action=editCourse&course=1, töm namnfältet och klicka på "Spara ändringar"</td>
		<td>Felmeddelande "Kursnamn saknas"</td>
	</tr>
	<tr>
		<td>AF12.7</td>
		<td>Försök uppdatera en kurs med tom kursbeskrivning</td>
		<td>Logga in, begär url'en index.php?action=editCourse&course=1, töm kursbeskrivningen och klicka på "Spara ändringar"</td>
		<td>Felmeddelande "Beskrivning saknas"</td>
	</tr>
	<tr>
		<td>AF2.8</td>
		<td>Återställ kursen till ursprungsskick</td>
		<td>Logga in, begär url'en index.php?action=editCourse&course=1, ändra i uppgifterna och klicka sedan på "Återställ"</td>
		<td>Ändringarna du gjorde ska nu vara återställda</td>
	</tr>
	<tr>
		<td>AF12.9</td>
		<td>Uppdatera kursens namn</td>
		<td>Logga in, begär url'en index.php?action=editCourse&course=1, ändra namn och klicka sedan på "Spara ändringar"</td>
		<td>Redirectad till index.php?action=showCourse&course=1, rättmeddelande "Kursen uppdaterades", kursens namn är ändrat</td>
	</tr>
	<tr>
		<td>AF12.10</td>
		<td>Uppdatera kursens beskrivning</td>
		<td>Logga in, begär url'en index.php?action=editCourse&course=1, ändra beskrivning och klicka sedan på "Spara ändringar"</td>
		<td>Redirectad till index.php?action=showCourse&course=1, rättmeddelande "Kursen uppdaterades", kursens beskrivning är ändrad</td>
	</tr>
	<tr>
		<td>AF8.11</td>
		<td>Uppdatera kursens lärare</td>
		<td>Logga in, begär url'en index.php?action=editCourse&course=1, i listan av kurslärare och klicka sedan på "Spara ändringar"</td>
		<td>Redirectad till index.php?action=showCourse&course=1, rättmeddelande "Kursen uppdaterades", kursens lärare är ändrade</td>
	</tr>
	<tr>
		<td>AF2.12</td>
		<td>Uppdatera kursens studenter</td>
		<td>Logga in, begär url'en index.php?action=editCourse&course=1, i listan av studenter och klicka sedan på "Spara ändringar"</td>
		<td>Redirectad till index.php?action=showCourse&course=1, rättmeddelande "Kursen uppdaterades", kursens studenter är ändrade</td>
	</tr>

</table>