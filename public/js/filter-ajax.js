 (function() {
     //start filer ville
     document.querySelector('.chatAjaxForm').addEventListener('submit', function(e) {
         e.preventDefault();
         var formData = new FormData();
         formData.append('id', $('#region').val());
         axios.post($(".chatAjaxForm").attr('action'), formData)
             .then(function(response) {
                 const newName = response.data.villes;
                 for (var i = 0; i < nameVilles.length; i++) {
                     if (nameVilles.includes(nameVilles[i]) && newName.includes(nameVilles[i])) {
                         $('#' + nameVilles[i]).show();
                     } else {
                         $('#' + nameVilles[i]).hide();
                     }
                 }

             }).catch(function(error) {
                 console.log(error);
             });

     });
     //end

 })();