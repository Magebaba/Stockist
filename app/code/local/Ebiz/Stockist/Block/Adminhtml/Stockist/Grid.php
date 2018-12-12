<?php

class Ebiz_Stockist_Block_Adminhtml_Stockist_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('stockistGrid');
      $this->setDefaultSort('stockist_id');
      $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('stockist/stockist')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
      $this->addColumn('stockist_id', array(
          'header'    => Mage::helper('stockist')->__('ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'stockist_id',
      ));

      $this->addColumn('name', array(
          'header'    => Mage::helper('stockist')->__('Name'),
          'align'     =>'left',
          'index'     => 'name',
      ));

      $this->addColumn('email', array(
          'header'    => Mage::helper('stockist')->__('Email'),
          'align'     =>'left',
          'index'     => 'email',
      ));

      $this->addColumn('telephone', array(
          'header'    => Mage::helper('stockist')->__('Telephone'),
          'align'     =>'left',
          'index'     => 'telephone',
      ));

      $this->addColumn('fax', array(
          'header'    => Mage::helper('stockist')->__('Fax'),
          'align'     =>'left',
          'index'     => 'fax',
      ));

      $this->addColumn('abn', array(
          'header'    => Mage::helper('stockist')->__('ABN'),
          'align'     =>'left',
          'index'     => 'abn',
      ));

      $this->addColumn('address 1', array(
          'header'    => Mage::helper('stockist')->__('Address 1'),
          'align'     =>'left',
          'index'     => 'address_first',
      ));

      $this->addColumn('address 2', array(
          'header'    => Mage::helper('stockist')->__('Address 2'),
          'align'     =>'left',
          'index'     => 'address_second',
      ));

      $this->addColumn('city', array(
          'header'    => Mage::helper('stockist')->__('City'),
          'align'     =>'left',
          'index'     => 'city',
      ));

      $this->addColumn('state', array(
          'header'    => Mage::helper('stockist')->__('State'),
          'align'     =>'left',
          'index'     => 'state',
      ));

      $this->addColumn('country', array(
          'header'    => Mage::helper('stockist')->__('Country'),
          'align'     =>'left',
          'index'     => 'country',
      ));

      $this->addColumn('postcode', array(
          'header'    => Mage::helper('stockist')->__('Postcode'),
          'align'     =>'left',
          'index'     => 'postcode',
      ));

	  /*
      $this->addColumn('content', array(
			'header'    => Mage::helper('stockist')->__('Item Content'),
			'width'     => '150px',
			'index'     => 'content',
      ));
	  */

      /*$this->addColumn('status', array(
          'header'    => Mage::helper('stockist')->__('Status'),
          'align'     => 'left',
          'width'     => '80px',
          'index'     => 'status',
          'type'      => 'options',
          'options'   => array(
              1 => 'Enabled',
              2 => 'Disabled',
          ),
      ));*/
	  
       /* $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('stockist')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('stockist')->__('Edit'),
                    //    'url'       => array('base'=> '//edit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));*/
		
		$this->addExportType('*/*/exportCsv', Mage::helper('stockist')->__('CSV'));
		$this->addExportType('*/*/exportXml', Mage::helper('stockist')->__('XML'));
	  
      return parent::_prepareColumns();
  }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('stockist_id');
        $this->getMassactionBlock()->setFormFieldName('stockist');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('stockist')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('stockist')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('stockist/status')->getOptionArray();

        array_unshift($statuses, array('label'=>'', 'value'=>''));
        $this->getMassactionBlock()->addItem('status', array(
             'label'=> Mage::helper('stockist')->__('Change status'),
             'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
             'additional' => array(
                    'visibility' => array(
                         'name' => 'status',
                         'type' => 'select',
                         'class' => 'required-entry',
                         'label' => Mage::helper('stockist')->__('Status'),
                         'values' => $statuses
                     )
             )
        ));
        return $this;
    }

  public function getRowUrl($row)
  {
      return $this->getUrl('*/*/edit', array('id' => $row->getId()));
  }

}