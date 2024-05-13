<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NAS-DERM</title>
  <script src="https://cdn.jsdelivr.net/npm/exceljs/dist/exceljs.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  <style>
    body {
      text-align: center;
      background-image: url('pharmacie.jpg');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      margin: 0;
      padding: 0;
    }

    #content {
      max-width: 800px;
      margin: 0 auto;
      background-color: rgba(255, 255, 255, 0.8);
      padding: 20px;
      border-radius: 10px;
      margin-top: 20px;
    }

    .tab-content {
      display: none;
    }

    #logo {
      width: 150px;
      height: auto;
      margin-top: 20px;
    }

    table {
      width: 100%;
      margin-top: 20px;
      border-collapse: collapse;
    }

    th,
    td {
      border: 1px solid #555;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #4CAF50;
      color: white;
    }

    /* Styles pour la section des partenaires */
    .partner {
      display: inline-block;
      margin-right: 20px;
    }

    .carousel {
      white-space: nowrap;
      overflow-x: auto;
      overflow-y: hidden;
      -webkit-overflow-scrolling: touch;
      scrollbar-width: none;
      -ms-overflow-style: none;
    }

    .carousel::-webkit-scrollbar {
      display: none;
    }

    .partner img {
      max-width: 150px;
      display: block;
      margin: 0 auto;
    }

    /* Styles pour le footer */
    footer {
      background-color: #4CAF50;
      color: white;
      padding: 20px;
      margin-top: 20px;
      border-radius: 10px;
    }
  </style>
</head>

<body>

  <div id="content">

    <button onclick="openTab('accueil')" class="btn btn-primary">Accueil</button>
    <button onclick="openTab('tableauDeBord')" class="btn btn-primary">Tableau de Bord des Ventes</button>
    <button onclick="openTab('rapportJour')" class="btn btn-primary">Rapport Jour</button>

    <div id="accueil" class="tab-content">
      <img id="logo" src="nasora-logo.png" alt="Nasora Logo">
      <h2>NAS-DERM est une agence de promotion des produits Dermathologiques</h2>

      <!-- Section des partenaires -->
      <div class="container">
        <h2>Nos partenaires :</h2>
        <div class="carousel">
          <div class="partner">
            <a href="#"><img src="partner3.jpg" alt="Partenaire 3"></a>
          </div>
          <div class="partner">
            <a href="#"><img src="partner4.jpg" alt="Partenaire 4"></a>
          </div>
        </div>
      </div>
    </div>

    <div id="tableauDeBord" class="tab-content">
      <!-- Redirection vers la nouvelle page du tableau de bord des ventes -->
      <script>
        function openTab(tabName) {
          var tabs = document.getElementsByClassName("tab-content");
          for (var i = 0; i < tabs.length; i++) {
            tabs[i].style.display = "none";
          }
          if (tabName === 'tableauDeBord') {
            window.location.href = "tableau de bord nasderm.html"; // Redirigez vers la nouvelle page HTML du tableau de bord des ventes
          } else {
            document.getElementById(tabName).style.display = "block";
            if (tabName === 'tableauDeBord') {
              loadXLMSFile(); // Charger le fichier XLMS lorsque le bouton "Tableau de Bord des Ventes" est cliqué
            } else if (tabName === 'rapportJour') {
              loadReports();
            }
          }
        }
      </script>
    </div>

    <div id="rapportJour" class="tab-content">
      <h2>Rapport du Jour</h2>

      <form id="reportForm">
        <label for="reportDate">Date :</label>
        <input type="date" id="reportDate" name="reportDate" required><br>

        <label for="prospectName">Nom du Prospect :</label>
        <input type="text" id="prospectName" name="prospectName" required><br>

        <label for="phoneNumber">Numéro de Téléphone :</label>
        <input type="tel" id="phoneNumber" name="phoneNumber" required><br>

        <label for="speciality">Spécialité :</label>
        <input type="text" id="speciality" name="speciality"><br>

        <label for="site">Site du Prospect :</label>
        <input type="text" id="site" name="site"><br>

        <label for="comments">Commentaires :</label>
        <textarea id="comments" name="comments"></textarea><br>

        <button type="button" onclick="submitReport()" class="btn btn-success">Soumettre le Rapport</button>
      </form>

      <h3>Liste des Rapports</h3>
      <div id="reportsTable" class="table-responsive animate__animated animate__fadeIn">
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th>Date</th>
              <th>Nom du Prospect</th>
              <th>Numéro de Téléphone</th>
              <th>Spécialité</th>
              <th>Site du Prospect</th>
              <th>Commentaires</th>
            </tr>
          </thead>
          <tbody id="reportsList">
          </tbody>
        </table>
      </div>

      <button type="button" onclick="downloadProspects()" class="btn btn-primary">Télécharger les Prospects</button>

      <script>
        function loadReports() {
          // Code pour charger les rapports existants depuis le LocalStorage
          var existingReports = JSON.parse(localStorage.getItem('reports')) || [];
          var tableBody = document.getElementById("reportsList");

          // Ajouter chaque rapport existant au tableau
          existingReports.forEach(function(report) {
            addReportToTable(report, tableBody);
          });
        }

        function addReportToTable(report, tableBody) {
          var newRow = tableBody.insertRow();
          newRow.insertCell(0).innerHTML = report.date;
          newRow.insertCell(1).innerHTML = report.prospectName;
          newRow.insertCell(2).innerHTML = report.phoneNumber;
          newRow.insertCell(3).innerHTML = report.speciality;
          newRow.insertCell(4).innerHTML = report.site;
          newRow.insertCell(5).innerHTML = report.comments;
        }

        function submitReport() {
          var report = {
            date: document.getElementById("reportDate").value,
            prospectName: document.getElementById("prospectName").value,
            phoneNumber: document.getElementById("phoneNumber").value,
            speciality: document.getElementById("speciality").value,
            site: document.getElementById("site").value,
            comments: document.getElementById("comments").value
          };
          addReportToTable(report, document.getElementById("reportsList"));
          saveReportToLocalStorage(report);
          document.getElementById("reportForm").reset();
        }

        function saveReportToLocalStorage(report) {
          var existingReports = JSON.parse(localStorage.getItem('reports')) || [];
          existingReports.push(report);
          localStorage.setItem('reports', JSON.stringify(existingReports));
        }
      </script>
    </div>

  </div>

  <!-- Footer -->

    <p>&copy; 2024 NasoraGroupe. Tous droits réservés.</p>


</body>

</html>
