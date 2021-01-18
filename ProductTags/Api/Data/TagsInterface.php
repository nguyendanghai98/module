<?php


namespace AHT\ProductTags\Api\Data;

interface TagsInterface 
{

    const PRODUCT_ID = 'product_id';
    const TAGS_ID = 'tags_id';
    const PRODUCT_NAME = 'product_name';
    const TAG = 'tag';
    const STATUS ='status';
    const USER_ID ='user_id';
     /**
     * Get tags_id
     * @return string|null
     */
    public function getStatus();
    /**
     * Set tags_id
     * @param string $tagsId
     * @return \AHT\ProductTags\Api\Data\TagsInterface
     */
    public function setStatus($status);
    /**
     * Get tags_id
     * @return string|null
     */
    public function getTagsId();

    /**
     * Set tags_id
     * @param string $tagsId
     * @return \AHT\ProductTags\Api\Data\TagsInterface
     */
    public function setTagsId($tagsId);

    /**
     * Get product_id
     * @return string|null
     */
    public function getProductId();

    /**
     * Set product_id
     * @param string $productId
     * @return \AHT\ProductTags\Api\Data\TagsInterface
     */
    public function setProductId($productId);

    /**
     * Get product_name
     * @return string|null
     */
    public function getProductName();

    /**
     * Set product_name
     * @param string $productName
     * @return \AHT\ProductTags\Api\Data\TagsInterface
     */
    public function setProductName($productName);

    /**
     * Get tag
     * @return string|null
     */
    public function getTag();
    
    /**
     * Set tag
     * @param string $tag
     * @return \AHT\ProductTags\Api\Data\TagsInterface
     */
    public function setTag($tag);
    /**
     * Get user_id
     * @return int|null
     */
    public function getUserId();
    /**
     * Set user_id
     * @param int $user_id
     * @return \AHT\ProductTags\Api\Data\TagsInterface
     */
    public function setUserId($user_id);
    
}