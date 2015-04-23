#!/bin/bash
set -e

git config user.name "Cogax"
git config user.email "andygyr@gmx.ch"

git fetch origin
git checkout prod
git merge master
git push origin prod
