<?php
namespace DDD\Specification\Creation;

/**
 * Class Chemical (化学製品)
 *
 * @package DDD\Specification\Creation
 */
abstract class Chemical
{
    /** @var ContainerSpecification */
    private $containerSpecification;
    
    /**
     * @param ContainerSpecification $specification
     * @return $this
     */
    public function setContainerSpecification(ContainerSpecification $specification)
    {
        $this->containerSpecification = $specification;
        
        return $this;
    }
    
    /**
     * @return ContainerSpecification
     */
    public function getContainerSpecification()
    {
        return $this->containerSpecification;
    }
}
