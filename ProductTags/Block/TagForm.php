<?php

namespace AHT\ProductTags\Block;

class TagForm extends \Magento\Framework\View\Element\Template
{
    protected $_registry;
    
    protected $_tagsFactory;

    private $_product;
    
    protected $_scopeConfig;
    
    protected $_storeManager;

    private $_customerSession;

    protected $_customerUrl;
    
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \AHT\ProductTags\Model\TagsFactory $tagsFactory,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Customer\Model\Url $customerUrl,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_registry = $registry;
        $this->_tagsFactory = $tagsFactory->create();
        $this->_scopeConfig = $scopeConfig;
        $this->_storeManager = $storeManager;
        $this->_customerSession = $customerSession;
        $this->_customerUrl = $customerUrl;
    }

    /**
     * @return \Magento\Catalog\Model\Product
     */
    public function getProduct()
    {
        if (is_null($this->_product)) {
            $this->_product = $this->_registry->registry('product');

            if (!$this->_product->getId()) {
                throw new LocalizedException(__('Failed to initialize product'));
            }
        }
        return $this->_product;
    }
    
    /**
     * @return \AHT\ProductTags\Model\ResourceModel\Tags\Collection $collection
     */
    public function getTags(){
        return $this->_tagsFactory->getCollection()
                ->addFieldToFilter('product_id', array('eq'=>$this->_product->getId()))
                ->addFieldToFilter('status',1);
    }
    
    /**
     * @return string
     */
    public function getFrontendUrl(){
        return $this->_storeManager->getStore()->getBaseUrl().$this->_scopeConfig->getValue('producttags/options/tagslug', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
    /**
     * @return string
     */
    public function getTitleBlog(){
        return $this->_storeManager->getStore()->getBaseUrl().$this->_scopeConfig->getValue('producttags/options/titleblog', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
    /**
     * @return boolean
     */
     public function getCustomerSession()
    {   
        // var_dump($this->_customerSession->IsLoggedIn());
        // die();
        return $this->_customerSession;
    }
    /**
     * @return string
     */
    public function getRegisterUrl()
    {
        return $this->_customerUrl->getRegisterUrl();
    }
    /**
     * @return string
     */
    public function getLoginLink()
    {
        return $this->_customerUrl->getLoginUrl();
    }
}