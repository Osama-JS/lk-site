<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // Company Information
            ['key' => 'company_name_ar', 'value' => 'مصنع لك للمنسوجات', 'type' => 'string', 'group' => 'company'],
            ['key' => 'company_name_en', 'value' => 'LK Textiles Factory', 'type' => 'string', 'group' => 'company'],
            ['key' => 'company_tagline_ar', 'value' => 'الجودة في كل خيط، والتميز في كل نسج', 'type' => 'string', 'group' => 'company'],
            ['key' => 'company_tagline_en', 'value' => 'Quality in every thread, excellence in every weave', 'type' => 'string', 'group' => 'company'],
            ['key' => 'company_logo', 'value' => null, 'type' => 'image', 'group' => 'company'],
            ['key' => 'company_favicon', 'value' => null, 'type' => 'image', 'group' => 'company'],

            // Contact Information
            ['key' => 'company_email', 'value' => 'info@lk-textiles.com', 'type' => 'string', 'group' => 'contact'],
            ['key' => 'company_phone', 'value' => '+966 11 987 6543', 'type' => 'string', 'group' => 'contact'],
            ['key' => 'company_address_ar', 'value' => 'المنطقة الصناعية، الرياض، المملكة العربية السعودية', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'company_address_en', 'value' => 'Industrial Area, Riyadh, Saudi Arabia', 'type' => 'text', 'group' => 'contact'],


            // Social Media (Matched with footer.blade.php)
            ['key' => 'facebook_url', 'value' => 'https://facebook.com/lktextiles', 'type' => 'string', 'group' => 'social'],
            ['key' => 'twitter_url', 'value' => 'https://twitter.com/lktextiles', 'type' => 'string', 'group' => 'social'],
            ['key' => 'instagram_url', 'value' => 'https://instagram.com/lktextiles', 'type' => 'string', 'group' => 'social'],
            ['key' => 'linkedin_url', 'value' => 'https://linkedin.com/company/lktextiles', 'type' => 'string', 'group' => 'social'],
            ['key' => 'tiktok_url', 'value' => '', 'type' => 'string', 'group' => 'social'],
            ['key' => 'snapchat_url', 'value' => '', 'type' => 'string', 'group' => 'social'],

            // Theme Settings (Matched with app.blade.php)
            ['key' => 'theme_primary_color', 'value' => '#1a1a2e', 'type' => 'string', 'group' => 'system'],
            ['key' => 'theme_primary_dark', 'value' => '#0f0f1a', 'type' => 'string', 'group' => 'system'],
            ['key' => 'theme_primary_light', 'value' => '#2d2d44', 'type' => 'string', 'group' => 'system'],
            ['key' => 'theme_accent_color', 'value' => '#0ea5e9', 'type' => 'string', 'group' => 'system'],
            ['key' => 'theme_accent_dark', 'value' => '#0284c7', 'type' => 'string', 'group' => 'system'],
            ['key' => 'theme_accent_light', 'value' => '#38bdf8', 'type' => 'string', 'group' => 'system'],

            // System Settings
            ['key' => 'site_maintenance', 'value' => 'false', 'type' => 'boolean', 'group' => 'general'],
            ['key' => 'items_per_page', 'value' => '12', 'type' => 'string', 'group' => 'general'],
        ];

        foreach ($settings as $setting) {
            \App\Models\Setting::updateOrCreate(
                ['key' => $setting['key']],
                array_merge($setting, [
                    'updated_at' => now(),
                ])
            );
        }

        $this->command->info('✅ Settings created successfully!');
    }
}
