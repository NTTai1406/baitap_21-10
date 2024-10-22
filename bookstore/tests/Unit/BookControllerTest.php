<?php

use App\Models\Book;

// Thêm dòng này vào đầu file
uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);


test('example', function () {
    expect(true)->toBeTrue();
});

test('test_index_returns_all_books', function () {
    Book::factory(3)->create();
    $response = $this->get('/books');
    $response->assertStatus(200);
    $response->assertJsonCount(3);
});
