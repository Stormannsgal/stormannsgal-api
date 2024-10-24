<?php declare(strict_types=1);

namespace Stormannsgal\Core\Config;

interface Route
{
    public const string PING = 'handler.ping';

    public const string CREATE_ACCOUNT = 'account.create';

    public const string LIST_ALL_ACCOUNT = 'account.list.all';

    public const string AUTHENTICATE_ACCOUNT = 'account.authenticate';

    public const string REFRESH_ACCESS_TOKEN = 'refresh.access.token';
}
