<?php
class Ebiz_Stockist_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
    	
		$this->loadLayout();     
		$this->renderLayout();
    }

    public function createAction()
    {
    	$postData = $this->getRequest()->getPost();
    	
    	
    	$stockist = Mage::getModel('stockist/stockist');
                
        $stockist->setStockistId($this->getRequest()->getParam('id'))
            ->setName($postData['first_name'].' '.$postData['last_name'])
            ->setEmail($postData['email_address'])
            ->setTelephone($postData['telephone'])
            ->setFax($postData['fax'])
            ->setCompany($postData['company'])
            ->setAbn($postData['ABN'])
            ->setAddressFirst($postData['address1'])
            ->setAddressSecond($postData['address2'])
            ->setCity($postData['city'])
            ->setState($postData['state'])
            ->setCountry($postData['country'])
            ->setPostcode($postData['postcode'])
            ->setComment($postData['comment'])
            ->setStatus($postData['0'])
            ->setCreatedTime(Mage::getModel('core/date')->gmtDate('Y-m-d H:i:s'))
            ->setUpdateTime(Mage::getModel('core/date')->gmtDate('Y-m-d H:i:s'))
            ->save();
            
            /*stockist email*/
            $postObject = new Varien_Object();
            $postObject->setData($postData);

			$translate = Mage::getSingleton('core/translate');
            $translate->setTranslateInline(false);

			$templateId = 1;
			$mailTemplate = Mage::getModel('core/email_template');

			$sender = array('name'=>'Admin','email'=>'ksharma@ebizneeds.com');

			$store = Mage::app()->getStore()->getId();

			//$mailTemplate->sendTransactional($templateId, $sender, $postData['email_address'], $postData['first_name'], array('data' => $postObject), $store); 

            $mailTemplate->setDesignConfig(array('area' => 'frontend'))
                    ->setReplyTo($postData['email_address'])
                    ->sendTransactional(
                        $templateId,
                        $sender,
                        $postData['email_address'],
                        null,
                        array('data' => $postObject)
                    );  
            
           
            if (!$mailTemplate->getSentSuccess()) {
                throw new Exception();
            }
			$translate->setTranslateInline(true);

            /*admin email*/
            $postObject1 = new Varien_Object();
            $postObject1->setData($postData);

            $translate1 = Mage::getSingleton('core/translate');
            $translate1->setTranslateInline(false);

            $templateId1 = 2;
            $mailTemplate1 = Mage::getModel('core/email_template');

            $sender1 = array('name'=> $postData['first_name'].' '.$postData['last_name'],'email'=> $postData['email_address']);

            $store1 = Mage::app()->getStore()->getId();


            $mailTemplate1->setDesignConfig(array('area' => 'frontend'))
                    ->setReplyTo($postData['email_address'])
                    ->sendTransactional(
                        $templateId1,
                        $sender1,
                        'ksharma@ebizneeds.com',
                        null,
                        array('data_rew' => $postObject1)
                    );  
            
           
            if (!$mailTemplate1->getSentSuccess()) {
                throw new Exception();
            }
            $translate1->setTranslateInline(true);
           
            if($postData['is_subscribed'] == '1'){
                $subscriber = Mage::getModel('newsletter/subscriber')->subscribe($postData['email_address']);
            }

		$this->_redirect('stockist/index/success');
	      
    }

    public function successAction()
    {
		$this->loadLayout();     
		$this->renderLayout();
    }

    
}