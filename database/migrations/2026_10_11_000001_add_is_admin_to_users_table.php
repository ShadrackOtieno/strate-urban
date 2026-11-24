<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Works on old MySQL/MyISAM setups too: short indexed strings and InnoDB tables.
        Schema::defaultStringLength(191);

        // Normally Laravel's own users migration has already run. If this project was created without it,
        // create the standard tables here so the back-office login always has somewhere to live.
        if (! Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $t) {
            $t->engine = 'InnoDB';
                $t->id();
                $t->string('name');
                $t->string('email')->unique();
                $t->timestamp('email_verified_at')->nullable();
                $t->string('password');
                $t->rememberToken();
                $t->timestamps();
            });
        }

        if (! Schema::hasTable('password_reset_tokens')) {
            Schema::create('password_reset_tokens', function (Blueprint $t) {
            $t->engine = 'InnoDB';
                $t->string('email')->primary();
                $t->string('token');
                $t->timestamp('created_at')->nullable();
            });
        }

        if (! Schema::hasTable('sessions')) {
            Schema::create('sessions', function (Blueprint $t) {
            $t->engine = 'InnoDB';
                $t->string('id')->primary();
                $t->foreignId('user_id')->nullable()->index();
                $t->string('ip_address', 45)->nullable();
                $t->text('user_agent')->nullable();
                $t->longText('payload');
                $t->integer('last_activity')->index();
            });
        }

        if (! Schema::hasColumn('users', 'is_admin')) {
            Schema::table('users', function (Blueprint $t) {
                $t->boolean('is_admin')->default(false)->after('password');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('users', 'is_admin')) {
            Schema::table('users', fn (Blueprint $t) => $t->dropColumn('is_admin'));
        }
    }
};
