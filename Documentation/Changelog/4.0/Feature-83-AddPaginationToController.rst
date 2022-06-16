.. include:: ../../Includes.txt

============================================
Breaking: #83 - Add Pagination to Controller
============================================

See :issue:`83`

Description
===========

Because in TYPO3 v11 no pagination in the frontend and backend is possible
without an own ViewHelper or an extension, the list action in the
Backend/CompanyController and Backend/ContactController was extended by the
pagination. Via TypoScript it can be defined how many companies and contacts
should be displayed per page.

Integration
===========

An example was implemented for the list view templates.

.. index:: Template, Backend
