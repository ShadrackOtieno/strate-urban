<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Works on old MySQL/MyISAM setups too: short indexed strings and InnoDB tables.
        Schema::defaultStringLength(191);

        Schema::create('settings', function (Blueprint $t) {
            $t->engine = 'InnoDB';
            $t->id();
            $t->string('key')->unique();
            $t->text('value')->nullable();
            $t->timestamps();
        });

        Schema::create('locations', function (Blueprint $t) {
            $t->engine = 'InnoDB';
            $t->id();
            $t->string('name');
            $t->string('slug')->unique();
            $t->string('county')->nullable();
            $t->text('description')->nullable();
            $t->string('image')->nullable();
            $t->unsignedInteger('sort_order')->default(0);
            $t->boolean('is_active')->default(true);
            $t->timestamps();
        });

        Schema::create('developments', function (Blueprint $t) {
            $t->engine = 'InnoDB';
            $t->id();
            $t->foreignId('location_id')->nullable()->constrained()->nullOnDelete();
            $t->string('name');
            $t->string('slug')->unique();
            $t->string('tagline')->nullable();
            $t->string('status')->default('completed');
            $t->string('address')->nullable();
            $t->text('summary')->nullable();
            $t->text('body')->nullable();
            $t->text('highlights')->nullable();
            $t->text('unit_types')->nullable();
            $t->text('how_it_works')->nullable();
            $t->text('investment_note')->nullable();
            $t->string('cover_image')->nullable();
            $t->unsignedInteger('sort_order')->default(0);
            $t->boolean('is_active')->default(true);
            $t->timestamps();
        });

        Schema::create('properties', function (Blueprint $t) {
            $t->engine = 'InnoDB';
            $t->id();
            $t->foreignId('location_id')->nullable()->constrained()->nullOnDelete();
            $t->foreignId('development_id')->nullable()->constrained()->nullOnDelete();
            $t->string('title');
            $t->string('slug')->unique();
            $t->string('type')->default('apartment');
            $t->string('purpose')->default('sale');
            $t->unsignedBigInteger('price')->default(0);
            $t->string('price_period')->nullable();
            $t->unsignedTinyInteger('bedrooms')->nullable();
            $t->unsignedTinyInteger('bathrooms')->nullable();
            $t->decimal('size', 10, 2)->nullable();
            $t->string('size_unit')->default('sqm');
            $t->string('address')->nullable();
            $t->string('short_description', 500)->nullable();
            $t->text('description')->nullable();
            $t->text('features')->nullable();
            $t->string('cover_image')->nullable();
            $t->string('status')->default('available');
            $t->boolean('is_featured')->default(false);
            $t->boolean('is_hot')->default(false);
            $t->boolean('is_active')->default(true);
            $t->unsignedInteger('sort_order')->default(0);
            $t->timestamps();
            $t->index(['is_active', 'purpose', 'type']);
        });

        Schema::create('property_images', function (Blueprint $t) {
            $t->engine = 'InnoDB';
            $t->id();
            $t->foreignId('property_id')->constrained()->cascadeOnDelete();
            $t->string('path');
            $t->string('caption')->nullable();
            $t->unsignedInteger('sort_order')->default(0);
            $t->timestamps();
        });

        Schema::create('services', function (Blueprint $t) {
            $t->engine = 'InnoDB';
            $t->id();
            $t->string('title');
            $t->string('icon')->nullable();
            $t->string('summary', 500);
            $t->text('body')->nullable();
            $t->unsignedInteger('sort_order')->default(0);
            $t->boolean('is_active')->default(true);
            $t->timestamps();
        });

        Schema::create('team_members', function (Blueprint $t) {
            $t->engine = 'InnoDB';
            $t->id();
            $t->string('name');
            $t->string('title');
            $t->text('bio')->nullable();
            $t->string('photo')->nullable();
            $t->string('phone')->nullable();
            $t->string('email')->nullable();
            $t->unsignedInteger('sort_order')->default(0);
            $t->boolean('is_active')->default(true);
            $t->timestamps();
        });

        Schema::create('testimonials', function (Blueprint $t) {
            $t->engine = 'InnoDB';
            $t->id();
            $t->string('author_name');
            $t->string('author_place')->nullable();
            $t->text('quote');
            $t->unsignedTinyInteger('rating')->default(5);
            $t->unsignedInteger('sort_order')->default(0);
            $t->boolean('is_active')->default(false);
            $t->timestamps();
        });

        Schema::create('faqs', function (Blueprint $t) {
            $t->engine = 'InnoDB';
            $t->id();
            $t->string('question');
            $t->text('answer');
            $t->unsignedInteger('sort_order')->default(0);
            $t->boolean('is_active')->default(true);
            $t->timestamps();
        });

        Schema::create('enquiries', function (Blueprint $t) {
            $t->engine = 'InnoDB';
            $t->id();
            $t->string('reference')->unique();
            $t->foreignId('property_id')->nullable()->constrained()->nullOnDelete();
            $t->foreignId('development_id')->nullable()->constrained()->nullOnDelete();
            $t->string('name');
            $t->string('email');
            $t->string('phone')->nullable();
            $t->string('interest')->default('general');
            $t->string('unit_size')->nullable();
            $t->text('message')->nullable();
            $t->string('status')->default('new');
            $t->text('admin_notes')->nullable();
            $t->timestamps();
            $t->index('status');
        });

        Schema::create('subscribers', function (Blueprint $t) {
            $t->engine = 'InnoDB';
            $t->id();
            $t->string('email')->unique();
            $t->timestamps();
        });
    }

    public function down(): void
    {
        foreach (['subscribers', 'enquiries', 'faqs', 'testimonials', 'team_members', 'services', 'property_images', 'properties', 'developments', 'locations', 'settings'] as $table) {
            Schema::dropIfExists($table);
        }
    }
};
