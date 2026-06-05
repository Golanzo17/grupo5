<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Cart;
use Carbon\Carbon;

class ClearAbandonedCarts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'carts:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Limpia carritos abandonados con más de 7 días sin actividad';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $fechaLimite = Carbon::now()->subDays(7);
        
        $carts = Cart::where('updated_at', '<', $fechaLimite)->get();
        
        $count = $carts->count();
        
        foreach ($carts as $cart) {
            // Eliminar items primero (si no hay cascade) y luego el carrito
            $cart->items()->delete();
            $cart->delete();
        }

        $this->info("Se han eliminado {$count} carritos abandonados.");
    }
}
