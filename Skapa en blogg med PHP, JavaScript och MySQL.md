# Skapa en blogg med PHP, JavaScript och MySQL



En blogg har två perspektiv: ett för läsaren och ett för administratören. Läsaren interagerar med innehållet och förväntar sig ett nyhetsflöde med blogginlägg, medan admin skapar nytt innehåll och hanterar befintligt innehåll. Innan vi börjar arbeta med själva koden låt oss definiera de viktigaste funktionerna som bloggen behöver.



**Admin**

- Logga in / logga ut

- Få tillgång till en särskild adminsida

- Skapa nya blogginlägg

- Ta bort blogginlägg

- Redigera blogginlägg

**Läsare**

- Läsa blogginlägg



Det här är egentligen allt som krävs för en blogg i sin mest grundläggande form. Vi kan göra den mer avancerad genom att lägga till andra funktioner som kommentering eller sortering av innehåll med olika filter och så vidare. Men det ska vi inte göra åtminstone inte än. Jag tycker generellt att det är en bra idé när man börjar bygga något nytt att stanna upp en stund och fundera på vad som är absolut nödvändigt och undvika att fokusera på det som är ”extra”. Först efter att ha definierat detta börjar vi bygga.

Så, är vi redo att koda nu? Nej, inte riktigt än. Låt oss först definiera hur vi ska lösa våra problem. Även om vi i slutändan löser dem på ett annat sätt i den färdiga produkten är det bra att tänka igenom det i förväg – det hjälper oss att bygga upp en mental bild av projektet.



#### Databas

Vi kommer att lagra data i en databas låt oss definera vilken data vi ska hantera. Vi kommer behöva två tabeller.

**Blogginlägg**

* Text

* Bild

* Datum

**Administratör**

* Användarnamn

* Lösenord



#### Webbsidor

Applikationen kommer bestå av två sidor en för användaren att läsa blogginläggen på i ett nyhetsflöde och en för admin med utbyggd funktionalitet för att hantera blogginläggen.

* Index

* Admin



#### Formulär

För att skapa interaktion av webbplatsen behöver vi några formulär.

* Inloggning

* Skapa ett blogginlägg

* Redigera ett blogginlägg



#### Knappar

För vissa funktioner kommer vi att behöva ha knappar på webbplatsen knappar som finns i formulär listar vi inte.

* Redigera ett blogginlägg

* Radera ett blogginlägg

* Skapa ett blogginlägg

* Logga ut



Det känns nu som att vi har en bra grund att börja bygga vår applikation på. Vi har funderat ut de nödvändiga funktionerna och kan tryggt börja skapa vår applikation. Jag kommer nu visa steg för steg hur vi bygger upp bloggen.














