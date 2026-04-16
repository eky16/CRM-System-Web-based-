
        if(geo_position_js.init()){
            geo_position_js.getCurrentPosition(success_callback,error_callback,{enableHighAccuracy:true});
        }
        else{
            div_isi2=document.getElementById("div_isi2");
            div_isi2.innerHTML ="Tidak ada fungsi geolocation";
        }

        function success_callback(p)
        {
            latitude=p.coords.latitude ;
            longitude=p.coords.longitude;
            pesan=''+latitude+','+longitude;
            pesan = pesan + "";
           
            
            
            div_isi2=document.getElementById("div_isi2");
            //alert(pesan);
            div_isi2.innerHTML =pesan;

        }
        
        function error_callback(p)
        {
            div_isi2=document.getElementById("div_isi2");
            div_isi2.innerHTML ='error='+p.message;
        }        