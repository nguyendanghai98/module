<?php


namespace AHT\ProductTags\Model\ResourceModel;

class Tags extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('aht_producttags_tags', 'tags_id');
    }
}