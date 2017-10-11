#!/bin/sh

#Auth:aqie
servername="192.168.144.128:94"
download_file="/download/1.jpg"
time_num=$(date -d "2018-10-18 00:00:00" +%s)
secret_num="salt"

res=$(echo -n "${time_num}${download_file} ${secret_num}"|openssl md5 -binary | 
openssl base64 | tr +/ -_ | tr -d =)

echo "http://${servername}${download_file}?md5=${res}&expires=${time_num}"
