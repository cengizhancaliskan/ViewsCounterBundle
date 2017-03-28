<?php
/**
 * VisitableInterface.
 *
 * (c) 2017 Cengizhan Çalışkan <cengizhancaliskan@gmail.com>
 *
 * This file is part of ViewsCount Bundle.
 */

namespace Cengizhan\ViewsCounterBundle\Model;

interface VisitableInterface
{
    /**
     * Singular Views entity field.
     *
     * @var string
     */
    const SINGULAR_VIEW_FIELD = 'singularViewCount';

    /**
     * Plural Views entity field.
     *
     * @var string
     */
    const PLURAL_VIEW_FIELD = 'pluralViewCount';

    /**
     * Session key.
     *
     * @var string
     */
    const SESSION_KEY = '_views_count';

    /**
     * @return int
     */
    public function getId();

    /**
     * @return bool
     */
    public function isSingularViewed();

    /**
     * @return bool
     */
    public function isPluralViewed();

    /**
     * Unique visitor id for every user.
     *
     * @return string
     */
    public function getVisitorId();

    /**
     * Visitable name for every object/entity.
     *
     * @return string
     */
    public function getVisitable();

    /**
     * Increase the number of singular views.
     *
     * @return int
     */
    public function onSingularViewed();

    /**
     * Increase the number of plural views.
     *
     * @return int
     */
    public function onPluralViewed();

    /**
     * Increase the number of unique views.
     *
     * @return $this
     */
    public function onUniqueViewed();
}
