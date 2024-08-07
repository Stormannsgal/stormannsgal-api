<?php declare(strict_types=1);

namespace Stormannsgal\FunctionalTest\Root;

use Fig\Http\Message\StatusCodeInterface;
use Laminas\Diactoros\ServerRequest;
use Stormannsgal\FunctionalTest\FunctionalTestCase;

use function time;

class PingTest extends FunctionalTestCase
{
    public function testDispatchRequest(): void
    {
        $request = new ServerRequest(uri: '/api/ping', method: 'GET');

        $response = $this->app->dispatchRequest($request);

        self::assertSame(StatusCodeInterface::STATUS_OK, $response->getStatusCode());
        self::assertJsonValueMatches(
            self::getContentAsJson($response),
            '$.ack',
            self::greaterThanOrEqual(time())
        );
    }
}
