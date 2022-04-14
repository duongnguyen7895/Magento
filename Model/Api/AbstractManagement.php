<?php
namespace Mageplaza\MagentoComponent\Model\Api;

use Magento\Framework\Api\Search\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class AbstractManagement
{

    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;


    /**
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        SearchCriteriaBuilder $searchCriteriaBuilder,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @param $searchCriteria
     * @param $searchResult
     * @param $collection
     * @return mixed
     */
    public function getListEntity($searchCriteria, $searchResult, $collection)
    {
        if ($searchCriteria === null) {
            $searchCriteria = $this->searchCriteriaBuilder->create();
        } else {
            $this->collectionProcessor->process($searchCriteria, $collection);
        }

        $searchResult->setItems($collection->getItems());
        $searchResult->setTotalCount($collection->getSize());
        $searchResult->setSearchCriteria($searchCriteria);

        return $searchResult;
    }

    /**
     * @param $id
     * @param $model
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function getEntityById($id, $model)
    {
        $model->load($id);

        if (!$model->getID()) {
            throw new NoSuchEntityException(
                __('The entity that was requested doesn\'t exist. Verify the rule and try again.')
            );
        }

        return $model;
    }
}
