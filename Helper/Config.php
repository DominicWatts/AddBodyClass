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
}
