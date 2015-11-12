<?php

class
MageB2B_Sublogin_Model_Sublogin
extends
Mage_Core_Model_Abstract
{
public
function
_construct()
{
parent::_construct();
$this->_init('sublogin/sublogin');
}

public
function
correctActive()
{
if
($this->getId()
&&
$this->getActive())
{
if
(Mage::getModel('sublogin/source_formfields')->isFieldAllowed('expire_date'))
{

$_192952e8f2f221fa86535b9980dc5ec3b76832d9
=
(int)
str_replace('-',
'',
$this->getExpireDate());
$_66f331ed08b8b8dd437d9dba5e4a732d7b2acabc
=
(int)
date('Ymd');

if
($_66f331ed08b8b8dd437d9dba5e4a732d7b2acabc
>
$_192952e8f2f221fa86535b9980dc5ec3b76832d9
&&
$_192952e8f2f221fa86535b9980dc5ec3b76832d9
!=
0)
{
$this->setActive(false);
}
}
}
}

protected
function
_afterLoad()
{
$this->correctActive();
parent::_afterLoad();
}

protected
function
_beforeSave()
{
if
(Mage::helper('core')->isModuleEnabled('MageB2B_CustomerId')
&&
!$this->getCustomerId())
{
$_b803c43bc8b3ef64b7d19b78f670cdbd11dacf8c
=
Mage::getModel('customer/customer')->load($this->getEntityId());
if
($_b803c43bc8b3ef64b7d19b78f670cdbd11dacf8c->getCustomerId()
&&
Mage::getStoreConfig('customer_id/customer_id/auto_increment'))
{
$_b80cbfb11fdc80a0dabd8069a0fd063d9d896285
=
array();
$_205d95c001c842f933e3b55fa4e902d5d2fdd0af
=
Mage::getModel('sublogin/sublogin')->getCollection()->addFieldToFilter('entity_id',
$_b803c43bc8b3ef64b7d19b78f670cdbd11dacf8c->getId());
foreach
($_205d95c001c842f933e3b55fa4e902d5d2fdd0af
as
$_4e45fa4f3249d9c3cc1314ed89922593008cf117)
{
$_b80cbfb11fdc80a0dabd8069a0fd063d9d896285[]
=
$_4e45fa4f3249d9c3cc1314ed89922593008cf117->getCustomerId();
}
$_205d95c001c842f933e3b55fa4e902d5d2fdd0af
=
Mage::getModel('sublogin/sublogin')->getCollection()
->addFieldToFilter('entity_id',
$_b803c43bc8b3ef64b7d19b78f670cdbd11dacf8c->getId())
->addOrder('id',
'asc');
$_e5063eb1568e4b8089f8c18b623e0363b782b74c
=
1;
while
(in_array($_b803c43bc8b3ef64b7d19b78f670cdbd11dacf8c->getCustomerId().
'-'
.
$_e5063eb1568e4b8089f8c18b623e0363b782b74c,
$_b80cbfb11fdc80a0dabd8069a0fd063d9d896285))
$_e5063eb1568e4b8089f8c18b623e0363b782b74c++;
$this->setCustomerId($_b803c43bc8b3ef64b7d19b78f670cdbd11dacf8c->getCustomerId()
.
'-'
.
$_e5063eb1568e4b8089f8c18b623e0363b782b74c);
}
}
$_36276558859e15204f0e389493057edad0cad1cf
=
Mage::getModel('newsletter/subscriber')->loadByEmail($this->getEmail());
if
((int)$this->getData('is_subscribed'))
{
if
(!$_36276558859e15204f0e389493057edad0cad1cf->getId())
Mage::getModel('newsletter/subscriber')->subscribe($this->getEmail());
}
else
{
$_36276558859e15204f0e389493057edad0cad1cf->unsubscribe();
}
if
(!$this->getData('expire_date')
||
$this->getData('expire_date')
===
null
||
$this->getData('expire_date')
==
'0000-00-00')
{
$this->setExpireDate(new
Zend_Db_Expr('0000-00-00'));
}
parent::_beforeSave();
}

public
function
getCustomer()
{
if
($this->getId()
&&
$this->getStoreId()
&&
$this->getEntityId())
{
if
(Mage::app()->getStore()->isAdmin())
{
$_9df5bb0d628aca83c107ce56b3853996a5daee37
=
Mage::registry('current_customer');
}

else
{
$_dcc4d2d5fcf05abcf602065c835e58955194581f
=
Mage::getModel('core/store')->load($this->getStoreId())->getWebsiteId();
$_9df5bb0d628aca83c107ce56b3853996a5daee37
=
Mage::getModel('customer/customer')
->setWebsiteId($_dcc4d2d5fcf05abcf602065c835e58955194581f)->load($this->getEntityId());
}
if
($_9df5bb0d628aca83c107ce56b3853996a5daee37->getId())
{
return
$_9df5bb0d628aca83c107ce56b3853996a5daee37;
}
return
null;
}
return
null;
}

public
function
getAcl($_7855514b05db1abc4d8ed98b10268b4429d64d1e
=
false)
{
$_b753179da5bff34c40eb3baf649cf83e44b9c9bc
=
explode(',',
$this->getData('acl'));
if
(@in_array($_7855514b05db1abc4d8ed98b10268b4429d64d1e,
$_b753179da5bff34c40eb3baf649cf83e44b9c9bc))
{
return
true;
}
return
false;
}
public
function
getBudgets()
{
if
($this->getId())
{
$_205d95c001c842f933e3b55fa4e902d5d2fdd0af
=
Mage::getModel('sublogin/budget')->getCollection()
->addFieldToFilter('sublogin_id',
$this->getId())
->addFieldToFilter(
array('year',
'month',
'day'),
array(date('Y'),
date('m'),
date('d'))
)
;
return
$_205d95c001c842f933e3b55fa4e902d5d2fdd0af;
}
return
false;
}
}