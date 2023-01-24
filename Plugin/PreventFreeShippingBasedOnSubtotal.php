<?php
declare(strict_types=1);
/**
 * @copyright 2023 Magento Makers
 * @package MagentoMakers_ToggleFreeShippingBySubtotal
 */

namespace MagentoMakers\ToggleFreeShippingBySubtotal\Plugin;

use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\OfflineShipping\Model\Carrier\Freeshipping;
use Magento\Quote\Model\Quote\Address\RateRequest;
use Magento\Shipping\Model\Rate\Result as RateResult;

class PreventFreeShippingBasedOnSubtotal
{
    /**
     * PreventFreeShippingBasedOnSubtotal constructor.
     *
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        private ScopeConfigInterface $scopeConfig
    ){}

    /**
     * Prevents free shipping based on subtotal (if disabled)
     *
     * @param Freeshipping $freeShipping
     * @param callable $proceed
     * @param RateRequest $request
     * @return RateResult|bool
     */
    public function aroundCollectRates(
        Freeshipping $freeShipping,
        callable $proceed,
        RateRequest $request
    ) {
        $subtotalEnabled = $this->scopeConfig->isSetFlag(
            'carriers/freeshipping/enable_subtotal', ScopeInterface::SCOPE_WEBSITE
        );

        // only proceed if subtotal based free shipping enabled or if free shipping is set
        return $subtotalEnabled || $request->getFreeShipping() ? $proceed($request) : false;
    }
}
