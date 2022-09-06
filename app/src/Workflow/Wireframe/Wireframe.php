<?php

namespace App\Workflow\Wireframe;

use App\Workflow\Entity\WireframeEntity as Entity;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Workflow\Registry;
use Symfony\Component\Workflow\StateMachine;

class Wireframe implements WireframeInterface
{
    const SES_KEY_PREF = __CLASS__;

    private SessionInterface $session;

    public function __construct(
        private Registry $workflows,
        RequestStack $requestStack,
        private $name,
    ) {
        $this->session = $requestStack->getSession();
    }

    public function getEntity(): Entity
    {
        return $this->session->get(static::SES_KEY_PREF . $this->name) ?: new Entity();
    }

    public function setEntity($entity)
    {
        $this->session->set(static::SES_KEY_PREF . $this->name, $entity);
    }

    public function isValid($to)
    {
        $entity = $this->getEntity($this->name);
        $sm = $this->workflows->get($entity, $this->name);
        return $sm->can($entity, $to);
    }

    public function update($to)
    {
        $entity = $this->getEntity($this->name);
        $sm = $this->workflows->get($entity, $this->name);
        $sm->apply($entity, $to);
        $this->setEntity($entity);
    }

    public function reset()
    {
        $this->setEntity(new Entity());
    }
}
