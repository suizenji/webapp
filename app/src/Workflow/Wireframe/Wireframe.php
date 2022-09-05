<?php

namespace App\Workflow\Wireframe;

use App\Workflow\Entity\WireframeEntity as Entity;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Workflow\Registry;
use Symfony\Component\Workflow\StateMachine;

class Wireframe implements WireframeInterface
{
    const SES_KEY_PREF = __CLASS__;

    public function __construct(
        private Registry $workflows,
        RequestStack $requestStack,
    ) {
        $this->session = $requestStack->getSession();
    }

    public function getEntity($name): Entity
    {
        return $this->session->get(static::SES_KEY_PREF . $name) ?: new Entity();
    }

    public function setEntity($name, $entity)
    {
        $this->session->set(static::SES_KEY_PREF . $name, $entity);
    }

    public function isValid($name, $to)
    {
        $entity = $this->getEntity($name);
        $sm = $this->workflows->get($entity, $name);
        return $sm->can($entity, $to);
    }

    public function update($name, $to)
    {
        $entity = $this->getEntity($name);
        $sm = $this->workflows->get($entity, $name);
        $sm->apply($entity, $to);
        $this->setEntity($name, $entity);
    }

    public function reset($name)
    {
        $this->setEntity($name, new Entity());
    }
}
