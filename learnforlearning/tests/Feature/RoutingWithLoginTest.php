<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\Models\User;

class RoutingWithLoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_new_subject(){
        $user = new User(array('name' => 'John'));
        $this->be($user);
        $response = $this->get('/newsubject');
        $response->assertStatus(200);
        $response->assertSeeInOrder(["Új érdemjegyek felvétele","Eddig felvett eredmények:"]);
    }

    public function test_calculation(){
        $user = new User(array('name' => 'John'));
        $this->be($user);
        $response = $this->get('/findsubject');
        $response->assertStatus(200);
        $response->assertSeeInOrder(["A számodra még elérhető kötelezően választható tárgyak","A számodra korábban kalkulált kurzusok", "Aktuális félév:"]);
    }

    public function test_manage(){
        $this->withoutMiddleware();
        $user = new User(array('name' => 'John'));
        $this->be($user);
        $response = $this->get('/manage');
        $response->assertStatus(200);
        $response->assertSeeInOrder(["Javaslatok kezelése",
                                     "Egy, már meglévő oktató aktivitásának változása","Új oktató ajánlása","Új kurzus ajánlása"]);
    }
}
