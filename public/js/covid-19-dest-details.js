fetch('https://services3.arcgis.com/hjUMsSJ87zgoicvl/arcgis/rest/services/Covid_19/FeatureServer/0/query?where=RegionFr%20%3D%20%27' + region + '%27&outFields=*&returnGeometry=false&outSR=4326&f=json').then(response => response.json()).then(data => {
    document.getElementById('title').innerHTML = "L'état sanitaire dans la région de " + data.features[0].attributes.Nom_Région_FR + ' ' + data.features[0].attributes.Nom_Région_AR;

    document.getElementById('total-cases').innerHTML = data.features[0].attributes.Cases;
    document.getElementById('deaths').innerHTML = data.features[0].attributes.Deaths;
    document.getElementById('recovered').innerHTML = data.features[0].attributes.Recoveries;
    document.getElementById('new-cases').innerHTML = 0;
});