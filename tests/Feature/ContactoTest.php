<?php

use App\Models\Contacto;
use GuzzleHttp\Promise\Create;


use function Pest\Laravel\get;
test('example', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

it('obtener contactos',function(){

    $this->getJson('api/v1/contactos/general')->assertOk();


});

/*it('crear contactos',function(){

    $this->postJson('/api/v1/contactos',[
        'nombre'=>'linda',
        'apellido'=>'mariana',
        'foto'=>fake()->imageUrl(),
        'email'=>'email@gmail.com',
        'telefono'=>'3444343434',
    ])->assertCreated();
});*/
/*it('eliminar contactos',function(){

    $this->deleteJson('/api/contactos')->assertOk();

});*/


