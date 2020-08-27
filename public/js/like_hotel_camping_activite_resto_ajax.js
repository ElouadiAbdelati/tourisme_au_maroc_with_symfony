(function() {
    //start likes hotel
    document.querySelectorAll('a.js-like-hotel').forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const url = this.href;
                const span = this.querySelector('span.js-liks-hotel');
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
        //start likes resto
    document.querySelectorAll('a.js-like-resto').forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const url = this.href;
                const span = this.querySelector('span.js-liks-resto');
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

    //start likes camping
    document.querySelectorAll('a.js-like-camping').forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const url = this.href;
                const span = this.querySelector('span.js-liks-camping');
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

    //start likes activite
    document.querySelectorAll('a.js-like-activite').forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const url = this.href;
                const span = this.querySelector('span.js-liks-activite');
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