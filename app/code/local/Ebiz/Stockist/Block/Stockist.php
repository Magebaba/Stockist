<?php
class Ebiz_Stockist_Block_Stockist extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getStockist()     
     { 
        if (!$this->hasData('stockist')) {
            $this->setData('stockist', Mage::registry('stockist'));
        }
        return $this->getData('stockist');
        
    }
}