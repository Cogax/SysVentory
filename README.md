# SysVentoryServer
[![Build Status](https://travis-ci.org/Cogax/SysVentoryServer.svg?branch=master)](https://travis-ci.org/Cogax/SysVentoryServer)

## Documentation
There is a [project documentation](https://github.com/Cogax/SysVentoryServer/blob/master/doc/Dokumentation.pdf) written in german.

## Continuous Integration
https://travis-ci.org/Cogax/SysVentoryServer
* Builds only `master` branch
* If `master` build success it will push to `prod` branch

### Branches
* `master` is the development branch which isn't always sable
* `prod` is the productive branch, which always should be stable

## Installation

### Development:
1. `git clone`
2. `cd SysVentoryServer`
3. Install dependencies: `composer install`
4. Create database: `php app/console doctrine:database:create`
5. Create schema: `php app/console doctrine:schema:create`
6. Load Fixtures (Users): `php app/console doctrine:fixtures:load --fixtures=src/AppBundle/DataFixtures`
7. For a lightweight local webserver: `php app/console server:run`
8. Login with visitor/visitor or inventor/inventor

## Screenshots
![Login](https://github.com/Cogax/SysVentoryServer/blob/master/doc/screenshots/login.png)
![Home](https://github.com/Cogax/SysVentoryServer/blob/master/doc/screenshots/home.png)
![Computers](https://github.com/Cogax/SysVentoryServer/blob/master/doc/screenshots/computers.png)
![Computer](https://github.com/Cogax/SysVentoryServer/blob/master/doc/screenshots/computer.png)
![Compare](https://github.com/Cogax/SysVentoryServer/blob/master/doc/screenshots/compare.png)
![Networks](https://github.com/Cogax/SysVentoryServer/blob/master/doc/screenshots/networks.png)
![New scan](https://github.com/Cogax/SysVentoryServer/blob/master/doc/screenshots/scan_new.png)
![Scan history](https://github.com/Cogax/SysVentoryServer/blob/master/doc/screenshots/scanhistory.png)
![Software statistics](https://github.com/Cogax/SysVentoryServer/blob/master/doc/screenshots/stat_software.png)
