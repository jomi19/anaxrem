  
#!/usr/bin/env bash
#
# jomi19/anaxrem
#
# Integrate the REM server onto an existing anax installation.
#

# Copy the configuration files
rsync -av vendor/jomi19/anaxrem/config ./
# Copy the src files
rsync -av vendor/jomi19/anaxrem/src ./
# Copy the view files
rsync -av vendor/jomi19/anaxrem/view ./

rsync -av vendor/jomi19/anaxrem/test ./

# Copy the documentation
#rsync -av vendor/anax/remserver/content/read.md ./content/remserver-api.md