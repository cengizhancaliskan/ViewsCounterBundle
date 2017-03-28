<?php
/**
 * ViewCounterInterface.
 *
 * (c) 2017 Cengizhan Çalışkan <cengizhancaliskan@gmail.com>
 *
 * This file is part of ViewsCount Bundle.
 */

namespace Cengizhan\ViewsCounterBundle\Model;

interface ViewsCounterInterface
{
    /**
     * Count singular and plural views and update the document/entity.
     *
     * @param VisitableInterface $visitable
     */
    public function count(VisitableInterface $visitable);
}
