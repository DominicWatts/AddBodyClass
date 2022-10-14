<?php

/**
 * Copyright © 2021 All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace PixieMedia\AddBodyClass\Helper;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\ScopeInterface;

class Config extends AbstractHelper
{
    public const CONFIG_XML_ENABLED = 'pixie/bodyclass/enabled';
    public const CONFIG_XML_STORES = 'pixie/bodyclass/stores';
    public const CONFIG_XML_HANDLES = 'pixie/bodyclass/handles';
    public const CONFIG_XML_LOGIN = 'pixie/bodyclass/login_status';
    public const CONFIG_XML_CSSCLASS = 'pixie/bodyclass/cssclass';

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        Context $context,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context);
    }

    /**
     * Is enabled
     * @return bool
     */
    public function getEnabled()
    {
        return $this->scopeConfig->isSetFlag(
            self::CONFIG_XML_ENABLED,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Is enabled
     * @return bool
     */
    public function getStores()
    {
        return $this->scopeConfig->isSetFlag(
            self::CONFIG_XML_STORES,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Is enabled
     * @return bool
     */
    public function getHandles()
    {
        return $this->scopeConfig->isSetFlag(
            self::CONFIG_XML_HANDLES,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Is enabled
     * @return bool
     */
    public function getLoginStatus()
    {
        return $this->scopeConfig->isSetFlag(
            self::CONFIG_XML_LOGIN,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get css class
     * @return null|string
     */
    public function getBodyClass()
    {
        return $this->scopeConfig->getValue(
            self::CONFIG_XML_CSSCLASS,
            ScopeInterface::SCOPE_STORE
        );
    }
}
