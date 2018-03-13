<?php
namespace DDD\Specification\Creation;

/**
 * Class ContainerSpecification (コンテナ仕様)
 *
 * @package DDD\Specification\Creation
 */
class ContainerSpecification
{
    /** @var ContainerFeature コンテナ機能 */
    private $requiredFeature;
    
    /**
     * ContainerSpecification constructor.
     *
     * @param ContainerFeature $required
     */
    public function __construct(ContainerFeature $required)
    {
        $this->requiredFeature = $required;
    }
    
    /**
     * 受け取ったコンテナが仕様を満たすかどうかを判定する
     *
     * @param Container $aContainer
     * @return mixed
     */
    public function isSatisfiedBy(Container $aContainer)
    {
        return in_array($this->requiredFeature, $aContainer->getFeatures());
    }
}
