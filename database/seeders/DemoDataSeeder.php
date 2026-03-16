<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Agency;
use App\Models\Activity;
use App\Models\ActivityCategory;
use App\Models\Slider;
use App\Models\GalleryCategory;
use App\Models\GalleryImage;
use App\Models\Branch;
use App\Models\Page;
use App\Models\User;
use Illuminate\Support\Str;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        $adminId = User::first()->id ?? 1;

        // --- Sliders ---
        Slider::updateOrCreate(['title_ar' => 'نحو آفاق تجارية واسعة'], [
            'title_en' => 'Towards Vast Commercial Horizons',
            'subtitle_ar' => 'مصنع لك للمنسوجات - شريككم الموثوق في النجاح',
            'subtitle_en' => 'LK Textiles Factory - Your Trusted Partner in Success',
            'image' => 'demo/slider1.jpg',
            'link' => '#',
            'button_text_ar' => 'اكتشف المزيد',
            'button_text_en' => 'Explore More',
            'duration' => 5000,
            'status' => 'active',
            'order' => 1
        ]);

        Slider::updateOrCreate(['title_ar' => 'جودة لا تضاهى'], [
            'title_en' => 'Unbeatable Quality',
            'subtitle_ar' => 'نقدم أفضل الخدمات والمنتجات العالمية بأعلى المعايير',
            'subtitle_en' => 'Providing the best global services and products with the highest standards',
            'image' => 'demo/slider2.jpg',
            'link' => '#',
            'button_text_ar' => 'خدماتنا',
            'button_text_en' => 'Our Services',
            'duration' => 5000,
            'status' => 'active',
            'order' => 2
        ]);

        // --- Services ---
        $services = [
            [
                'title_ar' => 'الزي الموحد',
                'title_en' => 'Uniform Manufacturing',
                'description_ar' => 'تصنيع الزي الموحد لجميع المؤسسات والشركات بتصاميم أنيقة تعكس المهنية والالتزام.',
                'description_en' => 'Manufacturing uniforms for all institutions and companies with elegant designs reflecting professionalism.',
                'icon' => 'fas fa-user-tie',
                'slug' => 'uniform-manufacturing',
            ],
            [
                'title_ar' => 'ملابس الأطفال',
                'title_en' => 'Kids Clothing',
                'description_ar' => 'تصنيع ملابس الأطفال بأقمشة آمنة وتصاميم مبهجة تناسب جميع الأعمار.',
                'description_en' => 'Manufacturing children\'s clothing with safe fabrics and cheerful designs for all ages.',
                'icon' => 'fas fa-child',
                'slug' => 'kids-clothing',
            ],
            [
                'title_ar' => 'القطاع الصحي',
                'title_en' => 'Healthcare Apparel',
                'description_ar' => 'تصنيع ملابس القطاع الصحي من السكراب واللاب كوت بجودة عالية وتصاميم عصرية.',
                'description_en' => 'Manufacturing healthcare apparel including scrubs and lab coats with high quality and modern designs.',
                'icon' => 'fas fa-heartbeat',
                'slug' => 'healthcare-apparel',
            ],
            [
                'title_ar' => 'الملابس الرجالية',
                'title_en' => 'Men\'s Clothing',
                'description_ar' => 'خدمة تصنيع ملابس رجالية بجودة عالية وتصاميم تجمع بين الأناقة والراحة.',
                'description_en' => 'High-quality men\'s clothing manufacturing with designs combining elegance and comfort.',
                'icon' => 'fas fa-tshirt',
                'slug' => 'mens-clothing',
            ],
            [
                'title_ar' => 'الملابس النسائية',
                'title_en' => 'Women\'s Clothing',
                'description_ar' => 'تصنيع تشكيلات متنوعة من الملابس النسائية بأحدث صيحات الموضة وأجود الأقمشة.',
                'description_en' => 'Manufacturing diverse collections of women\'s clothing with the latest fashion trends and finest fabrics.',
                'icon' => 'fas fa-female',
                'slug' => 'womens-clothing',
            ],
            [
                'title_ar' => 'الزي المدرسي',
                'title_en' => 'School Uniforms',
                'description_ar' => 'تصنيع الزي المدرسي بمتانة عالية وتصاميم مريحة تناسب الطلاب والطالبات.',
                'description_en' => 'Manufacturing durable school uniforms with comfortable designs suitable for students.',
                'icon' => 'fas fa-graduation-cap',
                'slug' => 'school-uniforms',
            ],
        ];

        foreach ($services as $i => $s) {
            Service::updateOrCreate(['slug' => $s['slug']], array_merge($s, [
                'content_ar' => '<p>' . $s['description_ar'] . ' نحن رواد في هذا المجال ونقدم حلولاً مبتكرة تلبي تطلعات عملائنا وتساعدهم على تحقيق الريادة.</p>',
                'content_en' => '<p>' . $s['description_en'] . ' We are leaders in this field, providing innovative solutions that meet our clients\' aspirations.</p>',
                'image' => null,
                'status' => 'published',
                'order' => $i + 1,
                'created_by' => $adminId
            ]));
        }

        // --- Agencies ---
        $agencies = [
            ['name_ar' => 'مرسيدس بنز', 'name_en' => 'Mercedes-Benz', 'slug' => 'mercedes'],
            ['name_ar' => 'هواوي العالمية', 'name_en' => 'Huawei Global', 'slug' => 'huawei'],
            ['name_ar' => 'شنايدر إلكتريك', 'name_en' => 'Schneider Electric', 'slug' => 'schneider'],
            ['name_ar' => 'مايكروسوفت', 'name_en' => 'Microsoft', 'slug' => 'microsoft'],
            ['name_ar' => 'سيمنز', 'name_en' => 'Siemens', 'slug' => 'siemens'],
            ['name_ar' => 'أرامكو', 'name_en' => 'Aramco', 'slug' => 'aramco'],
        ];

        foreach ($agencies as $i => $a) {
            Agency::updateOrCreate(['slug' => $a['slug']], array_merge($a, [
                'description_ar' => 'مصنع لك للمنسوجات هو الوكيل الاستراتيجي المعتمد لمنتجات ' . $a['name_ar'] . ' في الأسواق المحلية والإقليمية.',
                'description_en' => 'LK Textiles Factory is the strategic authorized agent for ' . $a['name_en'] . ' products in local and regional markets.',
                'logo' => null, // Placeholder will be used or user can upload
                'status' => 'published',
                'order' => $i + 1,
                'created_by' => $adminId
            ]));
        }

        // --- Activity Categories & Activities ---
        $actCat = ActivityCategory::updateOrCreate(['slug' => 'social-responsibility'], [
            'name_ar' => 'المسؤولية الاجتماعية',
            'name_en' => 'Social Responsibility',
            'status' => 'active'
        ]);
        $actCat2 = ActivityCategory::updateOrCreate(['slug' => 'corporate-news'], [
            'name_ar' => 'أخبار المجموعة',
            'name_en' => 'Group News',
            'status' => 'active'
        ]);

        Activity::updateOrCreate(['slug' => 'global-forum-2024'], [
            'activity_category_id' => $actCat2->id,
            'title_ar' => 'مشاركة مصنع لك للمنسوجات في منتدى الأعمال العالمي 2024',
            'title_en' => 'LK Textiles Participation in Global Business Forum 2024',
            'description_ar' => 'شارك مصنع لك للمنسوجات بوفد رفيع المستوى في فعاليات المنتدى العالمي لمناقشة فرص الاستثمار الناشئة.',
            'description_en' => 'LK Textiles Factory participated with a high-level delegation in the Global Forum to discuss emerging investment opportunities.',
            'image' => null,
            'status' => 'published',
            'order' => 1,
            'created_by' => $adminId
        ]);

        Activity::updateOrCreate(['slug' => 'green-initiative'], [
            'activity_category_id' => $actCat->id,
            'title_ar' => 'إطلاق مبادرة مصنع لك الخضراء',
            'title_en' => 'Launching LK Textiles Green Initiative',
            'description_ar' => 'ضمن التزامنا بالاستدامة، أطلقنا مبادرة للتشجير ودعم مشاريع الطاقة المتجددة.',
            'description_en' => 'As part of our commitment to sustainability, we launched an initiative for afforestation and supporting renewable energy projects.',
            'image' => null,
            'status' => 'published',
            'order' => 2,
            'created_by' => $adminId
        ]);

        // --- Gallery ---
        $galCat = GalleryCategory::updateOrCreate(['slug' => 'projects'], [
            'name_ar' => 'صور المشاريع',
            'name_en' => 'Projects Gallery',
            'status' => 'active'
        ]);
        for ($i = 1; $i <= 3; $i++) {
            GalleryImage::updateOrCreate(['image' => 'demo/gallery' . $i . '.jpg'], [
                'gallery_category_id' => $galCat->id,
                'title_ar' => 'مشروع رقم ' . $i,
                'title_en' => 'Project No ' . $i,
                'status' => 'published',
                'order' => $i,
                'created_by' => $adminId
            ]);
        }

        // --- Branches ---
        Branch::updateOrCreate(['name_ar' => 'الفرع الرئيسي - صنعاء'], [
            'name_en' => 'Main Branch - Sanaa',
            'address_ar' => 'صنعاء، شارع الستين، برج لك',
            'address_en' => 'Sanaa, Al-Sitteen St, LK Tower',
            'phone' => '+967 1 123456',
            'email' => 'main@lk-textiles.com',
            'working_hours_ar' => '8:00 صباحاً - 8:00 مساءً',
            'working_hours_en' => '8:00 AM - 8:00 PM',
            'status' => 'active',
            'order' => 1
        ]);

        Branch::updateOrCreate(['name_ar' => 'فرع عدن'], [
            'name_en' => 'Aden Branch',
            'address_ar' => 'عدن، كريتر، مجمع عدن التجاري',
            'address_en' => 'Aden, Crater, Aden Commercial Mall',
            'phone' => '+967 2 654321',
            'email' => 'aden@lk-textiles.com',
            'status' => 'active',
            'order' => 2
        ]);

        // --- Pages ---
        Page::updateOrCreate(['slug' => 'about-us'], [
            'title_ar' => 'من نحن',
            'title_en' => 'About Us',
            'content_ar' => '<h3>قصة نجاحنا</h3><p>مصنع لك للمنسوجات هو صرح رائد في مجال صناعة الغزل والنسيج، تأسس برؤية طموحة للمساهمة في بناء اقتصاد قوي ومستدام. نحن فخورون بقيمنا التي تقوم على النزاهة، الجودة، والابتكار.</p>',
            'content_en' => '<h3>Our Success Story</h3><p>LK Textiles is a leading factory in the textile industry, founded with an ambitious vision to contribute to building a strong and sustainable economy. We are proud of our values based on integrity, quality, and innovation.</p>',
            'image' => 'demo/about.jpg',
            'status' => 'published',
            'order' => 1,
            'created_by' => $adminId
        ]);
    }
}
