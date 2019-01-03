#!/usr/bin/env bash

set +e
set -x

function start_process () {
  CMD=$1

  $CMD &
  status=$?
  if [ $status -ne 0 ]; then
    echo "Failed to start $CMD: $status"
    exit $status
  fi
}

function check_process_running () {
  PROCESS=$1

  ps aux |grep "$PROCESS" |grep -q -v grep
  PROCESS_STATUS=$?

  # If the greps above find anything, they exit with 0 status
  # If they are not both 0, then something is wrong
  if [[ $PROCESS_STATUS -ne 0  ]]; then
    echo "Processes ${PROCESS} has exited."
    exit 1
  fi

  echo "Still alive"
}


COMMANDS=()

COMMANDS+=("/usr/sbin/php-fpm7.2 \
  --nodaemonize \
  --fpm-config=/var/www/docker/server/config/php/fpm.conf \
  -c /var/www/docker/server/config/php/php.ini")

COMMANDS+=("/usr/sbin/nginx -c /var/www/docker/server/config/nginx/nginx.conf")


PROCESSES=()
PROCESSES+=("nginx: master")
PROCESSES+=("php-fpm: master")

for COMMAND in "${COMMANDS[@]}"
do
  start_process "$COMMAND"
done

# Naive check runs checks once a minute to see if either of the processes exited.
# This illustrates part of the heavy lifting you need to do if you want to run
# more than one service in a container. The container exits with an error
# if it detects that either of the processes has exited.
# Otherwise it loops forever, waking up every 60 seconds
while sleep 2; do
  for PROCESS in "${PROCESSES[@]}"
  do
    check_process_running "$PROCESS"
  done
done