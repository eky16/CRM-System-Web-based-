
        if(geo_position_js.init()){
            geo_position_js.getCurrentPosition(success_callback,error_callback,{enableHighAccuracy:true});
        }
        else{ 
            div_isi=document.getElementById("div_isi4");
            div_isi.innerHTML ="Tidak ada fungsi geolocation";
        }

        function success_callback(p)
        {
            latitude=p.coords.latitude ;
            longitude=p.coords.longitude;
            pesan=''+latitude+','+longitude;
            pesan = pesan + "";
           
            
            
            div_isi=document.getElementById("div_isi4");
            //alert(pesan);
            div_isi.innerHTML =pesan;

        }
        
        function error_callback(p)
        {
            div_isi=document.getElementById("div_isi4");
            div_isi.innerHTML ='error='+p.message;
        }        