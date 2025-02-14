<?php

declare(strict_types=1);

namespace PhpMyAdmin\Middleware;

use PhpMyAdmin\Config;
use PhpMyAdmin\Core;
use PhpMyAdmin\Theme\ThemeManager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class UserPreferencesLoading implements MiddlewareInterface
{
    public function __construct(private readonly Config $config)
    {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        /** @var ThemeManager $themeManager */
        $themeManager = Core::getContainerBuilder()->get(ThemeManager::class);
        $this->config->loadUserPreferences($themeManager);

        return $handler->handle($request);
    }
}
