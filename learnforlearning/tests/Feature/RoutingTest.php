<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class RoutingTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_main(){
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSeeInOrder(["Üdvözöllek","Az alkalmazást használó felhasználók száma:",
                                     "A felhasznált adatok mennyisége:","A felhasználók szerinti jelenlegi legjobb oktató:"]);
    }

    public function test_subjects(){
        $response = $this->get('/subjects');
        $response->assertStatus(200);
        $response->assertSeeInOrder(["Kurzusok","Keress tárgyra:"]);

        $response = $this->post('/subjects/filter', ['text' => '']);
        $response->assertStatus(200);
        $this->assertTrue(count($response->baseResponse->original)==90);

        $response = $this->post('/subjects/filter', ['text' => 'Adatbázisok 1']);
        $response->assertStatus(200);
        $this->assertTrue(count($response->baseResponse->original)==2);

        $response = $this->get('/subjects/1');
        $response->assertStatus(200);
        $response->assertSeeInOrder(["Adatbázisok 1 Ea","Kreditérték","Ezeken a szakirányokon érhető el:","Oktatók"]);
    }

    public function test_fixables(){
        $response = $this->get('/fixable');
        $response->assertStatus(200);
        $response->assertSeeInOrder(["Javítási észrevételek küldése",
                                     "Egy, már meglévő oktató aktivitásának változása","Új oktató ajánlása","Új kurzus ajánlása"]);
    }

    public function test_fail_on_middleware(){
        $response = $this->get('/manage');
        $response->assertStatus(403);
    }

    public function test_new_subject(){
        $response = $this->get('/newsubject');
        $response->assertStatus(302);
        $response->assertSeeInOrder(["login","Redirecting"]);
    }

    public function test_calculation(){
        $response = $this->get('/findsubject');
        $response->assertStatus(302);
        $response->assertSeeInOrder(["login","Redirecting"]);
    }

    public function test_personal(){
        $response = $this->get('/personal');
        $response->assertStatus(302);
        $response->assertSeeInOrder(["login","Redirecting"]);
    }

    public function test_comments(){
        $response = $this->get('/subject/1/comments');
        $response->assertStatus(200);
        $response->assertSeeInOrder(["Beérkezett megjegyzések","A következő oktatóról:"]);
    }

    public function test_offline(){
        $response = $this->get('/offline');
        $response->assertStatus(200);
        $response->assertSee("Az internetkapcsolatával problémák akadtak, kérjük térjen vissza később!");
    }
}
