<?php

class
MageB2B_Sublogin_Block_Edit
extends
Mage_Core_Block_Template
{

protected
function
_getSublogin()
{
return
Mage::registry('subloginModel');
}
protected
function
_getCustomer()
{
return
Mage::getSingleton('customer/session')->getCustomer();
}
public
function
getCustomerAddresses()
{
$_b803c43bc8b3ef64b7d19b78f670cdbd11dacf8c
=
$this->_getCustomer();
foreach
($_b803c43bc8b3ef64b7d19b78f670cdbd11dacf8c->getAddresses()
as
$_17d2af4b1493648e1cc1cb8dffce9a7658374484)
{
$_e654d1a18146651e3bfe6fd079c03211dddd7e9f
=
'';
$_1b144addba58891e49d3fed7e7095afd8ce1c0e5
=
$_17d2af4b1493648e1cc1cb8dffce9a7658374484->getStreet();
foreach
($_1b144addba58891e49d3fed7e7095afd8ce1c0e5
as
$_317d4a7f0913fca2b26a7e355e8f6ae219b839ca)
{
$_e654d1a18146651e3bfe6fd079c03211dddd7e9f
.=
isset($_317d4a7f0913fca2b26a7e355e8f6ae219b839ca)
?
$_317d4a7f0913fca2b26a7e355e8f6ae219b839ca
:
'';
$_e654d1a18146651e3bfe6fd079c03211dddd7e9f
.=
' ';
}
$_e60edee9bbcec9af2084c09a7e3e3bf5a0643e9f
=
$_17d2af4b1493648e1cc1cb8dffce9a7658374484->getCompany()
.
' '
.
$_e654d1a18146651e3bfe6fd079c03211dddd7e9f
.
' '
.
$_17d2af4b1493648e1cc1cb8dffce9a7658374484->getPostcode()
.
' '
.
$_17d2af4b1493648e1cc1cb8dffce9a7658374484->getCity();
$_81e77768f3068185edd8fda5ab1f65a052f81082[$_17d2af4b1493648e1cc1cb8dffce9a7658374484->getId()]
=
$_e60edee9bbcec9af2084c09a7e3e3bf5a0643e9f;
}
return
$_81e77768f3068185edd8fda5ab1f65a052f81082;
}

public
function
dateFormat($_f0c57a04a51d1d900c8d28a111ab8f340a17465b)
{
if
(!$_f0c57a04a51d1d900c8d28a111ab8f340a17465b)
{
return
'';
}
return
$this->formatDate($_f0c57a04a51d1d900c8d28a111ab8f340a17465b,
Mage_Core_Model_Locale::FORMAT_TYPE_SHORT);
}
}