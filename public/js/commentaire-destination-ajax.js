// (function () {
//     document.querySelector('.AjaxForm').addEventListener('submit', function (e) {
//     e.preventDefault();
//     var formD = new FormData()
//     formD.append('comentaire', $('#comentaire').val());
//     formD.append('ville', $('#ville').val());
//     formD.append('file', document.getElementById('customFile').files[0]);
//     var contentType = {
//     headers: {
//     "content-type": "multipart/form-data"
//     }
//     };
//     axios.post($(".AjaxForm").attr('action'), formD, contentType).then(function (response) {
//     const $error = response.data.error;
//     const newFilename = response.data.newFilename;
//     if ($error == "empty" && newFilename == "empty") {
//     $('#error').hide();
//     $('#comentaires').append('<div id="error"class="alert alert-danger" role="alert"><strong>il faut remplir au moin un champ !!</strong>');
//     } else {
//     const comentaire = response.data.comentaire;
//     const nom = response.data.nom;
//     const prenom = response.data.prenom;
//     $('#comentaires').append("<h4>" + nom + " " + prenom + "</h4>");
//     if ($error != "empty") {
//     $('#comentaires').append("<p>" + comentaire + "</h>");
//     $('#comentaire').val("");
//     }
//     if (newFilename != "empty") {
//     const assetsBaseDir = "{{ asset('img/comentaire/') }}";
//     $('#comentaires').append('<div class="container"><img style="height:200px; width:200px ;" src="' + assetsBaseDir + newFilename + '"></div>');
//     }
//     $('#comentaires').append('<div id="border" class="bordered_1px"></div>');
//     $('#error').hide();
//     }
//     }).catch(function (error) {
//     console.log(error);
//     });
//     });
//     })();