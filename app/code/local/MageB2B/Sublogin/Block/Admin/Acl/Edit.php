<?php

class
MageB2B_Sublogin_Block_Admin_Acl_Edit
extends
Mage_Adminhtml_Block_Widget_Form_Container
{
public
function
__construct()
{
parent::__construct();
$this->_objectId
=
'code';
$this->_blockGroup
=
'sublogin';
$this->_controller
=
'admin_acl';
$this->_updateButton('save',
'label',
Mage::helper('sublogin')->__('Save'));
$this->_updateButton('delete',
'label',
Mage::helper('sublogin')->__('Delete'));
}
public
function
getHeaderText()
{
if
(Mage::registry('acl_data')
&&
Mage::registry('acl_data')->getId())
{
return
Mage::helper('sublogin')->__("Edit Unit '%s'",
$this->escapeHtml(Mage::registry('acl_data')->getId()));
}
else
{
return
Mage::helper('sublogin')->__('Add new access control');
}
}
}