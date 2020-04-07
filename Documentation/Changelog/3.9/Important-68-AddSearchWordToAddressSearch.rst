.. include:: ../../Includes.txt

=================================================
Important: #68 - Add SearchWord to Address Search
=================================================

See :issue:`68`

Description
===========

To enable the new feature you have to change the new TypoScript setting.

::

   plugin.tx_contacts_addresssearch {
       settings {
           filter {
               searchWord = enabled
           }
       }
   }

Impact
======

No impact is known until you activate the new option.

Affected Installations
======================

Installations which use an own template for address search action have to
add the new field to the template.

:file:`EXT:contacts/Resources/Private/Templates/Address/Search.html`

Migration
=========

Copy these new search field to the filter form.

.. index:: Frontend
