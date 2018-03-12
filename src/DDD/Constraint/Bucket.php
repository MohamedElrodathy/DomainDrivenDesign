<?php
namespace DDD\Constraint;

/**
 * Class Bucket
 *
 * @package DDD\Constraint
 */
class Bucket
{
    /** @var float 最大容量 */
    private $capacity;
    
    /** @var float 内容量 */
    private $contents;
    
    /**
     * Bucket constructor.
     *
     * @param float $capacity
     */
    public function __construct(float $capacity)
    {
        $this->capacity = $capacity;
    }
    
    /**
     * @return float
     */
    public function getCapacity()
    {
        return $this->capacity;
    }
    
    /**
     * @return float
     */
    public function getContents()
    {
        return $this->contents;
    }
    
    /**
     * 注ぐ
     *
     * @param float $addedVolume 加えられた量
     */
    public function pourIn(float $addedVolume)
    {
        $volumePresent = $this->getContents() + $addedVolume;
        
        $this->contents = $this->constrainedToCapacity($volumePresent);
    }
    
    /**
     * 最大容量以下に制限する
     *
     * @param float $volumePlacedIn 入れられた量
     * @return float 入れることのできた量
     */
    private function constrainedToCapacity(float $volumePlacedIn)
    {
        if ($volumePlacedIn > $this->getCapacity()) {
            return $this->getCapacity();
        }
        
        return $volumePlacedIn;
    }
}