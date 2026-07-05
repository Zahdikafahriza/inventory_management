<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Membuat seluruh tabel Master Referensi.
 *
 * Semua tabel berstruktur sama: id, nama (unik), is_active, timestamps.
 * Definisi tabel & nilai seed dibaca dari config/master-references.php
 * sehingga tetap satu sumber kebenaran dengan controller & view.
 */
return new class extends Migration
{
    public function up(): void
    {
        foreach (config('master-references') as $config) {
            $table = $config['table'];

            if (Schema::hasTable($table)) {
                continue;
            }

            Schema::create($table, function (Blueprint $t) {
                $t->id();
                $t->string('nama', 191)->unique();
                $t->boolean('is_active')->default(true);
                $t->timestamps();
            });

            // Seed nilai default bila ada
            if (!empty($config['seed'])) {
                $now = now();
                $rows = array_map(fn ($nama) => [
                    'nama'       => $nama,
                    'is_active'  => true,
                    'created_at' => $now,
                    'updated_at' => $now,
                ], $config['seed']);

                DB::table($table)->insert($rows);
            }
        }

        // Seed tambahan: isi master dari nilai unik yang SUDAH ADA di tabel barangs,
        // supaya data lama tidak hilang dari pilihan dropdown.
        if (Schema::hasTable('barangs')) {
            foreach (config('master-references') as $config) {
                $column = $config['barang_column'] ?? null;
                if (!$column || !Schema::hasColumn('barangs', $column)) {
                    continue;
                }

                $existing = DB::table($config['table'])->pluck('nama')->map(fn ($v) => mb_strtolower($v))->all();

                $values = DB::table('barangs')
                    ->whereNotNull($column)
                    ->where($column, '!=', '')
                    ->distinct()
                    ->pluck($column);

                $now = now();
                $insert = [];
                foreach ($values as $val) {
                    if (!in_array(mb_strtolower($val), $existing, true)) {
                        $insert[] = [
                            'nama'       => $val,
                            'is_active'  => true,
                            'created_at' => $now,
                            'updated_at' => $now,
                        ];
                        $existing[] = mb_strtolower($val);
                    }
                }

                if ($insert) {
                    DB::table($config['table'])->insert($insert);
                }
            }
        }
    }

    public function down(): void
    {
        foreach (config('master-references') as $config) {
            Schema::dropIfExists($config['table']);
        }
    }
};
