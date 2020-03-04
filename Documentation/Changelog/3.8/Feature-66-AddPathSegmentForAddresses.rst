.. include:: ../../Includes.txt

=============================================
Feature: #66 - Add Path Segment for Addresses
=============================================

See :issue:`66`

Description
===========

In order to have a readable URL for an address, it needs a path segment.
For address path segments the address title is used. If an address doesn't
have a title the path segment only contains the uid as a fallback.

.. IMPORTANT::
   Some changes to the sql configuration file and TCA require a database update.

.. NOTE::
   There is a slug updater wizard for updating slugs for addresses, contacts and companies.

.. index:: Frontend, Backend
