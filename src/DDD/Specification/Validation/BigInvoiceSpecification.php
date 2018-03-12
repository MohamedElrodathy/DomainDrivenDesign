<?php
namespace DDD\Specification\Validation;

/**
 * Class BigInvoiceSpecification (巨額請求書仕様)
 *
 * @package DDD\Specification\Validation
 */
class BigInvoiceSpecification extends InvoiceSpecification
{
    /** @var int 下限金額 */
    private $thresholdAmount;
    
    /**
     * BigInvoiceSpecification constructor.
     *
     * @param int $thresholdAmount
     */
    public function __construct(int $thresholdAmount)
    {
        $this->thresholdAmount = $thresholdAmount;
    }
    
    /**
     * @param Invoice $candidate
     * @return bool
     */
    public function isSatisfiedBy(Invoice $candidate)
    {
        return $candidate->getAmount() > $this->thresholdAmount;
    }
}