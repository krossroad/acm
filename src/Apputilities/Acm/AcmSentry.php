<?php

namespace Apputilities\Acm;

use Apputilities\Acm\AcmGroupProviderInteface as AcmGroupProvider;
use Apputilities\Acm\AcmPermissionProviderInteface as AcmPermissionProvider;

/**
 * @author Rikesh <rikesh.shrestha.npl@gmail.com>
 **/
class AcmSentry
{
    /**
     * @var AcmProviderInterface
     */
    protected $acmProvider;

    public function __construct()
    {
    }

    /**
     * @param AcmProviderInterface $acmProvider
     */
    public function setAcmProvider(AcmProviderInterface $acmProvider)
    {
        $this->acmProvider = $acmProvider;

        return $this;
    }

    /**
     * @param  mixed  $pemission
     * @param  mixded  $group
     * @return boolean
     */
    public function hasAccess($permission, AcmProviderInterface $user = null)
    {
        if (is_null($user) and is_null($this->acmProvider)) {
            throw new \Exception("User not set for Permission Checking");
        } else if (is_null($user)) {
            $user = $this->acmProvider;
        }

        $flag = true;
        $userPermissions = $this->fetchUserPermission($user);
        $permissionKeys = (array) $this->parsePermissions($permission);

        foreach ($permissionKeys as $key) {
            if (! isset($userPermissions[$key])) {
                $flag = false;
                break;
            }
        }

        return $flag;
    }

    /**
     * @param  array   $permissions
     * @param  AcmProviderInterface  $user
     * @return boolean
     */
    public function hasEitherOfPermission(array $permissions, AcmProviderInterface $user = null)
    {
        if (is_null($user) and is_null($this->acmProvider)) {
            throw new \Exception("User not set for Permission Checking");
        } else if (is_null($user)) {
            $user = $this->acmProvider;
        }

        $flag = false;
        $userPermissions = $this->fetchUserPermission($user);
        $permissionKeys = (array) $this->parsePermissions($permission);

        foreach ($permissionKeys as $key) {
            if (isset($userPermissions[$key])) {
                $flag = true;
                break;
            }
        }

        return $flag;
    }

    /**
     * @param  AcmProviderInterface $user
     * @return array
     */
    protected function fetchUserPermission(AcmProviderInterface $user)
    {
        // @todo: your logic
        $userGroup = $user->getGroup();
        $permissions = null;

        if ($userGroup) {
            $permissions = $userGroup->hydrateGroupPermissions();
        }

        return $permissions;
    }

    /**
     * @param  mixed $permissions
     * @return array
     */
    protected function parsePermissions($permissions)
    {
        if (is_null($permissions)) {
            throw new \Exception("Invalid Permission supplied for checking");
        }

        /**
         * @todo For time-being do nothing
         * in future what should be structure of
         * input permissions
         */
        if (! is_array($permissions)) {
            $permissions = (array) $permissions;
        }

        return $permissions;
    }
}
// END class AcmSentry
