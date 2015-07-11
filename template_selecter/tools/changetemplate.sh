#!/bin/bash
################################
# Author: Rum Coke
# Data  : 2015/05/29
# Ver   : 0.1.0
################################
# Common Setting.
MUNIN_PATH="/etc/munin"
STATIC_FILES="/etc/munin/static_files"
TEMP_NAME=( `ls ${STATIC_FILES} | cut -d '_' -f 2 ` )

# Args check.
if [ $# == 0 ]
then
	exit 
fi

# Create Synbolic Links.
for (( I = 0; I < ${#TEMP_NAME[@]}; ++I ))
do
	if [ ${TEMP_NAME[$I]} == $1 ]
	then
		ln -nfs ${MUNIN_PATH}/static_files/static_${TEMP_NAME[$I]} ${MUNIN_PATH}/static
		ln -nfs ${MUNIN_PATH}/templates_files/templates_${TEMP_NAME[$I]} ${MUNIN_PATH}/templates
		echo Change for ${TEMP_NAME[$I]}.
		exit
	fi
done

