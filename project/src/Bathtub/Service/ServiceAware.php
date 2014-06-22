<?php

namespace Bathtub\Service;

interface ServiceAware
{
    public function setShared($name, $definition);
}
