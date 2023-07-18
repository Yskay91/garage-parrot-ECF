$(document).ready(function () {
  $('.modal').modal();
  $('.modal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Bouton qui déclenche la modal
    var sujet = button.data('whatever'); // Extraire les informations des attributs data-*
    var modal = $(this);
    modal.find('.modal-title').text(sujet);
    modal.find('.modal-body input').val('Demande d\'information concernant l\'annonce ' + sujet);
  });
});
