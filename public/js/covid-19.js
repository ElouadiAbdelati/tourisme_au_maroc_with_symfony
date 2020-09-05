fetch('https://services3.arcgis.com/hjUMsSJ87zgoicvl/arcgis/rest/services/Covid_19/FeatureServer/5/query?where=1%3D1&outFields=*&returnGeometry=false&outSR=4326&f=json').then(response => response.json()).then(data => {
	let index = data.features.length - 1;

	var date = new Date(data.features[index].attributes.Date);
	let dateLocale = date.toLocaleString('fr-FR', {
		weekday: 'long',
		year: 'numeric',
		month: 'long',
		day: 'numeric'
	});
	document.getElementById('title').innerHTML = "L'état sanitaire du Maroc le " + dateLocale;
	document.getElementById('total-cases').innerHTML = data.features[index].attributes.Cas_confirmés;
	document.getElementById('deaths').innerHTML = data.features[index].attributes.Décédés;
	if (data.features[index].attributes.Retablis != null)
		document.getElementById('recovered').innerHTML = data.features[index].attributes.Retablis;
	else
		document.getElementById('recovered').innerHTML = 0;
	document.getElementById('new-cases').innerHTML = data.features[index].attributes.Cas_Jour;
	document.getElementById('new-recovered').innerHTML = data.features[index].attributes.Rtabalis_jour;
	document.getElementById('new-death').innerHTML = data.features[index].attributes.Deces_jour;
});