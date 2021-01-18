<?php


namespace AHT\ProductTags\Model\ResourceModel\Tags;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \AHT\ProductTags\Model\Tags::class,
            \AHT\ProductTags\Model\ResourceModel\Tags::class
        );
    }
}