const express = require('express');
const app = express();
const bcrypt = require('bcrypt');
const PORT = process.env.PORT || 3000;

app.use(express.urlencoded({ extended: true }));

// Vos routes et logique d'authentification seront ajoutées ici...
app.post('/nasmedic/login', async (req, res) => {
    const { email, password } = req.body;

    // Vérification des données d'entrée
    if (!email || !password) {
        return res.status(400).send('Adresse e-mail et mot de passe requis');
    }

    try {
        // Remplacez cette partie avec la logique de recherche de l'utilisateur dans votre base de données
        const user = { email: 'msane@gmail.com', password: 'nasora2024' };

        // Vérification du mot de passe
        const passwordMatch = await bcrypt.compare(password, user.password);

        if (!passwordMatch) {
            return res.status(401).send('Adresse e-mail ou mot de passe incorrect');
        }

        // Authentification réussie
        res.redirect('/nasmedic.html');
    } catch (error) {
        console.error(error);
        res.status(500).send('Erreur serveur');
    }
});


app.listen(PORT, () => {
    console.log(`Serveur en écoute sur le port ${PORT}`);
});
