<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
   public function test_login_form(){

       $response = $this->get('/login');

       $response->assertStatus(200);
   }

   public function test_user_duplication(){
       $user1 = User::make([
           'name' => 'John Doe',
           'email' => 'johndoe@gmail.com',
       ]);

       $user2 = User::make([
        'name' => 'Sen Sen',
        'email' => 'sensen@gmail.com',
    ]);


  return  $this->assertTrue($user1->name != $user2->normalizer_is_normalized);

   }

   public function test_user_delete(){
       $user = User::factory()->count(1)->make();

       $user = User::first();

       if($user){
           $user->delete();
       }

       $this->assertTrue(true);
   }

   public function test_if_store_new_user(){
       $response = $this->post('/register',[
           'name' => 'Lorna Gayle',
           'email' => 'lornagayle@gmail.com',
           'password' => 'lorna1234',
           'password_confirmation' => 'lorna1234'
       ]);

       $response->assertRedirect('/home');
   }

   public function test_database(){

    $this->assertDatabaseHas('users',[
        'name' => 'Lorna Gayle'
    ]);

}


public function test_if_database_missing(){

    $this->assertDatabaseMissing('users',[
        'name' => 'Lorna Gayle'
    ]);

}


public function test_if_seeders_works(){

    //Test if allseeders in seeders works
    $this->seed();
    
}


}
