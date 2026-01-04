<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Code de vérification</title>
</head>
<body>
    <h2>Authentification à deux facteurs</h2>

    <p>Bonjour {{ $user->name }},</p>

    <p>Voici votre code de vérification :</p>

    <h1 style="letter-spacing: 5px;">
        {{ $user->two_factor_code }}
    </h1>

    <p>
        Ce code est valable <strong>5 minutes</strong>.
    </p>

    <p>
        Si vous n'êtes pas à l'origine de cette demande, ignorez cet email.
    </p>
</body>
</html>
