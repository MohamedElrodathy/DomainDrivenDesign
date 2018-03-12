<?php
namespace DDD\Specification\Selection;

/**
 * Interface InvoiceSpecification
 *
 * @package DDD\Specification\Selection
 */
interface InvoiceSpecification
{
    public function isSatisfiedBy(Invoice $invoice);
    
    public function findSatisfyingElementsBy(InvoiceRepository $repository);
}
