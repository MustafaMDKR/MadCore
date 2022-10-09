<?php

declare(strict_types=1);

namespace Mad\Traits;

use Mad\Base\Exception\BaseLogicException;
use Mad\GlobalManager\GlobalManager;
use Mad\Session\SessionManager;

trait SystemTrait
{

    public static function sessionInit(bool $useSessionGlobal = false)
    {
        $session = SessionManager::intialize();

        if (!$session) {
            throw new BaseLogicException('Please enable session within your session.yaml configuration file.');
        } else if ($useSessionGlobal === true) {
            GlobalManager::set('global_session', $session);
        } else {
            return $session;
        }

    }
}