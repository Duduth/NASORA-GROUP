const express = require('express');
const mongoose = require('mongoose');
const cors = require('cors');
const bodyParser = require('body-parser');

const app = express();
const port = 3000;

// Middleware pour traiter le corps des requêtes JSON
app.use(bodyParser.json());

// Middleware pour permettre CORS
app.use(cors());

// Connexion à MongoDB (assurez-vous d'avoir MongoDB en cours d'exécution)
mongoose.connect('mongodb://localhost:27017/monCRM', { useNewUrlParser: true, useUnifiedTopology: true });
const db = mongoose.connection;

// Schéma MongoDB pour les rapports
const reportSchema = new mongoose.Schema({
  date: Date,
  prospectName: String,
  speciality: String,
  site: String,
  comments: String
});

// Modèle MongoDB pour les rapports
const Report = mongoose.model('Report', reportSchema);

// Endpoint GET pour récupérer des rapports
app.get('/api/reports', async (req, res) => {
  try {
    const reports = await Report.find();
    res.json(reports);
  } catch (error) {
    res.status(500).json({ error: 'Internal Server Error' });
  }
});

// Endpoint POST pour soumettre un rapport
app.post('/api/submit-report', async (req, res) => {
  const newReport = req.body;
  try {
    const createdReport = await Report.create(newReport);
    res.json({ message: 'Report submitted successfully', report: createdReport });
  } catch (error) {
    res.status(500).json({ error: 'Internal Server Error' });
  }
});

// Démarrer le serveur
app.listen(port, () => {
  console.log(`Server running on http://localhost:${port}`);
});
