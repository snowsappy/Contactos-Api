<?php

test('example', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

it('obtener contactos', function () {

    $this->getJson('/api/v1/contactos/general')->assertOk();
});

it('obtener contactos por usuario', function () {

    $this->getJson('/api/v1/contactos')->assertStatus(401);

});

it('creamos contactos', function () {

    $this->postJson('/api/v1/contactos', ['nombre' => 'linda',
        'apellido' => 'atencio',
        'email' => 'linda@gmail.com',
        'numero' => '1234567890',
    ])->assertStatus(401);
});

it('eliminamos el contacto', function () {

    $this->deleteJson('/api/v1/contactos/{id}', ['id' => 5])->assertStatus(401);

});

it('editamos el contacto', function () {

    $this->patchJson('/api/v1/contactos/{id}', ['id' => 5])->assertStatus(401);

});
