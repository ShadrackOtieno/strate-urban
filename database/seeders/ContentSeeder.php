<?php

namespace Database\Seeders;

use App\Models\Development;
use App\Models\Faq;
use App\Models\Location;
use App\Models\Property;
use App\Models\Service;
use App\Models\Setting;
use App\Models\TeamMember;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        Setting::put([
            'company_name' => 'Kilele Properties',
            'tagline' => 'Premium property in Nairobi and beyond',
            'meta_description' => 'Buy, rent and invest in apartments, houses, hotel apartments and land across Kenya with Kilele Properties.',
            'hero_title' => 'Property worth holding on to.',
            'hero_text' => 'Hotel apartments, residences and land across Kenya, chosen carefully and sold with clear paperwork and honest numbers.',
            'cta_title' => 'Let us find the right property for you.',
            'cta_text' => 'Tell us what you are looking for. A consultant will call you within one working day with options that fit your budget.',
            'about_intro' => "Kilele Properties is a Nairobi real estate company that helps people buy, sell, rent and lease quality property across Kenya.\n\nWe focus on well-located apartments, hotel apartments, family homes and land, and we handle the work around the sale: viewings, due diligence, payment plans and handover.",
            'mission' => 'To make owning and investing in Kenyan property clear, safe and rewarding.',
            'values' => "Clear paperwork: Every property is checked for title and approvals before we list it.\nHonest numbers: Prices, fees and payment plans are explained in writing, with no surprises.\nReal service: One consultant stays with you from first viewing to handover.\nLong-term thinking: We recommend what suits your goals, not what is easiest to sell.",
            'email' => 'hello@kilele.test',
            'notify_email' => 'hello@kilele.test',
            'phone' => '+254 700 000 001',
            'phone2' => '+254 700 000 002',
            'whatsapp' => '254700000001',
            'address' => 'Your building, Your street, Nairobi',
            'hours' => 'Mon to Sat, 8:00 to 17:00 EAT',
            'map_embed' => '',
            'primary_color' => '#383B41',
            'accent_color' => '#D8232A',
            'facebook' => '', 'instagram' => '', 'linkedin' => '', 'twitter' => '', 'youtube' => '',
        ]);

        $locs = [];
        foreach ([
            ['Nairobi', 'Nairobi County', 'The capital: business districts, serviced apartments near the airport, leafy suburbs and fast-growing satellite towns.', 'loc-nairobi'],
            ['Westlands', 'Nairobi County', 'Nairobi\'s dining, nightlife and office hub, popular with professionals, expatriates and short-stay guests.', 'loc-westlands'],
            ['Kiambu', 'Kiambu County', 'Green, well-connected residential land and homes just north of the city, ideal for families and long-term holds.', 'loc-kiambu'],
            ['Nyeri', 'Nyeri County', 'Cool highland living below Mount Kenya, with affordable land and a strong lifestyle appeal.', 'loc-nyeri'],
        ] as $i => [$name, $county, $desc, $img]) {
            $locs[$name] = Location::updateOrCreate(['slug' => Str::slug($name)], ['name' => $name, 'county' => $county, 'description' => $desc, 'image' => "images/sample/{$img}.svg", 'sort_order' => $i, 'is_active' => true]);
        }

        $steps = "Reserve your unit with a small booking fee\nSign the sale agreement and pay the agreed deposit\nPay the balance in monthly instalments\nReceive your unit on completion and handover";
        $devs = [];
        foreach ([
            ['Kingfisher Suites (sample)', 'Westlands', 'Furnished suites above the city', 'completed', 'dev-kingfisher',
                'Completed, furnished studio and one-bedroom suites with a rooftop pool, gym and restaurant. A sample development: replace with your own.',
                "Rooftop pool and sun deck\nGym and wellness room\nRestaurant and lounge\n24-hour security and backup power\nFully furnished, move-in ready",
                "Studio: from KSh 9,500,000\nOne bedroom: from KSh 14,000,000"],
            ['Airport Gate Residences (sample)', 'Nairobi', 'Hotel apartments minutes from the airport', 'under_construction', 'dev-jkia',
                'Serviced apartments positioned for business travellers and airline crews, designed to be run by a professional hotel operator. A sample development.',
                "Close to the main airport\nProfessional operator model\nFurnished, hotel-grade finishes\nSecure parking\nFlexible instalment plan",
                "Studio: from KSh 7,800,000\nOne bedroom: from KSh 11,500,000"],
            ['Sports Road Apartments (sample)', 'Westlands', 'Modern living in the heart of Westlands', 'off_plan', 'dev-westgate',
                'An off-plan development of contemporary apartments near restaurants, offices and schools. A sample development.',
                "Walkable Westlands location\nBalconies and city views\nShared pool and gym\nGenerator and borehole\nPayment plan over 24 months",
                "Studio: from KSh 8,200,000\nTwo bedroom: from KSh 16,500,000"],
        ] as $i => [$name, $loc, $tag, $status, $img, $sum, $hl, $units]) {
            $devs[$name] = Development::updateOrCreate(['slug' => Str::slug($name)], [
                'location_id' => $locs[$loc]->id, 'name' => $name, 'tagline' => $tag, 'status' => $status,
                'address' => $loc.', Nairobi', 'summary' => $sum,
                'body' => $sum."\n\nThis is placeholder copy. Describe the building, the neighbourhood, who it suits and what makes it a sound purchase. Add real photographs from the back office.",
                'highlights' => $hl, 'unit_types' => $units, 'how_it_works' => $steps,
                'investment_note' => 'Any projected income is an estimate, not a guarantee. Ask us for the full numbers and the operator agreement before you decide.',
                'cover_image' => "images/sample/{$img}.svg", 'sort_order' => $i, 'is_active' => true,
            ]);
        }

        $props = [
            // title, type, purpose, price, period, beds, baths, size, unit, loc, dev, img, feat, hot, short
            ['Furnished studio at Kingfisher Suites (sample)', 'apartment', 'sale', 9500000, null, 0, 1, 38, 'sqm', 'Westlands', 'Kingfisher Suites (sample)', 'p-studio-1', true, true, 'Furnished studio with rooftop pool, gym and restaurant access.'],
            ['One-bedroom hotel apartment, Westlands (sample)', 'apartment', 'sale', 14000000, null, 1, 1, 62, 'sqm', 'Westlands', 'Kingfisher Suites (sample)', 'p-studio-2', true, true, 'Bright one-bedroom suite in a managed hotel building.'],
            ['Two-bedroom apartment, Sports Road (sample)', 'apartment', 'sale', 16500000, null, 2, 2, 98, 'sqm', 'Westlands', 'Sports Road Apartments (sample)', 'p-apartment-1', true, false, 'Off-plan two-bedroom apartment with balcony and city views.'],
            ['Airport-side studio apartment (sample)', 'apartment', 'sale', 7800000, null, 0, 1, 34, 'sqm', 'Nairobi', 'Airport Gate Residences (sample)', 'p-apartment-3', false, true, 'Compact furnished studio designed for short-stay demand.'],
            ['Modern studio to let, Westlands (sample)', 'apartment', 'rent', 150000, 'month', 0, 1, 40, 'sqm', 'Westlands', null, 'p-apartment-2', false, true, 'Furnished studio with fibre internet, gym and secure parking.'],
            ['Three-bedroom apartment to let, Nairobi (sample)', 'apartment', 'rent', 210000, 'month', 3, 3, 160, 'sqm', 'Nairobi', null, 'p-apartment-4', true, false, 'Spacious family apartment with a DSQ, backup power and a shared pool.'],
            ['Four-bedroom maisonette, Kiambu (sample)', 'house', 'rent', 180000, 'month', 4, 4, 320, 'sqm', 'Kiambu', null, 'p-house-1', true, true, 'Gated maisonette with garden, DSQ and ample parking.'],
            ['Five-bedroom villa, Nairobi (sample)', 'house', 'rent', 450000, 'month', 5, 5, 520, 'sqm', 'Nairobi', null, 'p-house-2', false, false, 'Quiet residential villa with pool, large garden and staff quarters.'],
            ['Contemporary home to let, Kiambu (sample)', 'house', 'rent', 135000, 'month', 3, 3, 240, 'sqm', 'Kiambu', null, 'p-house-3', false, false, 'Three-bedroom home in a secure estate with a clubhouse.'],
            ['Quarter-acre plot for sale, Kiambu (sample)', 'land', 'sale', 3800000, null, null, null, 0.25, 'acres', 'Kiambu', null, 'p-land-1', true, true, 'Ready title, murram roads, water and power on site.'],
            ['Half-acre plot for sale, Nyeri (sample)', 'land', 'sale', 2400000, null, null, null, 0.5, 'acres', 'Nyeri', null, 'p-land-2', false, true, 'Gently sloping plot with mountain views and fertile soil.'],
            ['Five acres for lease, Nyeri (sample)', 'land', 'lease', 600000, 'year', null, null, 5, 'acres', 'Nyeri', null, 'p-land-3', false, false, 'Open farmland available on a multi-year lease.'],
            ['Two acres for lease, Kiambu (sample)', 'land', 'lease', 450000, 'year', null, null, 2, 'acres', 'Kiambu', null, 'p-land-4', false, false, 'Fenced land with borehole, suited to farming or storage.'],
        ];
        foreach ($props as $i => [$title, $type, $purpose, $price, $period, $beds, $baths, $size, $unit, $loc, $dev, $img, $feat, $hot, $short]) {
            Property::updateOrCreate(['slug' => Str::slug($title)], [
                'location_id' => $locs[$loc]->id,
                'development_id' => $dev ? $devs[$dev]->id : null,
                'title' => $title, 'type' => $type, 'purpose' => $purpose, 'price' => $price, 'price_period' => $period,
                'bedrooms' => $beds, 'bathrooms' => $baths, 'size' => $size, 'size_unit' => $unit,
                'address' => $loc.', Kenya', 'short_description' => $short,
                'description' => $short."\n\nThis is a sample listing. Replace it with a real description, accurate details and photographs from the back office.",
                'features' => $type === 'land' ? "Title deed ready\nAccess road\nWater and power nearby\nSecure area" : "24-hour security\nBackup power\nAmple parking\nHigh-speed internet\nBorehole or reliable water",
                'cover_image' => "images/sample/{$img}.svg", 'status' => 'available',
                'is_featured' => $feat, 'is_hot' => $hot, 'is_active' => true, 'sort_order' => $i,
            ]);
        }

        foreach ([
            ['Property sales', 'home', 'We list, market and sell apartments, houses and land, and guide buyers from viewing to title transfer.'],
            ['Rentals and leasing', 'key', 'Find tenants or find a home: we match the right people to the right property and handle agreements.'],
            ['Investment advisory', 'bar-chart', 'Plain-language advice on hotel apartments, rental yields, off-plan and land, with the risks explained.'],
            ['Land and due diligence', 'map-pin', 'Title searches, survey checks and approvals confirmed before you pay a shilling.'],
            ['Property management', 'wrench', 'Rent collection, maintenance and tenant care for owners who want their property looked after.'],
            ['Legal and documentation', 'file-text', 'Sale agreements, payment schedules and handover documents prepared and explained.'],
        ] as $i => [$title, $icon, $sum]) {
            Service::updateOrCreate(['title' => $title], ['icon' => $icon, 'summary' => $sum, 'sort_order' => $i, 'is_active' => true]);
        }

        foreach ([
            ['How do I buy a property through you?', 'Choose a property, book a viewing, and reserve it with a booking fee. We then prepare the sale agreement, agree a payment plan if you need one, and manage the process until you receive your keys or title.'],
            ['Can I pay in instalments?', 'Many of our developments offer a deposit followed by monthly instalments. The plan for each property is shown on its page and confirmed in writing before you pay.'],
            ['How do I know the property is genuine?', 'We check title, approvals and ownership before listing, and we share the documents with you during due diligence. You are also free to bring your own lawyer.'],
            ['Do you handle rentals as well as sales?', 'Yes. We list homes and land for rent and lease, and we can manage the property for you after it is let.'],
            ['Are projected returns guaranteed?', 'No. Any figure we share about rental or hotel income is an estimate based on assumptions. Always ask for the full workings and the operator agreement.'],
        ] as $i => [$q, $a]) {
            Faq::updateOrCreate(['question' => $q], ['answer' => $a, 'sort_order' => $i, 'is_active' => true]);
        }

        // Hidden samples, so the site never shows invented people or quotes.
        TeamMember::updateOrCreate(['name' => 'Your Name'], ['title' => 'Director', 'bio' => 'Replace with a real bio and photo, then tick "Show on website".', 'sort_order' => 0, 'is_active' => false]);
        Testimonial::updateOrCreate(['author_name' => 'Client Name'], ['author_place' => 'Town', 'quote' => 'Replace with a real quote from a client who has agreed to be quoted.', 'rating' => 5, 'sort_order' => 0, 'is_active' => false]);
    }
}
