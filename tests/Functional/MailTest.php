<?php
namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
class MailTest extends WebTestCase 
{     
public function testMailEnvoi(): void    
{       
				$client = static::createClient();        
				$client->request('GET', '/send-mail');
        $this->assertResponseIsSuccessful();        
				$this->assertEmailCount(1);     
}}