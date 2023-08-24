<?php

namespace Tests\Feature;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

use App\Models\User;
use App\Models\Message;

class FeatureMessageTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_messages(): void
    {
        $this->seed();
        $user = User::first();

        $this->actingAs($user);
        $this->json('GET', 'api/messages', [
            'Accept' => 'application/json'
        ])->assertStatus(200)->assertJsonCount(10);
    }

    public function test_get_sent_messages()
    {
        $this->seed();
        $user = User::first();
    
        $this->actingAs($user);
        $this->json('GET', 'api/messages?mailbox=sent', [
            'Accept' => 'application/json'
        ])->assertStatus(200)->assertJsonCount(10);
    }

    public function test_get_deleted_essages()
    {
        $this->seed();
        $user = User::first();

        $this->actingAs($user);
        $this->json('GET', 'api/messages?mailbox=archived', [
            'Accept' => 'application/json'
        ])->assertStatus(200)->assertJsonCount(6);
    }

    public function test_post_message()
    {
        $this->seed();
        $user = User::first();
        $toUser  = User::skip(1)->take(1)->first();
        
        $this->actingAs($user);
        $this->json('POST', 'api/messages', [
            'to' => $toUser->id,
            'subject' => 'Test',
            'content' => 'TestContent'
        ])->assertStatus(201);
    }

    public function test_incomplete_post_message()
    {
        $this->seed();
        $user = User::first();
        $toUser  = User::skip(1)->take(1)->first();
        
        $this->actingAs($user);
        $this->json('POST', 'api/messages', [
            'to' => $toUser->id,
            'subject' => 'Test',
        ])->assertStatus(400);
    }

    public function test_patch_message()
    {
        $this->seed();
        $user = User::first();

        $this->actingAs($user);
        $message = Message::where(['user_id' => $user->id, 'to' => $user->id])->first();

        $this->json('PATCH', 'api/messages/' . $message->id, [
            'read' => true
        ])->assertStatus(204);
    }

    public function test_unauthorized_patch_message()
    {
        $this->seed();
        $user = User::first();
        $fakeUser = User::skip(1)->take(1)->first();

        $this->actingAs($user);
        $message = Message::where(['user_id' => $user->id, 'to' => $user->id])->first();

        $this->actingAs($fakeUser);
        $this->json('PATCH', 'api/messages/' . $message->id, [
            'read' => true
        ])->assertStatus(401);
    }

    public function test_delete_message()
    {
        $this->seed();
        $user = User::first();

        $this->actingAs($user);
        $message = Message::where(['user_id' => $user->id, 'to' => $user->id])->first();

        $this->json('DELETE', 'api/messages/' . $message->id)->assertStatus(200);
    }

    public function test_unauthorized_delete_message()
    {
        $this->seed();
        $user = User::first();
        $fakeUser = User::skip(1)->take(1)->first();

        $this->actingAs($fakeUser);
        $message = Message::where(['user_id' => $user->id, 'to' => $user->id])->first();

        $this->json('DELETE', 'api/messages/' . $message->id)->assertStatus(401);
    }
}
