<?php
/**
 * VisitableDocument Trait.
 *
 * (c) 2017 Cengizhan Çalışkan <cengizhancaliskan@gmail.com>
 *
 * This file is part of ViewsCount Bundle.
 */

namespace Cengizhan\ViewsCounterBundle\Traits;

trait VisitableDocumentTrait
{
    /**
     * @var int
     *
     * @ODM\Column(name="view_count_singular", type="integer")
     */
    protected $singularViewCount = 0;

    /**
     * @var int
     *
     * @ODM\Column(name="view_count_plural", type="integer")
     */
    protected $pluralViewCount = 0;

    /**
     * @var bool
     */
    private $singularViewed = false;

    /**
     * @var bool
     */
    private $pluralViewed = false;

    /**
     * Unique visitable id for every user.
     *
     * @return string
     */
    public function getVisitorId()
    {
        if (is_callable([$this, 'getId'])) {
            return sprintf('%s', $this->getId());
        }

        return uniqid('visitable');
    }

    /**
     * Visitable name for every object/entity.
     *
     * @return string
     */
    public function getVisitable()
    {
        return strtolower(get_class($this));
    }

    /**
     * @return bool
     */
    public function isSingularViewed()
    {
        return $this->singularViewed;
    }

    /**
     * @return bool
     */
    public function isPluralViewed()
    {
        return $this->pluralViewed;
    }

    /**
     * @return int
     */
    public function getSingularViewCount()
    {
        return $this->singularViewCount;
    }

    /**
     * @param int $singularViewCount
     *
     * @return $this
     */
    public function setSingularViewCount($singularViewCount)
    {
        $this->singularViewCount = $singularViewCount;

        return $this;
    }

    /**
     * Increase the number of unique views.
     *
     * @return int
     */
    public function onSingularViewed()
    {
        return $this->singularViewCount++;
    }

    /**
     * @return int
     */
    public function getPluralViewCount()
    {
        return $this->pluralViewCount;
    }

    /**
     * @param int $pluralViewCount
     *
     * @return $this
     */
    public function setPluralViewCount($pluralViewCount)
    {
        $this->pluralViewCount = $pluralViewCount;

        return $this;
    }

    /**
     * Increase the number of plural views.
     *
     * @return int
     */
    public function onPluralViewed()
    {
        return $this->pluralViewCount++;
    }
}
