<?php
/**
 * ViewsCounter.
 *
 * (c) 2017 Cengizhan Çalışkan <cengizhancaliskan@gmail.com>
 *
 * This file is part of ViewsCount Bundle.
 */

namespace Cengizhan\ViewsCounterBundle\Manager;

use Cengizhan\ViewsCounterBundle\Model\ViewsCounterInterface;
use Cengizhan\ViewsCounterBundle\Model\VisitableInterface;
use Cengizhan\ViewsCounterBundle\Model\VisitableManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ViewsCounter implements ViewsCounterInterface
{
    const SESSION_KEY = '_views_counter';

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var VisitableManagerInterface
     */
    private $visitableManager;

    /**
     * @param SessionInterface          $session
     * @param VisitableManagerInterface $visitableManager
     */
    public function __construct(SessionInterface $session, VisitableManagerInterface $visitableManager)
    {
        $this->session          = $session;
        $this->visitableManager = $visitableManager;
    }

    /**
     * {@inheritdoc}
     */
    public function count(VisitableInterface $visitable)
    {
        $viewsSession = $this->session->get(self::SESSION_KEY);

        if (null === $viewsSession) { // unique view
            $viewsSession = [];
            $this->saveVisitable($viewsSession, $visitable);

            $visitable->onUniqueViewed();
        } elseif (!isset($viewsSession[$visitable->getVisitable()][$visitable->getVisitorId()])) { // unique view
            $this->saveVisitable($viewsSession, $visitable);

            $visitable->onUniqueViewed();
        } elseif (isset($viewsSession[$visitable->getVisitable()][$visitable->getVisitorId()])) { // plural view
            $visitable->onPluralViewed();
        }

        $this->visitableManager->update($visitable);
    }

    /**
     * @param array              $viewsSession
     * @param VisitableInterface $visitable
     */
    private function saveVisitable(array $viewsSession, $visitable)
    {
        $viewsSession[$visitable->getVisitable()] = [];

        $this->saveVisitorId($viewsSession, $visitable);
    }

    /**
     * @param array              $viewsSession
     * @param VisitableInterface $visitable
     */
    private function saveVisitorId(array $viewsSession, $visitable)
    {
        $viewsSession[$visitable->getVisitable()][$visitable->getVisitorId()] = $visitable->getVisitorId();

        $this->session->set(self::SESSION_KEY, $viewsSession);
    }
}
