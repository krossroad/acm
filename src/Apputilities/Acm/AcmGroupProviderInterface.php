<?php

namespace Apputilities\Acm;

/**
 * @package Apputilities\Acm
 * @author
 **/
interface AcmGroupProviderInterface
{
    /**
     * @return string
     */
    public function getGroupName();

    /**
     * @return array
     */
    public function hydrateGroupPermissions();
}
// END interface AcmGroupProviderInterface
