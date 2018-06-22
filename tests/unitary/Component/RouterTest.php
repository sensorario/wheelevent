<?php

use Component\Router;
use Objects\Config;
use Response\ClientError;

class RouterTest extends PHPUnit\Framework\TestCase
{
    public function testShouldReturnAlways404WheneverRoutesAreNotDefined()
    {
        $this->request = $this
            ->getMockBuilder('Request\Request')
            ->disableOriginalConstructor()
            ->getMock();

        $this->config = $this
            ->getMockBuilder('Objects\Config')
            ->disableOriginalConstructor()
            ->getMock();
        $this->config->expects($this->once())
            ->method('getRoutes')
            ->willReturn($routes = []);

        $router = new Router(
            $this->config
        );

        $response = $router->controller($this->request);

        $this->assertEquals(
            new ClientError(404),
            $response
        );
    }

    public function testShouldReturn403WheneverRouteExistsButSecurityDoesNotAllow()
    {
        $this->request = $this
            ->getMockBuilder('Request\Request')
            ->disableOriginalConstructor()
            ->getMock();
        $this->request->expects($this->once())
            ->method('getUri')
            ->willReturn('/foo/bar');

        $this->config = $this
            ->getMockBuilder('Objects\Config')
            ->disableOriginalConstructor()
            ->getMock();
        $this->config->expects($this->once())
            ->method('getRoutes')
            ->willReturn($routes = [

                [
                    'path' => '/foo/bar'
                ]

            ]);

        $this->security = $this
            ->getMockBuilder('Component\Security')
            ->disableOriginalConstructor()
            ->getMock();
        $this->security->expects($this->once())
            ->method('allow')
            ->willReturn(false);

        $router = new Router(
            $this->config
        );

        $router->protectRouteWith($this->security);
        $response = $router->controller($this->request);

        $this->assertEquals(
            new ClientError(403),
            $response
        );
    }

    public function testShouldReturn200WheneverRequestIsValid()
    {
        $this->request = $this
            ->getMockBuilder('Request\Request')
            ->disableOriginalConstructor()
            ->getMock();
        $this->request->expects($this->once())
            ->method('getUri')
            ->willReturn('/foo/bar');
        $this->request->expects($this->once())
            ->method('getMethod')
            ->willReturn('get');

        $this->config = $this
            ->getMockBuilder('Objects\Config')
            ->disableOriginalConstructor()
            ->getMock();
        $this->config->expects($this->once())
            ->method('getRoutes')
            ->willReturn($routes = [

                [
                    'path' => '/foo/bar',
                    'controller' => Controller\SampleController::class
                ]

            ]);

        $this->security = $this
            ->getMockBuilder('Component\Security')
            ->disableOriginalConstructor()
            ->getMock();
        $this->security->expects($this->once())
            ->method('allow')
            ->willReturn(true);

        $router = new Router(
            $this->config
        );

        $router->protectRouteWith($this->security);
        $response = $router->controller($this->request);

        $this->assertEquals(
            42,
            $response
        );
    }
}
