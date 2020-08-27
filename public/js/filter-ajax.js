 (function() {


     //start filer ville

     document.querySelector('.chatAjaxForm').addEventListener('submit', function(e) {
         e.preventDefault();

         axios.post($(".chatAjaxForm").attr('action'), { idResion: $('#region').val() })
             .then(function(response) {
                 const villes = response.data.villes;
                 const newName = [];
                 for (var i = 0; i < villes.length; i++) {
                     newName.push(villes[i]["name"]);
                 }
                 for (var i = 0; i < nameVilles.length; i++) {
                     if (nameVilles.includes(nameVilles[i]) && newName.includes(nameVilles[i])) {
                         $('#' + nameVilles[i]).show();
                         console.log("show " + nameVilles[i]);
                     } else {
                         $('#' + nameVilles[i]).hide();
                         console.log("hide " + nameVilles[i]);
                     }
                 }

             }).catch(function(error) {
                 console.log(error);
             });

     });
     //end

 })();