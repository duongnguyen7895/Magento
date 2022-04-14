<?php

namespace Mageplaza\MagentoComponent\Plugin;

use Magento\Catalog\Api\Data\ProductExtensionInterface;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\Data\ProductExtensionFactory;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Api\Data\ProductSearchResultsInterface;
use Mageplaza\MagentoComponent\Model\ComponentFactory;
use Mageplaza\MagentoComponent\Model\ResourceModel\Component\CollectionFactory;
use Magento\Catalog\Model\ProductFactory as Product;


class CustomtAttributesLoad
{
    /**
     * @var ProductExtensionFactory
     */
    public $extensionFactory;

    public $componentFactory;

    public $collectionFactory;
    public $product;

    /**
     * @param ProductExtensionFactory $extensionFactory
     */
    public function __construct(
        ProductExtensionFactory $extensionFactory,
        ComponentFactory $componentFactory,
        CollectionFactory $collectionFactory,
        Product $product
    )
    {
        $this->componentFactory = $componentFactory;
        $this->extensionFactory = $extensionFactory;
        $this->collectionFactory = $collectionFactory;
        $this->product = $product;
    }

    public function afterGet(
        ProductRepositoryInterface $subject,
        ProductInterface $entity
    )
    {
        $extensionAttributes = $entity->getExtensionAttributes();
        $componentModel = $this->componentFactory->create();
        $productId = $entity->getId();
        $product = $this->product->create()->load($productId);

        $componentName = $product->getData('new_component');

        if(!empty($componentName)) {
            $collection = $this->collectionFactory->create();
            foreach ($collection as $component) {
                if ($component->getName() === $componentName) {
                    $component = $componentModel->load($component->getId());
                    $extensionAttributes->setMpMagentoComponent($component);
                    $entity->setExtensionAttributes($extensionAttributes);
                    break;
                }
            }
        }


        return $entity;
    }


    public function afterGetList(
        ProductRepositoryInterface $subject,
        $result
    )
    {
        foreach ($result->getItems() as $item) {
            $this->afterGet($subject, $item);
        }

        return $result;
    }


}
