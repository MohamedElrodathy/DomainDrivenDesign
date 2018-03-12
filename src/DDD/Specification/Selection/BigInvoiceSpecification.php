<?php
namespace DDD\Specification\Selection;

/**
 * Class BigInvoiceSpecification (巨額請求書仕様)
 *
 * @package DDD\Specification\Selection
 */
class BigInvoiceSpecification implements InvoiceSpecification
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
    
    /**
     * 条件を満たす要素を取得する
     *
     * @param InvoiceRepository $repository 請求書リポジトリ
     * @return Invoice[] 条件を満たした請求書のセット
     */
    public function findSatisfyingElementsBy(InvoiceRepository $repository)
    {
        $bigInvoices = [];
        
        foreach ($repository->findBy() as $invoice) {
            if ($this->isSatisfiedBy($invoice)) {
                $bigInvoices[] = $invoice;
            }
        }
        
        return $bigInvoices;
    }
}