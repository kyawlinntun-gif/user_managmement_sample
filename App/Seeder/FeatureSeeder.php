<?php
namespace App\Seeder;
require_once __DIR__ . '/../Models/Feature.php';
use App\Models\Feature;
class FeatureSeeder
{
  public function run()
  {
    $features = [
      ['name' => 'user'],
      ['name' => 'role'],
      ['name' => 'product'],
      ['name' => 'permissions'],
      ['name' => 'features'],
    ];
    foreach($features as $new_feature) {
      $feature = new Feature();
      $feature->name = $new_feature['name'];
      $feature->save();
    }
  }
}