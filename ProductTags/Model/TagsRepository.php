<?php


namespace AHT\ProductTags\Model;

use AHT\ProductTags\Model\TagsFactory;
use AHT\ProductTags\Model\ResourceModel\Tags;
use AHT\ProductTags\Api\Data\TagsInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;

class TagsRepository implements \AHT\ProductTags\Api\TagsRepositoryInterface
{

    /**
     * @var ResourceModel\Tags
     */
    protected $_resource;

    /**
     * @var Tags
     */
    protected $_tagsFactory;

    /**
     * @var ResourceModel\Tags\CollectionFactory
     */
    protected $_tagsCollectionFactory;
    protected $_request;
    protected $extensibleDataObjectConverter;
    public function __construct(
        \AHT\ProductTags\Model\TagsFactory $tagsFactory,
        \AHT\ProductTags\Model\ResourceModel\Tags $resource,
        \Magento\Framework\App\RequestInterface $request,
        \Magento\Framework\Api\ExtensibleDataObjectConverter $extensibleDataObjectConverter,
        \AHT\ProductTags\Model\ResourceModel\Tags\CollectionFactory $tagsCollectionFactory
    ) {
        $this->_tagsFactory = $tagsFactory;
        $this->_resource = $resource;
        $this->_request = $request;
        $this->_tagsCollectionFactory = $tagsCollectionFactory;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }
    /**
     * Save Tags data
     *
     * 
     * @return \AHT\ProductTags\Model\Tags
     */
    public function save(
        \AHT\ProductTags\Api\Data\TagsInterface $tags) {
        // die("đasadsad");
        // $this->_resource->save($tags);
        // return $tags->getData();
        // var_dump($tags);
        // die();
        $tagsData = $this->extensibleDataObjectConverter->toNestedArray(
            $tags,
            [],
            \AHT\ProductTags\Api\Data\TagsInterface::class
        );
        
        $tagsModel = $this->_tagsFactory->create()->setData($tagsData);
        
        try {
            $this->_resource->save($tagsModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the tags: %1',
                $exception->getMessage()
            ));
        }
        return $tagsModel->getDataModel();
    }
    
    /**
     * {@inheritdoc}
     */
    public function getById($tagsId)
    {
        $tags = $this->_tagsFactory->create();
        $this->_resource->load($tags, $tagsId);
        if (!$tags->getId()) {
            throw new NoSuchEntityException(__('Tags with id "%1" does not exist.', $tagsId));
        }
        return $tags->getDataModel();
    }
    /**
     * Undocumented function
     *
     * @return null
     */
    public function getList() {
        // die('demo');
        $collection = $this->_tagsCollectionFactory->create();
        return $collection->getData();
    }
    /**
     * {@inheritdoc}
     */
    public function delete(
        \AHT\ProductTags\Api\Data\TagsInterface $tags
    ) {
        try {
            $tagsModel = $this->_tagsFactory->create();
            $this->_resource->load($tagsModel, $tags->getTagsId());
            $this->_resource->delete($tagsModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Tags: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($tagsId)
    {
        return $this->delete($this->getById($tagsId));
    }
}