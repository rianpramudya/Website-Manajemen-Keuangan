<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UiRenderingTest extends TestCase
{
    use RefreshDatabase;

    public function test_finance_pages_render_empty_states(): void
    {
        $user = User::factory()->create();

        foreach (['/dashboard', '/pockets', '/transactions/history', '/bills', '/reports'] as $path) {
            $this->actingAs($user)->get($path)->assertOk();
        }
    }

    public function test_pockets_escape_names_and_render_large_negative_balances(): void
    {
        $user = User::factory()->create();
        $category = Category::create(['user_id' => $user->id, 'name' => '<script>Nama kantong panjang</script>', 'type' => 'expense']);
        Transaction::create(['user_id' => $user->id, 'category_id' => $category->id, 'type' => 'expense', 'amount' => 999999999999, 'date' => now(), 'description' => 'Catatan uji']);

        foreach (['/dashboard', '/pockets', '/categories/'.$category->id] as $path) {
            $this->actingAs($user)->get($path)->assertOk()->assertSee('&lt;script&gt;Nama kantong panjang&lt;/script&gt;', false)->assertSee('-Rp 999.999.999.999', false);
        }
    }
}
