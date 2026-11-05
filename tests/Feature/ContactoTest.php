<?php

use App\Models\Contacto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Usuario;

use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->usuario=Usuario::create( [
        'nombre'=>'linda',
        'apellido'=>'atencio',
        
        'email' => 'linda@gmail.com',
        'password' => hash::make('linda123'),
       
    ]);
});


function loginData(array $cambios = []): array
{
    return array_merge([
        'email' => 'linda@gmail.com',
        'password' => 'linda123',
        'device_name' => 'telefono',
    ], $cambios);
}

it('inicio de sesion incorrecto', function () {
    $this->postJson('/api/v1/login', [
        'email' => 'linda@gmail.com',
        'password' => 'incorrecta',
        'device_name' => 'telefono'
    ])->assertStatus(401);
});
it('inicio de sesion correcto', function () {
    $this->postJson('/api/v1/login', loginData())
        ->assertStatus(200);
});

it('obtener contactos', function () {

    $this->getJson('/api/v1/contactos/general')->assertStatus(200);
});

it('obtener contactos por usuario', function () {

    Sanctum::actingAs($this->usuario);

    $this->usuario->contactos()->create([
        'nombre'=>'linda',
        'apellido'=>'atencio',
        'email'=>'linda@gmail.com',
        'telefono'=>'345045540',
        'foto'=>'https://img.magnific.com/foto-gratis/joven-hombre-guapo-camiseta-informal-sobre-fondo-azul-cara-feliz-sonriendo-brazos-cruzados-mirando-camara-persona-positiva_839833-12963.jpg?semt=ais_hybrid&w=740&q=80'
       
    ]);
    $this->getJson('/api/v1/contactos')->assertStatus(200);

});

it('creamos contactos', function () {

    $this->postJson('api/v1/contactos ', ['nombre' => 'linda',
        'apellido' => 'atencio',
        'email' => 'linda@gmail.com',
        'numero' => '1234567890',
    ])->assertStatus(201);
});

it('eliminamos el contacto', function () {
    Sanctum::actingAs($this->usuario);

    $contacto=$this->usuario->contactos()->create([
        'nombre'=>'linda',
        'apellido'=>'atencio',
        'email'=>'linda@gmail.com',
        'telefono'=>'345045540',
        'foto'=>'https://img.magnific.com/foto-gratis/joven-hombre-guapo-camiseta-informal-sobre-fondo-azul-cara-feliz-sonriendo-brazos-cruzados-mirando-camara-persona-positiva_839833-12963.jpg?semt=ais_hybrid&w=740&q=80'
       
    ]);

    $this->deleteJson('/api/v1/contactos/{id}', ['id' => $contacto->id])->assertStatus(200);

});



it('ver un solo contacto',function(){

    Sanctum::actingAs($this->usuario);

    $contacto=$this->usuario->contactos()->create([
        'id'=>2,
        'nombre'=>'linda',
        'apellido'=>'atencio',
        'email'=>'linda@gmail.com',
        'telefono'=>'345045540',
        'foto'=>'https://img.magnific.com/foto-gratis/joven-hombre-guapo-camiseta-informal-sobre-fondo-azul-cara-feliz-sonriendo-brazos-cruzados-mirando-camara-persona-positiva_839833-12963.jpg?semt=ais_hybrid&w=740&q=80'
       
    ]);

    $this->getJson('api/v1/contactos/{id}',['id'=>$contacto->id])->assertStatus(200);
});


it(' editar los contactos', function () {

    Sanctum::actingAs($this->usuario);

    $contacto=$this->usuario->contactos()->create([
        'nombre'=>'linda',
        'apellido'=>'atencio',
        'email'=>'linda@gmail.com',
        'telefono'=>'345045540',
        'foto'=>'https://img.magnific.com/foto-gratis/joven-hombre-guapo-camiseta-informal-sobre-fondo-azul-cara-feliz-sonriendo-brazos-cruzados-mirando-camara-persona-positiva_839833-12963.jpg?semt=ais_hybrid&w=740&q=80'
       
    ]);
    $response = $this->patchJson(
        "/api/v1/contactos/{$contacto->id}",
        [
            'nombre' => 'Linda actualizada',
            'apellido' => 'atencio',
            'email' => 'linda@gmail.com',
            'telefono' => '345045540',
            'foto' => 'https://as2.ftcdn.net/v2/jpg/00/50/92/03/1000_F_50920378_hep474tI6wHWufJNmRWycIEDLBdHFEcn.jpg'
        ]
    );

    $response->assertStatus(200);

    $this->assertDatabaseHas('contactos', [
        'id' => $contacto->id,
        'nombre' => 'Linda actualizada',
        'apellido' => 'atencio',
        'email' => 'linda@gmail.com',
        'telefono' => '345045540',
        'foto' => 'https://as2.ftcdn.net/v2/jpg/00/50/92/03/1000_F_50920378_hep474tI6wHWufJNmRWycIEDLBdHFEcn.jpg'
    ]);
    
    
});

