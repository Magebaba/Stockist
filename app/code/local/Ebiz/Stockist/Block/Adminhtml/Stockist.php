<?php
class Ebiz_Stockist_Block_Adminhtml_Stockist extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_stockist';
    $this->_blockGroup = 'stockist';
    $this->_headerText = Mage::helper('stockist')->__('Item Manager');
    $this->_addButtonLabel = Mage::helper('stockist')->__('Add Item');
    parent::__construct();
  }
}