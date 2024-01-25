<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;
use App\Models\User;

class ProductTest extends TestCase
{
  use RefreshDatabase;

  
 
  public function test_product_creation_in_database()
  {
    $user = User::find(1);
    $this->actingAs($user);
      $formData = [
          'name' => 'Product1',
          'description' => 'desc1',
          'price' => 500,
          'quantity' => 4,
          'category_id' => 1,
      ];
      //$this->withoutExceptionHandling();
      $this->json('POST',route('store'),$formData)
      ->assertStatus(201)
      ->assertJson([
          'success'=>true,
          'message'=>'Product added successfully',
          'data'=>$formData]);
  }

  public function test_products_store_validation_error_in_database()
  {
        
        $user = User::find(1);
        $this->actingAs($user);



      $formData = [
          'description' => 'desc1',
          'price' => 500,
          'quantity' => 4,
          'category' => 1,
      ];
      //$this->withoutExceptionHandling();
      $this->json('POST',route('store',$formData))
      ->assertStatus(400)
      ->assertJson([
          'success'=>false,
          'message'=>"There exist one or more errors",
          'data'=>["name"=>["The name field is required."]],
      ]);
  }


 
}
