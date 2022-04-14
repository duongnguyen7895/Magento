<?php
/**
 * Mageplaza
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Mageplaza.com license that is
 * available through the world-wide-web at this URL:
 * https://www.mageplaza.com/LICENSE.txt
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Mageplaza
 * @package     Mageplaza_Blog
 * @copyright   Copyright (c) Mageplaza (https://www.mageplaza.com/)
 * @license     https://www.mageplaza.com/LICENSE.txt
 */

namespace Mageplaza\MagentoComponent\Observer;

use Exception;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Message\ManagerInterface;
use Mageplaza\MagentoComponent\Model\ComponentFactory;

/**
 * Class CreateAuthor
 */
class CreateComponent implements ObserverInterface
{
    protected $component;

    public function __construct(
        ComponentFactory $authorFactory,
        ManagerInterface $manager
    )
    {
        $this->component = $authorFactory;
        $this->messageManager = $manager;
    }

    /**
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        $product = $observer->getData('product');

        $data = [
            'name' => $product->getNewComponent(),
            'status' => 0,
        ];
        $component = $this->component->create();
        $component->addData($data);
        try {
            $component->save();
        } catch (Exception $e) {
            $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Component.'));
        }

    }
}
