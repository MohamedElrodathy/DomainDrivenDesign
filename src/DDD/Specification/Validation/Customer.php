<?php
namespace DDD\Specification\Validation;

/**
 * Class Customer (顧客)
 *
 * @package DDD\Specification\Validation
 */
class Customer
{
    private $id;
    
    /** @var Invoice[] 請求書 */
    private $invoice;
    
    /** @var int 猶予期間 */
    private $gracePeriod;
    
    /**
     * Customer constructor.
     *
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }
    
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @param Invoice $invoice
     * @return $this
     */
    public function setInvoice(Invoice $invoice)
    {
        $this->invoice[] = $invoice;
        
        return $this;
    }
    
    /**
     * @return Invoice[]
     */
    public function getInvoice()
    {
        return $this->invoice;
    }
    
    /**
     * @param $gracePeriod
     * @return $this
     */
    public function setPaymentGracePeriod($gracePeriod)
    {
        $this->gracePeriod = $gracePeriod;
        
        return $this;
    }
    
    /**
     * @return int
     */
    public function getPaymentGracePeriod()
    {
        return $this->gracePeriod;        
    }
}
