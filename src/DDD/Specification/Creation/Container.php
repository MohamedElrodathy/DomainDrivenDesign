<?php
namespace DDD\Specification\Creation;

/**
 * Class Container (コンテナ)
 *
 * @package DDD\Specification\Creation
 */
class Container
{
    /** @var ContainerFeature[] コンテナ機能 */
    private $features = [];
    
    /** @var double 最大容量 */
    private $capacity;
    
    /** @var Drum[] 内容物 */
    private $contents = [];
    
    /**
     * Container constructor.
     *
     * @param ContainerFeature[] $features
     * @param $capacity
     */
    public function __construct(array $features, $capacity)
    {
        $this->features = $features;
        $this->capacity = $capacity;
    }
    
    /**
     * @return ContainerFeature[]
     */
    public function getFeatures()
    {
        return $this->features;
    }
    
    /**
     * @return float
     */
    public function getCapacity()
    {
        return $this->capacity;
    }
    
    /**
     * @param Drum $aDrum
     * @return $this
     */
    public function setContents(Drum $aDrum)
    {
        $this->contents[] = $aDrum;
        
        return $this;
    }
    
    /**
     * @return Drum[]
     */
    public function getContents()
    {
        return $this->contents;
    }
    
    /**
     * 安全に格納されているか
     *
     * @return bool 安全に格納されていれば true
     */
    public function isSafelyPacked()
    {
        foreach ($this->getContents() as $aDrum) {
            if (! $aDrum->getContainerSpecification()->isSatisfiedBy($this)) {
                return false;
            }
        }
        
        return true;
    }
    
    /**
     * ドラム缶を入れる空間があるかどうかを判定する
     *
     * @param Drum $aDrum ドラム缶
     * @return bool 空間があれば true
     */
    public function hasSpaceFor(Drum $aDrum)
    {
        return $this->remainingSpace() >= $aDrum->getSize();
    }
    
    /**
     * 残りの空間を取得する
     *
     * @return float 残りの空間の大きさ
     */
    public function remainingSpace()
    {
        $totalContentSize = 0.0;
        
        foreach ($this->getContents() as $aDrum) {
            $totalContentSize = $totalContentSize + $aDrum->getSize();
        }
        
        return $this->getCapacity() - $totalContentSize;
    }
    
    /**
     * あるドラム缶が収容可能かどうかを判定する
     *
     * @param Drum $aDrum ドラム缶
     * @return bool 収容可能であれば true
     */
    public function canAccommodate(Drum $aDrum)
    {
        // 空間があり, かつドラム缶のコンテナ仕様がこのコンテナによって満たされるか
        return $this->hasSpaceFor($aDrum) && $aDrum->getContainerSpecification()->isSatisfiedBy($this);
    }
}
