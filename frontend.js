// frontend.js

document.addEventListener('DOMContentLoaded', function () {
  openTab('accueil');

  document.getElementById('accueil-tab').addEventListener('click', function () {
    openTab('accueil');
  });

  document.getElementById('tableauDeBord-tab').addEventListener('click', function () {
    openTab('tableauDeBord');
    // Appeler une fonction pour charger le tableau de bord des ventes depuis le backend
    loadSalesDashboard();
  });

  document.getElementById('rapportJour-tab').addEventListener('click', function () {
    openTab('rapportJour');
    // Charger les rapports des commerciaux
    loadReports();
  });

  document.getElementById('submitReportBtn').addEventListener('click', function () {
    submitReport();
  });
});

function openTab(tabName) {
  var tabs = document.getElementsByClassName("tab-content");
  for (var i = 0; i < tabs.length; i++) {
    tabs[i].style.display = "none";
  }

  document.getElementById(tabName).style.display = "block";

  if (tabName === 'tableauDeBord') {
    // À compléter avec la logique backend pour le tableau de bord des ventes
  } else if (tabName === 'rapportJour') {
    loadReports();
  }
}

function loadSalesDashboard() {
  // Appeler une API backend pour récupérer les données du tableau de bord des ventes
  fetch("http://localhost:3000/api/sales-dashboard")
    .then(response => response.json())
    .then(data => {
      // Manipuler les données pour afficher le tableau de bord des ventes
      displaySalesDashboard(data);
    })
    .catch(error => console.error("Error fetching sales dashboard:", error));
}

function displaySalesDashboard(data) {
  // À compléter avec la logique pour afficher les données du tableau de bord des ventes
  console.log("Sales dashboard data:", data);
}

// Reste du code frontend
// ...


document.addEventListener('DOMContentLoaded', function () {
  openTab('accueil');

  document.getElementById('accueil-tab').addEventListener('click', function () {
    openTab('accueil');
  });

  document.getElementById('tableauDeBord-tab').addEventListener('click', function () {
    openTab('tableauDeBord');
  });

  document.getElementById('rapportJour-tab').addEventListener('click', function () {
    openTab('rapportJour');
    loadReports();
  });

  document.getElementById('submitReportBtn').addEventListener('click', function () {
    submitReport();
  });
});

function openTab(tabName) {
  var tabs = document.getElementsByClassName("tab-content");
  for (var i = 0; i < tabs.length; i++) {
    tabs[i].style.display = "none";
  }

  document.getElementById(tabName).style.display = "block";

  if (tabName === 'tableauDeBord') {
    // À compléter avec la logique backend pour le tableau de bord
  } else if (tabName === 'rapportJour') {
    loadReports();
  }
}

function loadReports() {
  var reportsList = document.getElementById("reportsList");

  fetch("http://localhost:3000/api/reports")
    .then(response => response.json())
    .then(data => {
      reportsList.innerHTML = "";

      data.forEach(report => {
        addReportToTable(report, reportsList);
      });
    })
    .catch(error => console.error("Error fetching reports:", error));
}

function addReportToTable(report, tableBody) {
  var newRow = tableBody.insertRow();
  newRow.insertCell(0).innerHTML = report.date;
  newRow.insertCell(1).innerHTML = report.prospectName;
  newRow.insertCell(2).innerHTML = report.speciality;
  newRow.insertCell(3).innerHTML = report.site;
  newRow.insertCell(4).innerHTML = report.comments;
}

function submitReport() {
  var reportDate = document.getElementById("reportDate").value;
  var prospectName = document.getElementById("prospectName").value;
  var speciality = document.getElementById("speciality").value;
  var site = document.getElementById("site").value;
  var comments = document.getElementById("comments").value;

  if (!reportDate || !prospectName) {
    alert('Veuillez remplir la date et le nom du prospect.');
    return;
  }

  var formData = {
    date: reportDate,
    prospectName: prospectName,
    speciality: speciality,
    site: site,
    comments: comments
  };

  fetch("http://localhost:3000/api/reports", {
    method: "POST",
    headers: {
      "Content-Type": "application/json"
    },
    body: JSON.stringify(formData)
  })
  .then(response => response.json())
  .then(data => {
    console.log("Report submitted successfully:", data);
    document.getElementById("reportForm").reset();
    loadReports();
  })
  .catch(error => {
    console.error("Error submitting report:", error);
    // Gérez les erreurs ici
  });
}
