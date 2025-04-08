<?php

test('test_postgresql_connection_works', function () {
    $result = \Illuminate\Support\Facades\DB::select("SELECT version()");
    expect($result)->not->toBeEmpty()
        ->and($result[0]->version)->toContain('PostgreSQL');
});
