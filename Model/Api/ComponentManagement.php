<?php

namespace Mageplaza\MagentoComponent\Model\Api;

use Exception;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\StateException;
use Magento\Framework\Exception\ValidatorException;
use Mageplaza\MagentoComponent\Api\Data\ComponentInterface;
use Mageplaza\MagentoComponent\Api\Data\ComponentSearchResultInterface;
use Mageplaza\MagentoComponent\Api\Data\ComponentSearchResultInterfaceFactory;
use Mageplaza\MagentoComponent\Api\ComponentManagementInterface;
use Mageplaza\MagentoComponent\Model\ResourceModel\Component as ComponentResource;
use Mageplaza\MagentoComponent\Model\ResourceModel\Component\CollectionFactory;
use Mageplaza\MagentoComponent\Model\ComponentFactory;


class ComponentManagement extends AbstractManagement implements ComponentManagementInterface
{
    /**
     * @var ComponentSearchResultInterfaceFactory
     */
    protected $componentSearchResultFactory;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;


    protected $componentFactory;

    /**
     * @var ComponentResource
     */
    protected $componentResource;

    /**
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param CollectionProcessorInterface $collectionProcessor
     * @param ComponentSearchResultInterfaceFactory $componentSearchResultFactory
     * @param CollectionFactory $collectionFactory
     * @param ComponentFactory $componentFactory
     * @param ComponentResource $componentResource
     */
    public function __construct(
        SearchCriteriaBuilder $searchCriteriaBuilder,
        CollectionProcessorInterface $collectionProcessor,
        ComponentSearchResultInterfaceFactory $componentSearchResultFactory,
        CollectionFactory $collectionFactory,
        ComponentFactory $componentFactory,
        ComponentResource $componentResource
    )
    {
        $this->componentSearchResultFactory = $componentSearchResultFactory;
        $this->collectionFactory = $collectionFactory;
        $this->componentFactory = $componentFactory;
        $this->componentResource = $componentResource;

        parent::__construct(
            $searchCriteriaBuilder,
            $collectionProcessor
        );
    }

    /**
     * @inheritdoc
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria = null)
    {
        $searchResult = $this->componentSearchResultFactory->create();
        $componentCollection = $this->collectionFactory->create();

        return $this->getListEntity($searchCriteria, $searchResult, $componentCollection);
    }

    public function save(ComponentInterface $entity)
    {
        $this->checkStatus($entity->getStatus());
        $componentModel = $this->componentFactory->create();

        return $this->saveEntity($entity, $componentModel, $this->componentResource);
    }

    public function saveEntity($entity, $model, $resource = null)
    {
        if ($entity->getId()) {
            $model = $this->getEntityById($entity->getId(), $model);
        }

        $model->addData($entity->getData());

        try {
            $resource->save($model);
        } catch (Exception $e) {
            throw new StateException(__('The entity can\'t be saved. %1', $e->getMessage()));
        }

        return $model;
    }

    public function delete($id)
    {
        $componentModel = $this->componentFactory->create();

        $this->componentResource->load($componentModel, $id);

        if (!$componentModel->getId()) {
            throw new NoSuchEntityException(__('The %1 component doesn\'t exist.', $id));
        }

        try {
            $this->componentResource->delete($componentModel);
        } catch (Exception $e) {
            throw new StateException(__('The component can\'t be delete. %1', $e->getMessage()));
        }

        return true;
    }

    public function checkStatus($data)
    {
        if ($data !== 0 && $data !== 1) {
            throw new InputException(__('Status should be 0 or 1'));
        }
    }


}
