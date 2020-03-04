.. include:: ../../Includes.txt

========================================================================================
Breaking: #65 - Add Teaser, Description, and Meta Description for Contacts and Companies
========================================================================================

See :issue:`65`

Description
===========

To override the meta description in page header, a new ViewHelper was added to the show
templates.

Impact
======

Using the new templates will override your meta description in page header.

Affected Installations
======================

Installations which use the default templates for show action of the `ContactController` or
the `CompanyController` and the editor fill the new meta description field.

:file:`EXT:contacts/Resources/Private/Templates/Company/Show.html`
:file:`EXT:contacts/Resources/Private/Templates/Contact/Show.html`

Migration
=========

Copy these files to your site package and remove the <contacts:metaTag> ViewHelper call from
the templates.

.. index:: Frontend, Backend
