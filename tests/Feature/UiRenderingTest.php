<?php

namespace Tests\Feature;

use App\Models\Bill;
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
            $response = $this->actingAs($user)->get($path)->assertOk()->assertSee('&lt;script&gt;Nama kantong panjang&lt;/script&gt;', false);
            $this->assertStringContainsString('-Rp 999.999.999.999', strip_tags($response->getContent()));
        }
    }

    public function test_bill_names_are_safe_in_forms_and_bulk_calculator(): void
    {
        $user = User::factory()->create();
        $bill = Bill::create(['user_id' => $user->id, 'name' => "Internet 'rumah' <aman>", 'amount' => 250000, 'due_date' => 15, 'frequency' => 'monthly']);

        $this->actingAs($user)->get('/bills')->assertOk()->assertSee('Internet &#039;rumah&#039; &lt;aman&gt;', false)->assertSee('payments[0][amount]', false)->assertSee(route('bills.pay', $bill), false);
    }

    public function test_report_export_renders_local_styles_and_pdf(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/reports/export');

        $response->assertOk()->assertHeader('content-type', 'application/pdf');
        $this->assertStringStartsWith('%PDF-', $response->getContent());
    }

    public function test_decimal_amounts_and_long_report_rows_render(): void
    {
        $user = User::factory()->create();
        $category = Category::create(['user_id' => $user->id, 'name' => str_repeat('Kantong panjang ', 16), 'type' => 'income']);
        foreach (range(1, 12) as $index) {
            Transaction::create(['user_id' => $user->id, 'category_id' => $category->id, 'type' => 'income', 'amount' => 1234.50, 'date' => now(), 'description' => str_repeat('Catatan panjang ', 16)]);
        }

        $response = $this->actingAs($user)->get('/dashboard')->assertOk();
        $this->assertStringContainsString('Rp 1.234,50', strip_tags($response->getContent()));
        $this->actingAs($user)->get('/reports/export')->assertOk()->assertHeader('content-type', 'application/pdf');
    }
}
