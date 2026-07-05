<?php

namespace App\Providers;

use App\Models\Barang;
use App\Policies\BarangPolicy;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Gate::policy(Barang::class, BarangPolicy::class);

        Paginator::defaultView('vendor.pagination.custom');

        // Saat di belakang Cloudflare Tunnel (APP_URL https), paksa semua URL
        // yang di-generate memakai https. Tanpa ini, @vite & asset() bisa
        // menghasilkan link http:// -> diblokir browser (mixed content) ->
        // CSS/JS gagal load dan tampilan jadi polos.
        if (str_starts_with((string) config('app.url'), 'https://')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        // Sediakan pilihan dropdown (dari tabel master) untuk form barang.
        \Illuminate\Support\Facades\View::composer(
            ['barangs.create', 'barangs.edit'],
            function ($view) {
                $options = [];

                foreach (config('master-references') as $type => $config) {
                    $table = $config['table'];

                    if (\Illuminate\Support\Facades\Schema::hasTable($table)) {
                        $options[$config['barang_column']] = \App\Models\MasterReference::query_for($table)
                            ->where('is_active', true)
                            ->orderBy('nama')
                            ->pluck('nama')
                            ->all();
                    } else {
                        $options[$config['barang_column']] = [];
                    }
                }

                $view->with('masterOptions', $options);
            }
        );
    }
}
