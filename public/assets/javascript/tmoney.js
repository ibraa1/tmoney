$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});


$('#paysId').on('change', function() {
  var selectedValue = $(this).val();
  getVillesByPays(selectedValue);
});



function getVillesByPays(paysId) {
  if (paysId != "") {
    $.post("/villesByPays", { paysId: paysId }, function (response) {
      // Clear the existing options
      $('#ville').empty();
      // Add the new options based on the response
      $.each(response, function (index, ville) {
        $('#ville').append($('<option>', {
          value: ville.id,
          text: ville.nom
        }));
      });
      //Refresh the selectpicker
      $('#ville').selectpicker('refresh');
    });
  }
}


$(document).ready(function() {
        // Écoute l'événement de soumission du formulaire
        $('#clientNewForm').on('submit', function(e) {
            e.preventDefault(); // Empêche la soumission du formulaire par défaut

            $('#submitBtn').prop('disabled', true);
            $('#btnText').text('');
            $('.spinner-border').removeClass('d-none');

            // Affiche le loader pendant l'opération
            var loader = $('<div class="loader"></div>');
            $('#clientNewModal').append(loader);

            // Récupère les données du formulaire
            var formData = $(this).serialize();
            // Récupère l'URL de l'action du formulaire
            var actionUrl = $(this).data('action');

            // Effectue une requête AJAX pour enregistrer le client
            $.ajax({
                type: 'POST',
                url: "/addClient",
                data: formData,
                success: function(response) {
                    console.log(response);
                    // Ajoute le nouvel élément client à la liste des utilisateurs
                    var userList = $('.userList');
                    var newClient = response;
                    var newClientHtml = `
                        <div class="list-group-item" data-toggle="sidebar" data-sidebar="show" data-id="${newClient.id}">
                            <a href="#" class="stretched-link"></a>
                            <div class="list-group-item-figure">
                                <div class="tile tile-circle bg-indigo">
                                    ${newClient.nom.charAt(0)}
                                </div>
                            </div>
                            <div class="list-group-item-body">
                                <h4 class="list-group-item-title">${newClient.prenom} ${newClient.nom}</h4>
                                <p class="list-group-item-text">${newClient.ville.nom}, ${newClient.pays.nom}</p>
                            </div>
                        </div>
                    `;
                    userList.append(newClientHtml);

                    // Ferme la fenêtre modale
                    $('#clientNewModal').modal('hide');

                    // Supprime le loader après l'opération
                     $('#submitBtn').prop('disabled', false);
                        $('#btnText').text('Save');
                        $('.spinner-border').addClass('d-none');
                },
                error: function(xhr, status, error) {
                    // Gestion des erreurs
                    console.error(error);
                    alert('Quelque chose s\'est mal passé, verifiez le formulaire et réessayez.');

                    // Supprime le loader en cas d'erreur
                     $('#submitBtn').prop('disabled', false);
                    $('#btnText').text('Sauvegarder');
                    $('.spinner-border').addClass('d-none');
                }
            });
        });
});

$(document).ready(function() {
  var clientId = '';
  var receveurId = '';

  // Fonction appelée lorsque l'utilisateur clique sur un nom
  $('.list-group-item').click(function() {
    var nameId = $(this).attr('data-id');

    if ($(this).attr('id') === '1') {
      clientId = nameId;
      $('#clientId').val(clientId);
    } else if ($(this).attr('id') === '2') {
      receveurId = nameId;
      $('#receveurId').val(receveurId);
    }
  });

  // Reste du code de votre application...
});

$(document).ready(function() {
        // Écoute l'événement de soumission du formulaire
        $('#suivant').on('click', function() {
            // Effectue une requête AJAX pour enregistrer le client
            $.ajax({
                type: 'POST',
                url: "/getReceiverPays",
                data: {receveurId: $('#receveurId').val()},
                success: function(response) {
                    var paysReceiveur = response.pays.nom
                    var deviseEntree = trouverDevise(userPays);
                    var deviseSortie = trouverDevise(paysReceiveur);
                    $.ajax({
                    type: 'POST',
                    url: "/getDevises",
                    success: function(devises) {
                         // Remplir le select avec les devises
                        var select = $('#devise');
                        select.empty(); // Effacer les options existantes

                        // Ajouter une option pour chaque devise
                        devises.forEach(function(devise) {
                            var option = $('<option></option>').attr('value', devise.id).text(devise.deviseEntree + ' vers ' + devise.deviseSortie);
                             if (devise.deviseEntree === deviseEntree && devise.deviseSortie === deviseSortie) {
                                    option.attr('selected', 'selected');
                            }
                            select.append(option);
                        });

                        // Rafraîchir le selectpicker après avoir ajouté les options
                        select.selectpicker('refresh');
                        console.log("Liste des devises:", devises);
                    },
                    error: function(xhr, status, error) {
                        // Gestion des erreurs
                        console.error(error);
                        alert("Quelque chose s'est mal passé lors de la récupération des devises.");
                    }
                });
                },
                error: function(xhr, status, error) {
                    // Gestion des erreurs
                    console.error(error);
                    alert('Quelque chose s\'est mal passé, verifiez le formulaire et réessayez.');

                }
            });
        });
});

function trouverDevise(pays) {
  var devise = "XOF";

  switch (pays) {
    case "Guinée":
      devise = "GNF";
      break;
    case "Sénégal":
      devise = "XOF";
      break;
    case "France":
      devise = "EURO";
      break;
    case "États-Unis":
      devise = "USD";
      break;
    default:
      devise = "XOF";
  }

  return devise;
}

$(document).ready(function() {
function updateMontantDefinitif() {
  // Récupérer les valeurs du montant et de la remise
  var montant = parseFloat($('#montant').val());
  var remise = parseFloat($('#remise').val());
    if (isNaN(montant)) {
    montant = 0; // Définir le montant à 0 si NaN
  }

  // Vérifier si le type de remise est un pourcentage
  var typeRemise = $('#typeRemise').val();
  if (typeRemise === 'pourcentage') {
    // Calculer le montant définitif en appliquant la remise en pourcentage
    if (!isNaN(remise)) {
      // Calculer le montant définitif en appliquant la remise en pourcentage
      var montantDefinitif = montant - (montant * remise / 100);
    }

  } else if (typeRemise === 'valeur') {
    // Calculer le montant définitif en soustrayant la valeur de la remise
    if (!isNaN(remise)) {
      // Calculer le montant définitif en soustrayant la valeur de la remise
      var montantDefinitif = montant - remise;
    }

  } else {
    // Pas de remise, le montant définitif reste le même que le montant saisi
    var montantDefinitif = montant;
  }

  // Mettre à jour la valeur du champ "montant définitif"
  $('#montantDef').val(montantDefinitif.toFixed(2));
}


// Écouter les événements de changement pour les champs montant et remise
$('#montant').on('change', updateMontantDefinitif);
$('#remise').on('change', updateMontantDefinitif);
$('#typeRemise').on('change', updateMontantDefinitif);

// Appeler la fonction initiale pour mettre à jour le montant définitif au chargement de la page
updateMontantDefinitif();
});

$(document).ready(function() {
        // Écoute l'événement de soumission du formulaire
        $('#submitButton').on('click', function(e) {
            e.preventDefault(); // Empêche la soumission du formulaire par défaut

            $('#submitButton').prop('disabled', true);
            $('#btnText').text('');
            $('.spinner-border').removeClass('d-none');




            // Récupère les données du formulaire
            var code =  $('#code').val();
            // Récupère l'URL de l'action du formulaire
            var actionUrl = $(this).data('action');

            // Effectue une requête AJAX pour enregistrer le client
            $.ajax({
                type: 'POST',
                url: "/searchByCode",
                data: {code : code},
                success: function(response) {
                    console.log(response);
                     if (response == null || Object.keys(response).length === 0) {
                        alert('Le code a déja été utiliser, veuillez verifier.');
                         $('#submitButton').prop('disabled', false);
                        $('#btnTexte').text('Rechercher');
                        $('.spinner-border').addClass('d-none');
                    } else {
                                            // Récupère le montant de la transaction
                    var montantTransaction = parseFloat(response.montant);

                    // Récupère le taux de change (courDevise) de la devise
                    var tauxDeChange = parseFloat(response.devise.courDevise);

                    // Calcule le montant converti
                    var montantConverti = montantTransaction * tauxDeChange;

                    $('#montant').val(montantConverti.toFixed(2));
                    $('#transacId').val(response.id);

                    // Remplit les <select> avec les options appropriées
                    $('#paysId').html('<option value="' + response.paysId + '">' + response.pays.nom + '</option>');
                    $('#devise').html('<option value="' + response.deviseId + '">' + response.devise.deviseSortie + '</option>');
                    $('#clientId').html('<option value="' + response.clientId + '">' + response.client.prenom + " " + response.client.nom + '</option>');
                    $('#receveurId').html('<option value="' + response.receveurId + '">' + response.receveur.prenom + " " + response.client.nom + '</option>');
                    // Supprime le loader après l'opération
                     $('#submitButton').prop('disabled', false);
                        $('#btnTexte').text('Rechercher');
                        $('.spinner-border').addClass('d-none');
                    }

                },
                error: function(xhr, status, error) {
                    // Gestion des erreurs
                    console.error(error);
                    alert('Quelque chose s\'est mal passé, verifiez le formulaire et réessayez.');

                    // Supprime le loader en cas d'erreur
                     $('#submitButton').prop('disabled', false);
                    $('#btnTexte').text('Sauvegarder');
                    $('.spinner-border').addClass('d-none');
                }
            });
        });
});
$('#submitButton2').on('click', function() {
  $('#stepper-form').submit();
});

$('#deviseCalcul').on('click', function(e) {
     e.preventDefault();
  var montant = $('#montant').val();
  var devise = $('#devise').val();
  getMontantConverti(montant, devise);
});
function getMontantConverti(montant, devise) {
  if (montant != "" && devise != "" ) {
    $.post("/calculette", { montant: montant, devise: devise },
    function (response) {
        alert("Ça vous fait : " + response)
    });
  }
}

$(document).ready(function() {
    $('#isChecked').change(function() {
        if ($(this).is(':checked')) {
            $('#commission').prop('disabled', false);
        } else {
            $('#commission').prop('disabled', true);
        }
    });
});
$(document).ready(function() {
    $('#montant, #devise').change(function() {
        var montant = $('#montant').val();
        var devise = $('#devise').val();
        getCommission(montant, devise);
    });
});

$(document).ready(function() {
    $('#reload').click(function() {
    $.get("/reload-captcha",
    function (response) {
        $(".captcha span").html(response.captcha);
    });
    });
});
function getCommission(montant, devise) {
  if (montant != "" && devise != "" ) {
    $.post("/commission", { montant: montant, devise: devise },
    function (response) {
        $('#commission').val(response);
    });
  }
}





function sendAlert() {
    alert("Not yet implemented");
}

