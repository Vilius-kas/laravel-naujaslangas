<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <p>Naujas kontaktas sukurtas:</p>

<p>Vardas: {{ $contact->name }}</p>
<p>El. paštas: {{ $contact->email }}</p>
<p>Telefonas: {{ $contact->phone }}</p>

<p>Ačiū!</p>
</body>
</html>