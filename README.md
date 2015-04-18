# Secret Santa #

[![Latest Version](https://img.shields.io/github/release/jtyost2/secret.svg?style=flat-square)](https://github.com/jtyost2/secret/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://api.travis-ci.org/jtyost2/secret.svg)](https://travis-ci.org/jtyost2/secret)

[![Code Climate](https://codeclimate.com/github/jtyost2/secret/badges/gpa.svg)](https://codeclimate.com/github/jtyost2/secret)

Performs logic and emailing of a very simple Secret Santa type drawing

## Installation ##

### Zip File ###

1. Download the zip file from the master repo: [https://github.com/jtyost2/secret/zipball/master](https://github.com/jtyost2/secret/zipball/master)
2. Unzip
3. Move to the installation directory directory
4. Rename `./config/config.sample.php` to `/config/config.php` and update with your settings
5. Run `composer install`

### Git Clone ###

1. Git clone this project:
`git clone git://github.com/jtyost2/secret.git secret`
4. Rename `/config/config.sample.php` to `/config/config.php` and update with your settings
5. Run `composer install`

## Requirements ##

 * Composer
 * PHP 5.3+

## Contributing ##

### Reporting Issues ###

Please use [GitHub Isuses](https://github.com/jtyost2/secret/issues) for listing any known defects or issues

### Development ###

When developing this app, please fork and issue a PR for any new development.

The Complete Test Suite for the app can be run via this command:

`./bin/run-tests`

The Code Sniffer as well can be run via this command:

`./bin/run-codesniffer y`

## License

[MIT](https://github.com/jtyost2/secret/blob/master/COPYRIGHT)

## Copyright

[Justin Yost](https://www.yostivanich.com/) 2015
