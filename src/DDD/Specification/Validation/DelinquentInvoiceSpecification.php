<?php
namespace DDD\Specification\Validation;

/**
 * Class DelinquentInvoiceSpecification (延滞請求書仕様)
 *
 * @package DDD\Specification\Validation
 */
class DelinquentInvoiceSpecification extends InvoiceSpecification
{
    /** @var \DateTime 当日日付 */
    private $currentDate;
    
    /**
     * DelinquentInvoiceSpecification constructor.
     *
     * @param \DateTime $currentDate
     */
    public function __construct(\DateTime $currentDate)
    {
        $this->currentDate = $currentDate;
    }
    
    /**
     * 仕様を満たしているかを判定する
     *
     * @param Invoice $candidate 判定対象の請求書
     * @return bool
     */
    public function isSatisfiedBy(Invoice $candidate)
    {
        $gracePeriod = $candidate->getCustomer()->getPaymentGracePeriod();
        
        $firmDeadline = $candidate->getDueDate()->modify($gracePeriod . ' days');
        
        return new \DateTime() >= $firmDeadline; 
    }
}
