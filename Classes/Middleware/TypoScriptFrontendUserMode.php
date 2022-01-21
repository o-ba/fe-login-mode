<?php

declare(strict_types=1);

/*
 * This file is part of TYPO3 CMS-based extension "fe_login_mode".
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 */

namespace Bo\FeLoginMode\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;

/**
 * Middleware, which temporarily disables a logged in frontend user in case a
 * corresponding frontend user login mode is set in the rootline. After generating
 * the PSR-7 response, such user is reset to keep the cookie (and the session).
 */
class TypoScriptFrontendUserMode implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        // Check for the frontend controller
        if (!($controller = $request->getAttribute('frontend.controller'))) {
            return $handler->handle($request);
        }

        // Initialize the context and store the current user array and the assigned user groups
        $context = $controller->getContext();
        $userArray = $controller->fe_user->user;
        $userGroups = $controller->fe_user->userGroups;

        // Check whether login is allowed in the rootline and fetch a possible login mode
        [$loginAllowed, $loginMode] = $this->getLoginModeDetails($controller);

        // In case login is disallowed and a user or group is set, disable the
        // group - for login mode "all" also the user - and update aspect and request.
        if (!$loginAllowed && $context->getAspect('frontend.user')->isUserOrGroupSet()) {
            if ($loginMode === 'all') {
                $controller->fe_user->user = null;
            }
            $controller->fe_user->userGroups = [];
            $userAspect = $controller->fe_user->createUserAspect(false);
            $context->setAspect('frontend.user', $userAspect);
            $request = $request->withAttribute('frontend.user', $controller->fe_user);

            // Call determineId() with the updated request again
            $controller->determineId($request);
        }

        $response = $handler->handle($request);

        // In case login is disallowed and a user or group is set, restore the
        // group - for login mode "all" also the user - and update the aspect.
        if (!$loginAllowed) {
            if ($loginMode === 'all') {
                $controller->fe_user->user = $userArray;
            }
            $controller->fe_user->userGroups = $userGroups;
            $userAspect = $controller->fe_user->createUserAspect();
            $controller->getContext()->setAspect('frontend.user', $userAspect);
        }

        // In case cache headers should be sent, but only when login is currently denied,
        // check the login status again and if allowed, remove possible cache headers.
        if (($controller->config['config']['sendCacheHeaders'] ?? false)
            && ($controller->config['config']['sendCacheHeaders_onlyWhenLoginDeniedInBranch'] ?? false)
            && $loginAllowed
        ) {
            $response = $response
                ->withHeader('Cache-Control', 'private, no-store')
                ->withoutHeader('Pragma')
                ->withoutHeader('ETag')
                ->withoutHeader('Expires');
        }

        return $response;
    }

    /**
     * Check for defined login modes in the current rootline
     */
    protected function getLoginModeDetails(TypoScriptFrontendController $controller): array
    {
        $loginAllowed = true;
        $loginMode = '';

        // Traverse root line from root and outwards:
        foreach (array_reverse($controller->rootLine) as $page) {
            // If a value is set for login mode:
            if ($page['fe_login_mode'] ?? false) {
                // Determine state:
                if ((int)$page['fe_login_mode'] === 1) {
                    $loginAllowed = false;
                    $loginMode = 'all';
                } elseif ((int)$page['fe_login_mode'] === 3) {
                    $loginAllowed = false;
                    $loginMode = 'groups';
                } else {
                    $loginAllowed = true;
                }
            }
        }

        return [$loginAllowed, $loginMode];
    }
}
