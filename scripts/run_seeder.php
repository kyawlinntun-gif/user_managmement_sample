<?php
require_once __DIR__ . '/../App/Core/Database.php';
require_once __DIR__ . '/../App/Seeder/AdminUserSeeder.php';
require_once __DIR__ . '/../App/Seeder/RoleSeeder.php';
require_once __DIR__ . '/../App/Seeder/PermissionSeeder.php';
require_once __DIR__ . '/../App/Seeder/FeatureSeeder.php';
require_once __DIR__ . '/../App/Seeder/RolePermissionSeeder.php';
require_once __DIR__ . '/../App/Seeder/ProductSeeder.php';
use App\Core\Database;
use App\Seeder\FeatureSeeder;
use App\Seeder\PermissionSeeder;
use App\Seeder\ProductSeeder;
use App\Seeder\RolePermissionSeeder;
use App\Seeder\RoleSeeder;
use App\Seeder\AdminUserSeeder;
// Run the seeder
$database = new Database();
$db = $database->getConnection();
$roleSeeder = new RoleSeeder();
$roleSeeder->run();
$adminUserSeeder = new AdminUserSeeder();
$adminUserSeeder->run();
$featureSeeder = new FeatureSeeder();
$featureSeeder->run();
$permissionSeeder = new PermissionSeeder();
$permissionSeeder->run();
$rolePermissionSeeder = new RolePermissionSeeder();
$rolePermissionSeeder->run();
$productSeeder = new ProductSeeder();
$productSeeder->run();