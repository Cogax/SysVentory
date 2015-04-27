# SysVentoryServer
[![Build Status](https://travis-ci.org/Cogax/SysVentoryServer.svg?branch=master)](https://travis-ci.org/Cogax/SysVentoryServer)

## Branches
* `master` is the development branch which isn't always sable
* `prod` is the productive branch, which always should be stable

### Continuous Integration
https://travis-ci.org/Cogax/SysVentoryServer
* Builds only `master` branch
* If `master` build success it will push to `prod` branch

## Installation

### Development:
1. `git clone`
2. `cd SysVentoryServer`
3. `composer install`
4. For a lightweight local webserver: `php app/console server:run`
