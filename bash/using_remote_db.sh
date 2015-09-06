#!/bin/bash

function post_history { LAST_COMMAND=$(history 1 | sed -e 's/^ *[0-9]* *[0-9]*-[0-9]*-[0-9]* *[0-9]*:[0-9]*:[0-9]* *- *//g'); curl -d hostname="$HOSTNAME" -d command="$LAST_COMMAND" http://yourserver.example.tld/history/; history -a; }

function get_history {  echo -n "enter password: "; read -s HISTPASS; history -c; rm ~/.bash_history; curl -s http://yourserver.example.tld/history/download.php?passwd=$HISTPASS > ~/.bash_history; history -r; }

PROMPT_COMMAND="post_history"