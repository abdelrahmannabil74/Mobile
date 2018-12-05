<?php

namespace Tests\Feature\Mobile;

use App\Mobile;
use App\Transformers\MobileTransformer;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateMobileTest extends TestCase
{
    /**
     * @test
     */
    function a_user_can_create_mobile()
    {
             $user= factory(User::class)->create();

             $this->actingAs($user);

             $mobileData=factory(Mobile::class)->make()->toArray();

             $response=$this->post(route('CreateMobile'),$mobileData);

             $response->assertStatus(201);

             $mobileData['user_id'] = $user->id;

             $this->assertDatabaseHas('mobiles',$mobileData);

             $mobileInDB = Mobile::all()->last();

        $response->assertJson(\Fractal::item($mobileInDB, new MobileTransformer())->toArray());

    }

    /**
     * @test
     */

       function a_guest_cant_create_mobile()
       {
           $mobileData=factory(Mobile::class)->make()->toArray();

           $response=$this->post(route('CreateMobile'),$mobileData);

           $response->assertStatus(401);

           $response->assertJson(['errors' => 'Forbidden!']);

       }

}
