<?php

class Ebiz_Stockist_Block_Adminhtml_Stockist_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'stockist';
        $this->_controller = 'adminhtml_stockist';
        
        $this->_updateButton('save', 'label', Mage::helper('stockist')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('stockist')->__('Delete Item'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('stockist_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'stockist_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'stockist_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('stockist_data') && Mage::registry('stockist_data')->getId() ) {
            return Mage::helper('stockist')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('stockist_data')->getTitle()));
        } else {
            return Mage::helper('stockist')->__('Add Item');
        }
    }
}