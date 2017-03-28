<?php
/**
 * VisitableManager.
 *
 * (c) 2017 Cengizhan Çalışkan <cengizhancaliskan@gmail.com>
 *
 * This file is part of ViewsCount Bundle.
 */

namespace Cengizhan\ViewsCounterBundle\Manager;

use Cengizhan\ViewsCounterBundle\Model\VisitableInterface;
use Cengizhan\ViewsCounterBundle\Model\VisitableManagerInterface;
use Doctrine\ORM\EntityManagerInterface;

class VisitableManager implements VisitableManagerInterface
{
    private $em;

    /**
     * VisitableManager constructor.
     *
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * {@inheritdoc}
     */
    public function update(VisitableInterface $visitable)
    {
        $qb = $this->em->createQueryBuilder();

        $qb->update(get_class($visitable), 'o')
            ->where('o.id = :id')
            ->setParameter('id', $visitable->getId())
        ;

        if (true === $visitable->isSingularViewed()) {
            $key    = sprintf('o.%s', $visitable::SINGULAR_VIEW_FIELD);
            $value  = sprintf('%s + 1', $key);

            $qb->set($key, $value);
        }

        if (true === $visitable->isPluralViewed()) {
            $key    = sprintf('o.%s', $visitable::PLURAL_VIEW_FIELD);
            $value  = sprintf('%s + 1', $key);

            $qb->set($key, $value);
        }

        $qb->getQuery()->execute();
    }
}
