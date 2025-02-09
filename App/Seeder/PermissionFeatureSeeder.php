<?php
namespace App\Seeder;
require_once __DIR__ . '/../Models/PermissionFeature.php';
use App\Models\PermissionFeature;
class PermissionFeatureSeeder
{
  public function run()
  {
    $permission_features = [
      ['permission_id' => 1, 'feature_id' => 1],
      ['permission_id' => 2, 'feature_id' => 1],
      ['permission_id' => 3, 'feature_id' => 1],
      ['permission_id' => 4, 'feature_id' => 1]
    ];
    foreach ($permission_features as $new_permission_feature) {
      $permission_feature = new PermissionFeature();
      $permission_feature->permission_id = $new_permission_feature['permission_id'];
      $permission_feature->feature_id = $new_permission_feature['feature_id'];
      $permission_feature->save();
    }
  }
}