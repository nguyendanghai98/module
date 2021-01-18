<?php

namespace AHT\ProductTags\Block;

class CustomPager extends \Magento\Theme\Block\Html\Pager
{
    protected $_scopeConfig;
    protected $_storeManager;
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_scopeConfig = $scopeConfig;
        $this->_storeManager = $storeManager;
    }
    /**
     * @return string
     */
    public function getFrontendSlug(){
        return $this->_scopeConfig->getValue('producttags/options/tagslug', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
    /**
     * Retrieve page URL by defined parameters
     *
     * @param array $params
     * @return string
     */
    public function getPagerUrl($params = [])
    {
        $urlParams = [];
        $urlParams['_current'] = true;
        $urlParams['_escape'] = true;
        $urlParams['_use_rewrite'] = true;
        $urlParams['_fragment'] = $this->getFragment();
        $urlParams['_query'] = $params;
        return str_replace('producttag/index/index', $this->getFrontendSlug(), $this->getUrl($this->getPath(), $urlParams));
    }
}