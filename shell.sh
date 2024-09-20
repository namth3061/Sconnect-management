#!/bin/sh

dirHosts="/etc/hosts"
domain="$1"
env="$2"
dns="${3:-8.8.8.8}"
reload=false
result=$(cat "${dirHosts}" | grep "${domain}")
localIp='127.0.0.1'
serverIp=$(ip -o route get to "${dns}" | sed -n 's/.*src \([0-9.]\+\).*/\1/p')
ip=""

if [ "${result}" = "" ]
then
    if [ "${env}" = "production" ]
    then
        ip="${serverIp}"
    else
        ip="${localIp}"
    fi

    $(echo "${ip}	${domain}" >> "${dirHosts}")
    echo "Add success domain ${domain} to ${dirHosts}"
    reload=true
else
    echo "${domain} is exist in ${dirHosts}"
fi

if [ "${reload}" = true ]
then
    $(systemctl reload apache2)
fi
