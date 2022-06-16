.. include:: ../../Includes.txt

===================================================
Breaking: #83 - Move Fluid Pagination to Controller
===================================================

See :issue:`83`

Description
===========

In TYPO3 v11 <f:paginate> has been removed and is implemented via the
controller.

Affected Installations
======================

All installations are affected by this change.

Migration
=========

If the templates for the lists of companies or contacts in the backend has been
overwritten, then these templates must also be adapted. If pagination is not
desired, a custom template must be used for the list views.

.. index:: Template, Backend
