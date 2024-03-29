# Contacts

[![Build Status](https://travis-ci.org/extcode/contacts.svg?branch=4.x)](https://travis-ci.org/extcode/contacts)

EXT:contacts is a TYPO3 extension for handling contacts (companies, persons).

## 1. Features

- Persons and companies can be related to each other.
- Both can have multiple addresses and other contact data.
- Addresses can hold geolocation data to display them in maps.

## 2. Installation / Upgrade

### 2.1 Installation

#### Installation using Composer

The recommended way to install the extension is by using [Composer][2].
In your Composer based TYPO3 project root, just do `composer require extcode/contacts`. 

#### Installation as extension from TYPO3 Extension Repository (TER)

Download and install the extension with the extension manager module.

## 3. Administration

## 3.1 Compatibility and supported Versions

| Contacts      | TYPO3      | PHP       | Support/Development                  |
| ------------- | ---------- | ----------|--------------------------------------|
| 4.x.x         | 10.4, 11.5 | 7.2+      | Features, Bugfixes, Security Updates |
| 3.x.x         | 9.5        | 7.2 - 7.4 | Bugfixes, Security Updates           |
| 2.x.x         | 8.7        | 7.0 - 7.2 | Security Updates                     |
| 1.x.x         | 7.6        | 5.6 - 7.1 |                                      |
| 0.x.x         |            |           |                                      |

### 3.2. Changelog

Please have a look into the [official extension documentation in changelog chapter](https://docs.typo3.org/p/extcode/contacts/main/en-us/Changelog/Index.html)

### 3.3. Release Management

News uses **semantic versioning** which basically means for you, that
- **bugfix updates** (e.g. 1.0.0 => 1.0.1) just includes small bugfixes or security relevant stuff without breaking changes.
- **minor updates** (e.g. 1.0.0 => 1.1.0) includes new features and smaller tasks without breaking changes.
- **major updates** (e.g. 1.0.0 => 2.0.0) breaking changes wich can be refactorings, features or bugfixes.

## 4. Sponsoring

* Ask for an invoice.
* [GitHub Sponsors](https://github.com/sponsors/extcode)
* [PayPal.Me](https://paypal.me/extcart)
* [Patreon](https://patreon.com/ext_cart)

[1]: https://docs.typo3.org/typo3cms/extensions/cart/
[2]: https://getcomposer.org/