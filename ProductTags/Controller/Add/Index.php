<?php
namespace AHT\ProductTags\Controller\Add;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;
    /**
     * @var \Magento\Framework\Json\Helper\Data
     */
    protected $jsonHelper;
    /**
     * @var \AHT\ProductTags\Model\Tags
     */
    protected $_tags;
    protected $_tagsFactory;
    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $_session;
    /**
     * Constructor
     *
     * @param \Magento\Framework\App\Action\Context  $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Framework\Json\Helper\Data $jsonHelper
     * @apram \AHT\ProductTags\Model\Tags $tags
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Json\Helper\Data $jsonHelper,
        \AHT\ProductTags\Model\Tags $tags,
        \AHT\ProductTags\Model\TagsFactory $tagsFactory,
        \Magento\Customer\Model\Session $session
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->jsonHelper = $jsonHelper;
        $this->_tags = $tags;
        $this->_tagsFactory=$tagsFactory;
        $this->_session = $session;
        parent::__construct($context);
    }

    /**
     * Execute view action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $response = [];
        $data = $this->getRequest()->getPostValue();
        if(!$data['tag']){
            $response = array('error'=>true, 'msg'=>__('Please fill in tags'));
        } else {
            $allTags = explode(',', $data['tag']);
            // echo $data['tag'];
            foreach($allTags as $tagName){
                $tag = $this->_tagsFactory->create();
                $tag->setProductId($data['product_id']);
                $tag->setProductName($data['product_name']);
                $tag->setTag($tagName);

                if($this->_session->isLoggedin()){
                    $tag->setUserId($this->_session->getCustomer()->getId());
                } else {
                    $tag->setUserId(0);
                }
                $tag->save();
            }
            $response = array('success'=>true, 'msg'=>__('Thank you for your input'));
        }
        
        try {
            return $this->jsonResponse($response);
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            return $this->jsonResponse($e->getMessage());
        } catch (\Exception $e) {
            $this->logger->critical($e);
            return $this->jsonResponse($e->getMessage());
        }
    }

    /**
     * Create json response
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function jsonResponse($response = '')
    {
        return $this->getResponse()->representJson(
            $this->jsonHelper->jsonEncode($response)
        );
    }
}