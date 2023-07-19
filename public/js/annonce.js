console.log('coucou');
// Fonction pour préremplir le sujet du formulaire de contact
function prefillContactFormSubject() {
  var subjectField = document.getElementById('idCar');
  var carName = "{{ carName }}"; // Récupérer la valeur de la variable carName
  if (subjectField && carName) {
  subjectField.value = 'Demande d\'information concernant l\'annonce ' + carName;
  }
  }
  
  // Appeler la fonction pour préremplir le sujet une fois que la page est chargée
  window.onload = prefillContactFormSubject;