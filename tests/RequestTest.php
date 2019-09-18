<?php

use Astronphp\Http\Request;
use Astronphp\Http\Response;
use Astronphp\Collection\Collection;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase {
    private $request;

    public function setUp() {
        $_GET['username'] = 'astronphp';
        $_POST['password'] = 'astronphp';
        $_FILES['picture'] = 'astronphp';
        $_SERVER['REQUEST_URI'] = 'astronphp';
        $_SERVER['HTTP_CONTENT_TYPE'] = 'astronphp';

        $this->request = new Request('https://reqres.in/api'); // open api
    }

    public function test_Should_RetrieveGetData() {
        $username = $this->request->query('username');
        $this->assertEquals('astronphp', $username);
    }

    public function test_Should_RetrievePostData() {
        $username = $this->request->body('password');
        $this->assertEquals('astronphp', $username);
    }

    public function test_Should_RetrieveFilesData() {
        $picture = $this->request->files('picture');
        $this->assertEquals('astronphp', $picture);
    }

    public function test_Should_RetrieveServerData() {
        $uri = $this->request->server('request_uri');
        $this->assertEquals('astronphp', $uri);
    }

    public function test_Should_RetrieveHeaderData() {
        $uri = $this->request->header('content_type');
        $this->assertEquals('astronphp', $uri);
    }

    public function test_Should_ReturnResponse_When_MakingAnyRequest() {
        $response = $this->request->get('/users');
        $this->assertInstanceOf(Response::class, $response);
    }

    public function test_Should_ReturnCollection_When_GettingDataFromResponse() {
        $response = $this->request->get('/users/1');
        $this->assertInstanceOf(Collection::class, $response->get());
    }

    public function test_Should_ReturnData_When_MakingGetRequest() {
        $expect = new Collection([
            'data' => [
                'id' => 1,
                'email' => 'george.bluth@reqres.in',
                'first_name' => 'George',
                'last_name' => 'Bluth',
                'avatar' => 'https://s3.amazonaws.com/uifaces/faces/twitter/calebogden/128.jpg'
            ]
        ]);
        $response = $this->request->get('/users/1');
        $this->assertEquals($expect, $response->get());
        $this->assertEquals(200, $response->getHttpCode());
    }

    public function test_Should_ReturnData_When_MakingPostRequest() {
        $response = $this->request->post('/users');
        $this->assertNotEmpty($response->get('id'));
        $this->assertEquals(201, $response->getHttpCode());
    }

    public function test_Should_ReturnData_When_MakingPutRequest() {
        $response = $this->request->put('/users/1');
        $this->assertNotEmpty($response->get('updatedAt'));
        $this->assertEquals(200, $response->getHttpCode());
    }

    public function test_Should_ReturnData_When_MakingPatchRequest() {
        $response = $this->request->patch('/users/1');
        $this->assertNotEmpty($response->get('updatedAt'));
        $this->assertEquals(200, $response->getHttpCode());
    }

    public function test_Should_ReturnData_When_MakingDeleteRequest() {
        $response = $this->request->delete('/users/1');
        $this->assertEquals(204, $response->getHttpCode());
    }

    public function test_Should_BuildUrl_When_MakingGetRequestWithUrlParameters() {
        $this->request->set('id', 1);
        $response = $this->request->get('/users/{id}');
        $this->assertEquals('https://reqres.in/api/users/1', $response->getUrl());
    }

    public function test_Should_BuildUrl_When_MakingGetRequestWithQueryParameters() {
        $this->request->set('page', 1);
        $response = $this->request->get('/users');
        $this->assertEquals('https://reqres.in/api/users?page=1', $response->getUrl());
    }

    public function test_Should_BuildUrl_When_MakingGetRequestWithArrayOfParameters() {
        $this->request->set(['page' => 1, 'order' => 'asc']);
        $response = $this->request->get('/users');
        $this->assertEquals('https://reqres.in/api/users?page=1&order=asc', $response->getUrl());
    }
}