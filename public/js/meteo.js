	fetch('https://api.openweathermap.org/data/2.5/onecall?lat=' + lat + '&lon=' + lng + '&units=metric&appid=7215d0713dbd93f757a51b198da702cc').then(response => response.json()).then(data => {
	    document.getElementById("temp").innerHTML = data.current.temp + '&deg;';
	    document.getElementById("sky").innerHTML = '<img src=../img/weather/' + data.daily[0].weather[0].icon + '.png' + '>';
	    document.getElementById("desc").innerHTML = data.current.weather[0].description + '<span  id="wind" style="margin-left: 24px; color: #999; font-weight: 300;">Vent ' + data.current.wind_speed + 'm/s <span style="margin-left: 0;" class="dot">•</span> humidité ' + data.current.humidity + '%</span>';
	    var date0 = new Date();
	    let dateLocale0 = date0.toLocaleString('fr-FR', {
	        weekday: 'long',
	        year: 'numeric',
	        month: 'long',
	        day: 'numeric'
	    });
	    document.getElementById("day0").innerHTML = dateLocale0;
	    for (var i = 1; i < 6; i++) {
	        document.getElementById("tempMaxd" + i).innerHTML = data.daily[i].temp.max + '&deg;';
	        document.getElementById("icond" + i).innerHTML = '<img style="width: 65px" src=../img/weather/' + data.daily[i].weather[0].icon + '.png' + '>';
	        document.getElementById("tempMind" + i).innerHTML = data.daily[i].temp.min + '&deg;';
	        var date = new Date();
	        date.setDate(new Date().getDate() + i);
	        let dateLocale = date.toLocaleString('fr-FR', {
	            weekday: 'long',
	            year: 'numeric',
	            month: 'long',
	            day: 'numeric'
	        });
	        document.getElementById("day" + i).innerHTML = dateLocale.substr(0, 3).toUpperCase();
	    }
	});
