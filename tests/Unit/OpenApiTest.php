<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(Tests\TestCase::class, RefreshDatabase::class);

test('foi criada a rota de ui', function () {
    $response = $this->get("/api/ui/");
    $response->assertStatus(200);
});
