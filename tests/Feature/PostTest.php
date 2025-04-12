<?php
namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_post()
    {
        $response = $this->post('/posts', [
            'title' => 'Test Post',
            'content' => 'This is a test post content.',
            'is_published' => true
        ]);

        $response->assertRedirect(route('posts.index'));
        $this->assertDatabaseHas('posts', ['title' => 'Test Post']);
    }

    public function test_post_requires_title()
    {
        $response = $this->post('/posts', [
            'title' => '',
            'content' => 'Content without title'
        ]);

        $response->assertSessionHasErrors('title');
    }

    public function test_post_requires_content()
    {
        $response = $this->post('/posts', [
            'title' => 'Title without content',
            'content' => ''
        ]);

        $response->assertSessionHasErrors('content');
    }
}