.. include:: ../../Includes.txt

=======================================================================================
Feature: #65 - Add Teaser, Description, and Meta Description for Contacts and Companies
=======================================================================================

See :issue:`65`

Description
===========

Contacts and companies often need some field to describe them
in list and details views.
For lists a shorter field (teaser) and in show
views a longer RTE field (description) will be prodided.
The new meta description field can be used to override the
description in the page header.
A new ViewHelper offers the possibility to overwrite the meta
information depending on the people or company data record.

.. IMPORTANT::
   Some changes to the sql configuration file and TCA require a database update.

.. NOTE::
   The new fields are excluded by default. You have to update the access roles to
   enable the new fields for editors.

.. index:: Frontend, Backend
