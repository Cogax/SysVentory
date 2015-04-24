#!/bin/bash
set -e

git config user.name "Cogax"
git config user.email "andygyr@gmx.ch"
git config --global url."https://".insteadOf git://

git checkout -b prod
git branch
git push --force --quiet "https://${GH_TOKEN}@github.com/Cogax/SysVentoryServer.git" prod:prod > /dev/null 2>&1
