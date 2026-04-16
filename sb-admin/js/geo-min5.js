
        if(geo_position_js.init()){
            geo_position_js.getCurrentPosition(success_callback,error_callback,{enableHighAccuracy:true});
        }
        else{ 
            div_isi=document.getElementById("div_isi5");
            div_isi.innerHTML ="Tidak ada fungsi geolocation";
        }

        function success_callback(p)
        {
            latitude=p.coords.latitude ;
            longitude=p.coords.longitude;
            pesan=''+latitude+','+longitude;
          //  pesan = pesan + "<br/>";
            pesan = "<br/>"+ '<iframe src="https://maps.google.com/maps?q='+latitude +','+longitude+'&t=&z=17&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="yes" marginheight="0" width="100%" height="300" marginwidth="0"/> + </iframe>';
           
            
            
            div_isi=document.getElementById("div_isi5");
            //alert(pesan);
            div_isi.innerHTML =pesan;

        }
        
        function error_callback(p)
        {
            div_isi=document.getElementById("div_isi5");
            div_isi.innerHTML ='error='+p.message;
        }        