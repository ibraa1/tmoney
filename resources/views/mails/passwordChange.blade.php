<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création de compte</title>
</head>
<body>
    <table style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <tr>
            <td style="background-color: #f8f8f8; padding: 40px; text-align: center;">
                <h2 style="font-size: 24px; margin-bottom: 20px;">Création de compte</h2>
                <p>Bonjour <strong>{{ $nom }}</strong>,</p>
                <p>Bienvenue sur TMoney ! Nous sommes ravis de vous compter parmi nos utilisateurs.</p>
            </td>
        </tr>
        <tr>
            <td style="background-color: #ffffff; padding: 40px;">
                <p>Voici votre mot de passe temporaire : <strong>{{ $password }}</strong></p>
                <p>Nous vous recommandons de changer votre mot de passe dès votre première connexion. Vous pouvez le faire en accédant à votre profil et en sélectionnant l'option "Changer le mot de passe".</p>
                <p>Si vous avez des questions ou avez besoin d'aide, n'hésitez pas à nous contacter.</p>
                <p>Merci encore et profitez de votre expérience sur notre application !</p>
                <p>Cordialement,</p>
                <p>L'équipe TMoney</p>
            </td>
        </tr>
    </table>
</body>
</html>
