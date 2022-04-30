<?php

/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace PixieMedia\AddBodyClass\Observer\Frontend;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Setup\Module\Dependency\Parser\Code;
use Magento\Store\Model\StoreManagerInterface;
use PixieMedia\AddBodyClass\Helper\Config;

class AddToBodyClass implements ObserverInterface
{
    /** @var Config */
    protected $pageConfig;

    /** @var StoreManagerInterface */
    protected $storeManager;

    /** @var Config */
    protected $helper;

    /** @var \Magento\Framework\View\LayoutInterface */
    protected $layout;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \PixieMedia\AddBodyClass\Helper\Config $config
     */
    public function __construct(
        Context $context,
        StoreManagerInterface $storeManager,
        Config $helper
    ) {
        $this->pageConfig = $context->getPageConfig();
        $this->layout = $context->getLayout();
        $this->storeManager = $storeManager;
        $this->helper = $helper;
    }

    /**
     * @param Observer $observer
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function execute(Observer $observer)
    {
        if (!$this->helper->getEnabled()) {
            return false;
        }

        // add store codes
        $websiteCode = $this->storeManager->getWebsite()->getCode();
        $storeCode = $this->storeManager->getStore()->getCode();
        $this->pageConfig->addBodyClass($websiteCode);
        $this->pageConfig->addBodyClass($storeCode);

        $handles = $this->layout->getUpdate()->getHandles();
        foreach($handles as $handle) {
            $this->pageConfig->addBodyClass(
                str_ireplace("_", "-", $handle)
            );
        }
        
    }
}
