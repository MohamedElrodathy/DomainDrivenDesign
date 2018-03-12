<?php
namespace DDD\Specification\Selection;

/**
 * Class DelinquentInvoiceSpecification (延滞請求書仕様)
 *
 * @package DDD\Specification\Selection
 */
class DelinquentInvoiceSpecification implements InvoiceSpecification
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
        
        return new \DateTime() > $firmDeadline; 
    }
    
    /**
     * 条件を満たす要素を取得する
     *
     * @param InvoiceRepository $repository 請求書リポジトリ
     * @return Invoice[] 条件を満たした請求書のセット
     */
    public function findSatisfyingElementsBy(InvoiceRepository $repository)
    {
        $delinquentInvoices = [];
        
        foreach ($repository->findBy() as $invoice) {
            if ($this->isSatisfiedBy($invoice)) {
                $delinquentInvoices[] = $invoice;
            }
        }
        
        return $delinquentInvoices;
    }
}
