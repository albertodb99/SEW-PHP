"use strict";
class Traduccion {
   traducir(){
       var texto = $("#aTraducir").val();
       var idiomas = document.getElementById('idiomas');
    const settings = {
        "async": true,
        "crossDomain": true,
        "url": "https://google-translate1.p.rapidapi.com/language/translate/v2",
        "method": "POST",
        "headers": {
            "content-type": "application/x-www-form-urlencoded",
            "accept-encoding": "application/gzip",
            "x-rapidapi-key": "c2aaa95c2dmsh52abc0fdfd67793p19831fjsn458073774661",
            "x-rapidapi-host": "google-translate1.p.rapidapi.com"
        },
        "data": {
            "q": texto,
            "source": "es",
            "target": idiomas.value
        }
    };
    
    $.ajax(settings).done(function (response) {
        //var texto = $('translatedText', response.translations[0]);
        console.log(response.data.translations[0].translatedText);
        $("#traducido").val(response.data.translations[0].translatedText);
    });
   }

}
var traductor = new Traduccion();
