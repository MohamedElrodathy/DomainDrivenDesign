<?php
namespace DDD\Specification\Creation;

/**
 * Class Drum (ドラム缶)
 *
 * @package DDD\Specification\Creation
 */
class Drum
{
    /** @var double ドラム缶のサイズ */
    private $size;
    
    /** @var Chemical 化学製品 */
    private $chemical;
    
    /**
     * Drum constructor.
     *
     * @param $size
     */
    public function __construct($size)
    {
        $this->size = $size;
    }
    
    /**
     * @return float
     */
    public function getSize()
    {
        return $this->size;
    }
    
    /**
     * @param Chemical $chemical
     * @return $this
     */
    public function setChemical(Chemical $chemical)
    {
        $this->chemical = $chemical;
        
        return $this;
    }
    
    /**
     * @return Chemical
     */
    public function getChemical()
    {
        return $this->chemical;
    }
    
    /**
     * @return ContainerSpecification
     */
    public function getContainerSpecification()
    {
        return $this->getChemical()->getContainerSpecification();
    }
}
