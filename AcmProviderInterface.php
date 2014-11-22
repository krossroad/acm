<?php

namespace Apputilities\Acm;

/**
 * @author Rikesh <rikesh.shrestha.npl@gmail.com>
 */
interface AcmProviderInterface
{
    /**
     * @return Apputilities\Acm\AcmGroupProviderInterface
     */
    public function getGroup();

    /**
     * @return string
     */
    public function getAcmDriver();
}
// END interface AcmProviderInterface
