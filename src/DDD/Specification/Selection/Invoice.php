<?php
namespace DDD\Specification\Selection;

/**
 * Class Invoice (請求書)
 *
 * @package DDD\Specification\Selection
 */
class Invoice
{
    private $id;
    
    /** @var Customer 顧客 */
    private $customer;
    
    /** @var int 総額 */
    private $amount;
    
    /** @var \DateTime 支払い期日 */
    private $dueDate;
    
    /**
     * Invoice constructor.
     *
     * @param int $id
     * @param Customer $customer
     * @param int $amount
     * @param \DateTime $dueDate
     */
    public function __construct(int $id, Customer $customer, int $amount, \DateTime $dueDate)
    {
        $this->id       = $id;
        $this->customer = $customer;
        $this->amount   = $amount;
        $this->dueDate  = $dueDate;    
    }
    
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @return Customer
     */
    public function getCustomer()
    {
        return $this->customer;    
    }
    
    /**
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }
    
    /**
     * @return \DateTime
     */
    public function getDueDate()
    {
        return $this->dueDate;    
    }
}
