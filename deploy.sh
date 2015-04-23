#!/bin/bash
set -e

git config user.name "Cogax"
git config user.email "andygyr@gmx.ch"
git config --global url."https://".insteadOf git://

git status
git branch -v
git checkout -b prod
git status
git branch
git push -u origin prod
