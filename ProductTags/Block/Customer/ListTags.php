<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AHT\ProductTags\Block\Customer;

use Magento\Customer\Api\AccountManagementInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;

/**
 * Customer Reviews list block
 *
 * @api
 * @since 100.0.2
 */
class ListTags extends \Magento\Customer\Block\Account\Dashboard
{
    protected $_collection;
    protected $_collectionFactory;
    protected $_productRepository;
    protected $_storeManager;
    protected $_scopeConfig;
    protected $currentCustomer;
    protected $_tagsFactory;
   
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Newsletter\Model\SubscriberFactory $subscriberFactory,
        CustomerRepositoryInterface $customerRepository,
        \AHT\ProductTags\Model\TagsFactory $tagsFactory,
        AccountManagementInterface $customerAccountManagement,
        \AHT\ProductTags\Model\ResourceModel\Tags\CollectionFactory $collectionFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Catalog\Model\ProductRepository $productRepository,
        \Magento\Customer\Helper\Session\CurrentCustomer $currentCustomer,
        array $data = []
    ) {
        $this->_collectionFactory = $collectionFactory;
        $this->_productRepository = $productRepository;
        $this->_storeManager = $storeManager;
        parent::__construct(
            $context,
            $customerSession,
            $subscriberFactory,
            $customerRepository,
            $customerAccountManagement,
            $data
        );
        $this->currentCustomer = $currentCustomer;
        $this->_tagsFactory = $tagsFactory->create();
        $this->_scopeConfig = $scopeConfig;
        $this->_storeManager = $storeManager;
    }
    /**
     * @return \AHT\ProductTags\Model\ResourceModel\Tags\Collection
     */
    public function getAllTags(){
       
        if (!($customerId = $this->currentCustomer->getCustomerId())) {
            return false;
        }
        else {
            $collection = $this->_tagsFactory->getCollection()
            ->addFieldToFilter('status',1)
            ->addFieldToFilter('user_id',$this->currentCustomer->getCustomerId());
            $collection->getSelect()->columns('COUNT(*) AS amount')->group('tag');
            return $collection;
        }
        
    }

    public function getProductById($id)
    {
        return $this->_productRepository->getById($id);
    }
    public function getToolbarHtml()
    {
        return $this->getChildHtml('toolbar');
    }

    /**
     * Initializes toolbar
     *
     * @return \Magento\Framework\View\Element\AbstractBlock
     */
    protected function _prepareLayout()
    {
        if ($this->getAllTags()) {
            $toolbar = $this->getLayout()->createBlock(
                \Magento\Theme\Block\Html\Pager::class,
                'customer_tags_list.toolbar'
            )->setCollection(
                $this->getAllTags()
            );

            $this->setChild('toolbar', $toolbar);
        }
        return parent::_prepareLayout();
    }

    /**
     * Get reviews
     *
     * @return bool|\Magento\Review\Model\ResourceModel\Review\Product\Collection
     */
    public function getTags()
    {
        if (!($customerId = $this->currentCustomer->getCustomerId())) {
            return false;
        }
        if (!$this->_collection) {
            $this->_collection = $this->_collectionFactory->create();
            $this->_collection
                // ->addFieldToFilter('store_id',$this->_storeManager->getStore()->getId())
                ->addFieldToFilter('user_id',$this->currentCustomer->getCustomerId())
                ->addFieldToFilter('status',1);;
            $this->_collection
                ->getSelect();
                // ->order('created_at' .' '. \Magento\Framework\DB\Select::SQL_DESC);
        }
        return $this->_collection;  
    }
    
    public function getFrontendUrl(){
        return $this->_storeManager->getStore()->getBaseUrl().$this->_scopeConfig->getValue('producttags/options/tagslug', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
    
}