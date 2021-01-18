<?php


namespace AHT\ProductTags\Api;

interface TagsRepositoryInterface
{

    /**
     * Save Tags
     * @param \AHT\ProductTags\Api\Data\TagsInterface $tags
     * @return \AHT\ProductTags\Api\Data\TagsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \AHT\ProductTags\Api\Data\TagsInterface $tags
    );

    /**
     * Retrieve Tags
     * @param string $tagsId
     * @return \AHT\ProductTags\Api\Data\TagsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($tagsId);

    /**
     * get all tags
     *
     * @return \AHT\Testimonial\Api\Data\TagsInterface
     */
    public function getList();

    /**
     * Delete Tags
     * @param \AHT\ProductTags\Api\Data\TagsInterface $tags
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \AHT\ProductTags\Api\Data\TagsInterface $tags
    );

    /**
     * Delete Tags by ID
     * @param string $tagsId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($tagsId);
}