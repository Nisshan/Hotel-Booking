<?php

test('unauthenticated users are redirected back to login page', function (){
    $this->get('/admin/dashboard')
        ->assertRedirect(route('login'));
});


test('authenticated user can only view dashboard',function (){
    login();
    $this->get('/admin/dashboard')
        ->assertStatus(200);
});
