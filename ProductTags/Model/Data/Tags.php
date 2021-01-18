<?php


namespace AHT\ProductTags\Model\Data;

use AHT\ProductTags\Api\Data\TagsInterface;

class Tags extends \Magento\Framework\Api\AbstractExtensibleObject implements TagsInterface
{

    /**
     * Get tags_id
     * @return string|null
     */
    public function getTagsId()
    {
        return $this->_get(self::TAGS_ID);
    }
    /**
     * Set tags_id
     * @param string $tagsId
     * @return \AHT\ProductTags\Api\Data\TagsInterface
     */
    public function setTagsId($tagsId)
    {
        return $this->setData(self::TAGS_ID, $tagsId);
    }
     public function getStatus()
    {
        return $this->_get(self::STATUS);
    }
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }
    /**
     * Get product_id
     * @return string|null
     */
    public function getProductId()
    {
        return $this->_get(self::PRODUCT_ID);
    }

    /**
     * Set product_id
     * @param string $productId
     * @return \AHT\ProductTags\Api\Data\TagsInterface
     */
    public function setProductId($productId)
    {
        return $this->setData(self::PRODUCT_ID, $productId);
    }
    /**
     * Get product_name
     * @return string|null
     */
    public function getProductName()
    {
        return $this->_get(self::PRODUCT_NAME);
    }

    /**
     * Set product_name
     * @param string $productName
     * @return \AHT\ProductTags\Api\Data\TagsInterface
     */
    public function setProductName($productName)
    {
        return $this->setData(self::PRODUCT_NAME, $productName);
    }

    /**
     * Get tag
     * @return string|null
     */
    public function getTag()
    {
        return $this->_get(self::TAG);
    }

    /**
     * Set tag
     * @param string $tag
     * @return \AHT\ProductTags\Api\Data\TagsInterface
     */
    public function setTag($tag)
    {
        return $this->setData(self::TAG, $tag);
    }

    public function getUserId()
    {
        return $this->_get(self::USER_ID);
    }

    public function SetUserId($user_id)
    {
        return $this->setData(self::USER_ID, $user_id);
    }
}