(function() {
    //start likes
    document.querySelectorAll('a.js-like').forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const url = this.href;
                const span = this.querySelector('span.js-liks');
                const icon = this.querySelector('i');
                axios.get(url).then(function(response) {
                    const likes = response.data.likes;
                    if (span != null) {
                        span.textContent = likes;
                    }
                    if (icon.classList.contains('fas')) {
                        icon.classList.replace('fas', 'far');
                    } else {
                        icon.classList.replace('far', 'fas');
                    }
                }).catch(function(error) {
                    console.log(error);
                    if (error.response.status == 403) {
                        swal({
                            title: "Opsss!",
                            text: "vous devez etre connecte!",
                            icon: "warning",
                            button: "Ok!",
                        });
                    } else {

                    }
                })


            })
        })
        //end 


})();