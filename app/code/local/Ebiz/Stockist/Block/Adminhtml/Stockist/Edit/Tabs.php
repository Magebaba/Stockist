<?php

class Ebiz_Stockist_Block_Adminhtml_Stockist_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('stockist_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('stockist')->__('Item Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('stockist')->__('Item Information'),
          'title'     => Mage::helper('stockist')->__('Item Information'),
          'content'   => $this->getLayout()->createBlock('stockist/adminhtml_stockist_edit_tab_form')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}