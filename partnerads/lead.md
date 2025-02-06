# On all your forms where you want to track leads. Make a field with the ID pasessid and set the field to hidden. This is needed to track the individual lead if needed.

	<input type="hidden" name="pahiddenformfield" id="pasessid" value="">

# Place this on the landing page

	<script type="text/javascript">
	var programid = XXXX;
	var paid = getCookie("paid");
	var pacid = getCookie("pacid");
	var pasessid = getCookie("pasessid");

	  console.log("paid cookie for partnerads:" + paid);
	document.body.innerHTML += '<img src="https://www.partner-ads.com/dk/leadtracks2s.php?programid='+programid+'&type=lead&partnerid='+paid+'&pacid='+pacid+'&uiv='+pasessid+'" width="0" height="0">';

	</script>

# Place this  in the <head> of the site
	<script type="text/javascript">
		// Shorthand for $( document ).ready()


		 window.addEventListener('DOMContentLoaded', function(){

				var randomnumber = makeid(8);

				jQuery("#form-field-pasessid").val( randomnumber );
				 eraseCookie("pasessid");
				createCookie("pasessid", randomnumber, 40);
				console.log("Gave the field a pasessid value.");

	     });

	function makeid(length) {
	    var result           = '';
	    var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
	    var charactersLength = characters.length;
	    for ( var i = 0; i < length; i++ ) {
	      result += characters.charAt(Math.floor(Math.random() * 
	 charactersLength));
	   }
	   return result;
	}
		function eraseCookie(name) {   
	    document.cookie = name+'=; Max-Age=-99999999;';  
	}
	function getCookie(name) {
	    var nameEQ = name + "=";
	    var ca = document.cookie.split(';');
	    for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	    }
	    return null;
	}

	function createCookie(name, value, days) {
	    var date, expires;
	    if (days) {
		date = new Date();
		date.setDate(date.getDate()+days);
		expires = "; expires="+date.toUTCString();
	    } else {
		expires = "";
	    }
	    document.cookie = name+"="+value+expires+"; path=/";
	}

		function findGetParameter(parameterName) {
	    var result = null,
		tmp = [];
	    location.search
		.substr(1)
		.split("&")
		.forEach(function (item) {
		  tmp = item.split("=");
		  if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
		});
	    return result;
	}

		var paid = findGetParameter("paid");
		var pacid = findGetParameter("pacid");
		console.log(paid);
		if(paid != null && pacid != null) {

			console.log("Setting the paid and pacid cookie values.");
				// We are ready to save cookie.
				createCookie("paid", paid, 40);
				createCookie("pacid", pacid, 40);


		}


		//pasessid
	</script>

//Alternative version
<script type="text/javascript">
        var programid = XXXXXXXX;
        var paid = getCookie("paid");
        var pacid = getCookie("pacid");
        var pasessid = getCookie("pasessid");

        console.log("paid cookie for partnerads:" + paid);

        for (var i = 0; i < orderItems.length; i++) {
            var item = orderItems[i];
            var trackingPixelUrl = 'https://www.partner-ads.com/dk/leadtracks2s.php?programid=' + programid +
                '&type=salg&uiv=' + pasessid + '&partnerid=' + paid + '&pacid=' + pacid +
                '&ordreid=' + item.ORDRENUMMER + '&varenummer=' + item.VARENUMMER +
                '&altsats=' + item.SATSGRUPPE + '&antal=' + item.ANTAL + '&omprsalg=' + item.SALGSPRIS;

            document.body.innerHTML += '<img decoding="async" src="' + trackingPixelUrl + '" width="0" height="0">';
        }
    </script>
