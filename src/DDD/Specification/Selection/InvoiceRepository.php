<?php
namespace DDD\Specification\Selection;

/**
 * Class InvoiceRepository
 *
 * @package DDD\Specification\Selection
 */
class InvoiceRepository
{
    /**
     * @return Invoice[] $invoices
     */
    public function findBy()
    {
        $invoices = [];
        
        $customer = new Customer(1);
        $customer->setPaymentGracePeriod(7);
        
        $invoice1 = new Invoice(1, $customer, 1, new \DateTime());
        $customer->setInvoice($invoice1);
        $invoices[] = $invoice1;
        
        $invoice2 = new Invoice(2, $customer, 10, new \DateTime('2018-01-01 00:00:00'));
        $customer->setInvoice($invoice2);
        $invoices[] = $invoice2;
        
        $invoice3 = new Invoice(3, $customer, 10001, new \DateTime());
        $customer->setInvoice($invoice3);
        $invoices[] = $invoice3;
        
        return $invoices;
    }
    
    /**
     * @param InvoiceSpecification $spec
     * @return mixed
     */
    public function findSatisfying(InvoiceSpecification $spec)
    {
        return $spec->findSatisfyingElementsBy($this);
    }
}
