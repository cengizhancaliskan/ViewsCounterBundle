<?php
/**
 * VisitableManagerInterface.
 *
 * (c) 2017 Cengizhan Çalışkan <cengizhancaliskan@gmail.com>
 *
 * This file is part of ViewsCount Bundle.
 */

namespace Cengizhan\ViewsCounterBundle\Model;

interface VisitableManagerInterface
{
    /**
     * Update views of the visitable object/entity.
     *
     * @param VisitableInterface $visitable
     */
    public function update(VisitableInterface $visitable);
}
