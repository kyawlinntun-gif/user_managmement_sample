<?php
namespace App\Seeder;
require_once __DIR__ . '/../Models/Feature.php';
use App\Models\Feature;
class FeatureSeeder
{
  public function run()
  {
    $features = [
      ['feature_name' => 'manage user', 'description' => 'can make create, read, update, delete for user'],
      ['feature_name' => 'manage post', 'description' => 'can make create, read, update, delete for post']
    ];
    foreach($features as $new_feature) {
      $feature = new Feature();
      $feature->feature_name = $new_feature['feature_name'];
      $feature->description = $new_feature['description'];
      $feature->save();
    }
  }
}