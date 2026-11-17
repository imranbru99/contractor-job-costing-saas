<?php

namespace Tests\Feature;

use App\Models\ModuleSetting;
use App\Services\ModuleManager;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModuleToggleTest extends TestCase
{
    use RefreshDatabase;

    public function test_modules_can_be_toggled(): void
    {
        $manager = app(ModuleManager::class);
        $manager->toggle('labor', false);

        $this->assertFalse($manager->enabled('labor'));
        $this->assertDatabaseHas('module_settings', ['key' => 'labor', 'enabled' => 0]);
    }
}