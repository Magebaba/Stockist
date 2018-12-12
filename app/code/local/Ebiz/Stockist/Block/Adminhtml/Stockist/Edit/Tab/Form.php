<?php

class Ebiz_Stockist_Block_Adminhtml_Stockist_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('stockist_form', array('legend'=>Mage::helper('stockist')->__('Item information')));
     
      $fieldset->addField('title', 'text', array(
          'label'     => Mage::helper('stockist')->__('Title'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'title',
      ));

      $fieldset->addField('filename', 'file', array(
          'label'     => Mage::helper('stockist')->__('File'),
          'required'  => false,
          'name'      => 'filename',
	  ));
		
      $fieldset->addField('status', 'select', array(
          'label'     => Mage::helper('stockist')->__('Status'),
          'name'      => 'status',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('stockist')->__('Enabled'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('stockist')->__('Disabled'),
              ),
          ),
      ));
     
      $fieldset->addField('content', 'editor', array(
          'name'      => 'content',
          'label'     => Mage::helper('stockist')->__('Content'),
          'title'     => Mage::helper('stockist')->__('Content'),
          'style'     => 'width:700px; height:500px;',
          'wysiwyg'   => false,
          'required'  => true,
      ));
     
      if ( Mage::getSingleton('adminhtml/session')->getStockistData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getStockistData());
          Mage::getSingleton('adminhtml/session')->setStockistData(null);
      } elseif ( Mage::registry('stockist_data') ) {
          $form->setValues(Mage::registry('stockist_data')->getData());
      }
      return parent::_prepareForm();
  }
}