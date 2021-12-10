<?php
namespace Tests\unit;

use \PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class addNewTaskTest extends TestCase {
    public $client;

    public function setUp(): void{
        $this->client = new Client([
            'base_uri' => '192.168.1.100:5001',
            'timeout'  => 3.0,
        ]);
    }

    public function test_add_new_task(){
        $data = [
            'user_id' => 3,
            'category_id' => 1,
            'content' => "test",
            'priority_id' => 1,
        ];
        
        $response = $this->client->request('POST', '/tasks/add', ['form_params' => $data]);

        $result = json_decode((string)$response->getBody());
        
        $this->assertNotNull($result);
        $this->assertTrue( ($result)? $result->status : false );
    }
}

?>