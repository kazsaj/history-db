#!/bin/bash

HISTORY_DB_FOLDER="/app/history-db";

function post_history { LAST_COMMAND=$(history 1 | sed -e 's/^ *[0-9]* *[0-9]*-[0-9]*-[0-9]* *[0-9]*:[0-9]*:[0-9]* *- *//g'); php $HISTORY_DB_FOLDER/php/add.php $LAST_COMMAND; history -a; }

function get_history { history -c; rm -f ~/.bash_history; php $HISTORY_DB_FOLDER/php/read.php > ~/.bash_history; history -r; }

PROMPT_COMMAND="post_history"