<?php

namespace App\Http\Controllers;

use App\Models\LandingProduct;
use App\Models\ComboProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class PageController extends Controller
{
    protected function getSettings()
    {
        return DB::table('settings')->pluck('value', 'key')->toArray();
    }

    public function about()
    {
        $settings = $this->getSettings();
        return view('about', compact('settings'));
    }

    public function products()
    {
        $settings = $this->getSettings();

        // Fetch regular products (Landing Products)
        $products = LandingProduct::query()
            ->where('is_active', 1)
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->get();

        return view('products', compact('settings', 'products'));
    }

    public function productDetails(LandingProduct $product)
    {
        abort_if((int) ($product->is_active ?? 1) !== 1, 404);

        $settings = $this->getSettings();

        $relatedProducts = LandingProduct::query()
            ->where('is_active', 1)
            ->where('id', '!=', $product->id)
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->take(4)
            ->get();

        return view('product-details', compact('settings', 'product', 'relatedProducts'));
    }
    protected function demoBlogPosts(): Collection
    {
        return collect([
            [
                'slug' => 'daily-hair-care-routine-for-healthy-growth',
                'title' => 'Daily Hair Care Routine for Healthy Growth',
                'excerpt' => 'A simple daily routine to keep your hair healthier, softer, and easier to manage naturally.',
                'category' => 'Hair Care',
                'author' => 'Keshoriya Team',
                'date' => 'March 1, 2026',
                'read_time' => '5 min read',
                'image' => 'https://images.unsplash.com/photo-1522337660859-02fbefca4702?auto=format&fit=crop&w=1200&q=80',
                'body' => [
                    'Healthy hair growth starts with small, consistent habits. A balanced daily routine can improve scalp comfort, reduce dryness, and make your hair look smoother and more vibrant over time.',
                    'Begin with gentle cleansing based on your scalp type. Overwashing can strip natural oils, while irregular washing may allow buildup to affect freshness and comfort. Finding the right balance is key.',
                    'Massage your scalp regularly with light pressure to support a relaxed routine and better product distribution. This can help your self-care process feel more intentional and soothing.',
                    'Use nourishing products with a clean and gentle feel. Daily care is not about doing too much. It is about doing the right things consistently and patiently.'
                ],
                'tips' => [
                    'Comb gently from the ends upward',
                    'Avoid very hot water during washing',
                    'Use a soft towel and pat dry',
                    'Protect hair from excessive heat styling',
                ],
            ],
            [
                'slug' => 'why-natural-ingredients-matter-in-beauty-care',
                'title' => 'Why Natural Ingredients Matter in Beauty Care',
                'excerpt' => 'Discover why clean, natural-inspired beauty products feel more comforting and aligned with daily self-care.',
                'category' => 'Beauty',
                'author' => 'Keshoriya Editorial',
                'date' => 'March 2, 2026',
                'read_time' => '4 min read',
                'image' => 'https://images.unsplash.com/photo-1556228578-8c89e6adf883?auto=format&fit=crop&w=1200&q=80',
                'body' => [
                    'Many people are choosing natural-inspired beauty products because they want routines that feel lighter, calmer, and more thoughtful. The appeal often comes from simplicity and comfort.',
                    'Natural ingredients can make a product experience feel closer to wellness and everyday care. The textures, scents, and presentation often create a more relaxing ritual.',
                    'Choosing natural-inspired beauty is also about trust. Customers often appreciate products that feel transparent, elegant, and easy to understand.',
                    'A premium beauty routine does not need to be complicated. Clean and thoughtful products can help create a more peaceful relationship with self-care.'
                ],
                'tips' => [
                    'Look for clear ingredient storytelling',
                    'Choose products that suit your routine',
                    'Keep your regimen simple and consistent',
                    'Focus on comfort as well as results',
                ],
            ],
            [
                'slug' => 'how-to-build-a-relaxing-night-self-care-ritual',
                'title' => 'How to Build a Relaxing Night Self-Care Ritual',
                'excerpt' => 'Turn your evenings into a premium self-care moment with a calm and nourishing routine.',
                'category' => 'Self Care',
                'author' => 'Keshoriya Team',
                'date' => 'March 3, 2026',
                'read_time' => '6 min read',
                'image' => 'https://images.unsplash.com/photo-1515377905703-c4788e51af15?auto=format&fit=crop&w=1200&q=80',
                'body' => [
                    'A relaxing evening ritual can help you feel refreshed before the next day begins. The best routines are not rushed. They are simple, quiet, and intentional.',
                    'Start by removing the distractions around you. A clean space, soft lighting, and a few trusted products can help create a calm environment.',
                    'Choose one or two beauty steps that feel soothing rather than overwhelming. A hair treatment, a serum, or a gentle massage can turn daily care into a meaningful pause.',
                    'Self-care works best when it feels sustainable. Your nighttime ritual should support rest, comfort, and confidence.'
                ],
                'tips' => [
                    'Use warm lighting',
                    'Keep only a few essentials nearby',
                    'Spend a few minutes massaging product gently',
                    'End the routine with calm hydration',
                ],
            ],
            [
                'slug' => 'best-ways-to-keep-hair-soft-in-all-seasons',
                'title' => 'Best Ways to Keep Hair Soft in All Seasons',
                'excerpt' => 'Seasonal changes can affect your hair. Here is how to keep softness and shine throughout the year.',
                'category' => 'Hair Care',
                'author' => 'Keshoriya Editorial',
                'date' => 'March 4, 2026',
                'read_time' => '5 min read',
                'image' => 'https://images.unsplash.com/photo-1596462502278-27bfdc403348?auto=format&fit=crop&w=1200&q=80',
                'body' => [
                    'Different seasons can change how your hair feels and behaves. Dry air, humidity, and heat all affect texture and manageability in different ways.',
                    'A good strategy is to adjust your routine slightly rather than completely changing everything. Small updates can often make the biggest difference.',
                    'Hydration, gentle cleansing, and thoughtful styling all help preserve softness. Your routine should respond to your environment without becoming too complicated.',
                    'Seasonal care is really about consistency and observation. Notice how your hair feels and respond with care, not excess.'
                ],
                'tips' => [
                    'Use lightweight hydration in warmer weather',
                    'Use richer care in dry seasons',
                    'Trim regularly for healthy ends',
                    'Reduce harsh styling when hair feels stressed',
                ],
            ],
            [
                'slug' => 'simple-scalp-care-tips-for-everyday-comfort',
                'title' => 'Simple Scalp Care Tips for Everyday Comfort',
                'excerpt' => 'A healthy routine often begins at the scalp. These simple steps can support freshness and comfort.',
                'category' => 'Scalp Care',
                'author' => 'Keshoriya Team',
                'date' => 'March 5, 2026',
                'read_time' => '4 min read',
                'image' => 'https://images.unsplash.com/photo-1519415510236-718bdfcd89c8?auto=format&fit=crop&w=1200&q=80',
                'body' => [
                    'Scalp care is one of the most important parts of any hair routine. A comfortable scalp can make the rest of your care process feel lighter and more effective.',
                    'Gentle cleansing, light massage, and avoiding unnecessary product overload are all helpful steps. The goal is balance rather than intensity.',
                    'Your scalp routine should feel clean and soothing, never harsh or rushed. Simplicity is often the best long-term approach.',
                    'When scalp care is consistent, the overall hair care experience becomes more enjoyable and easier to maintain.'
                ],
                'tips' => [
                    'Massage lightly, not aggressively',
                    'Keep cleansing regular and balanced',
                    'Avoid heavy buildup near roots',
                    'Choose routines that feel calm and breathable',
                ],
            ],
            [
                'slug' => 'beauty-routines-that-feel-luxurious-but-simple',
                'title' => 'Beauty Routines That Feel Luxurious but Simple',
                'excerpt' => 'Luxury does not have to mean complexity. Here is how to create an elegant beauty routine with ease.',
                'category' => 'Beauty',
                'author' => 'Keshoriya Editorial',
                'date' => 'March 6, 2026',
                'read_time' => '5 min read',
                'image' => 'https://images.unsplash.com/photo-1571781926291-c477ebfd024b?auto=format&fit=crop&w=1200&q=80',
                'body' => [
                    'A luxurious beauty routine is often more about atmosphere and consistency than the number of products you use. Simplicity can feel incredibly premium when done well.',
                    'Clean packaging, pleasant textures, and a calm order of use all contribute to a more elevated experience. These details matter.',
                    'Instead of adding more steps, focus on improving the quality of the steps you already enjoy. This makes your routine easier to follow and more relaxing.',
                    'True beauty luxury often feels effortless. It should fit naturally into your lifestyle and leave you feeling restored rather than overwhelmed.'
                ],
                'tips' => [
                    'Choose a calm color palette in your setup',
                    'Keep products neatly arranged',
                    'Use one or two high-comfort essentials',
                    'Build a routine you can repeat consistently',
                ],
            ],
            [
                'slug' => 'how-to-choose-the-right-product-for-your-routine',
                'title' => 'How to Choose the Right Product for Your Routine',
                'excerpt' => 'Not every product belongs in every routine. Learn how to choose what fits your needs best.',
                'category' => 'Guide',
                'author' => 'Keshoriya Team',
                'date' => 'March 7, 2026',
                'read_time' => '6 min read',
                'image' => 'https://images.unsplash.com/photo-1616394584738-fc6e612e71b9?auto=format&fit=crop&w=1200&q=80',
                'body' => [
                    'The best product for you is the one that fits naturally into your daily habits and supports your goals without adding confusion.',
                    'Start by thinking about what you want from your routine. Is it softness, shine, hydration, comfort, or a more polished experience?',
                    'Products should feel intuitive and enjoyable to use. When something fits your routine well, consistency becomes much easier.',
                    'Thoughtful product selection is one of the easiest ways to improve your beauty experience without making it more complicated.'
                ],
                'tips' => [
                    'Know your main care goal',
                    'Avoid buying products you will not use consistently',
                    'Choose texture and finish you enjoy',
                    'Build gradually instead of all at once',
                ],
            ],
            [
                'slug' => 'mistakes-to-avoid-in-your-weekly-hair-routine',
                'title' => 'Mistakes to Avoid in Your Weekly Hair Routine',
                'excerpt' => 'A few common routine mistakes can affect comfort and consistency. Here is what to avoid.',
                'category' => 'Hair Care',
                'author' => 'Keshoriya Editorial',
                'date' => 'March 8, 2026',
                'read_time' => '5 min read',
                'image' => 'https://images.unsplash.com/photo-1501004318641-b39e6451bec6?auto=format&fit=crop&w=1200&q=80',
                'body' => [
                    'Hair routines often become less effective when they are inconsistent or overloaded with too many steps at once.',
                    'Using too much product, changing routines too often, or styling too aggressively can make the overall process feel harder than it needs to be.',
                    'Instead, focus on a simple weekly rhythm that supports comfort and manageability. Let your routine work with your schedule, not against it.',
                    'Good hair care is built on balance. Avoid extremes and choose habits you can actually maintain.'
                ],
                'tips' => [
                    'Do not overload products in one session',
                    'Avoid changing products too frequently',
                    'Keep a calm weekly rhythm',
                    'Respect your hair texture and routine needs',
                ],
            ],
            [
                'slug' => 'the-power-of-consistency-in-beauty-care',
                'title' => 'The Power of Consistency in Beauty Care',
                'excerpt' => 'Consistency is often more important than intensity. Here is why routine matters so much.',
                'category' => 'Self Care',
                'author' => 'Keshoriya Team',
                'date' => 'March 9, 2026',
                'read_time' => '4 min read',
                'image' => 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?auto=format&fit=crop&w=1200&q=80',
                'body' => [
                    'One of the biggest benefits in beauty care comes from consistency. Repeating a small number of helpful steps is often more effective than doing many things occasionally.',
                    'Consistency builds familiarity, comfort, and better long-term habits. It also makes self-care feel easier and less stressful.',
                    'Your routine should not be difficult to maintain. The best beauty rituals are the ones you can continue with confidence.',
                    'A thoughtful routine repeated consistently can transform not just appearance, but how you feel during the process.'
                ],
                'tips' => [
                    'Keep your routine realistic',
                    'Repeat a few strong habits often',
                    'Choose products you enjoy using',
                    'Let your routine become part of your day naturally',
                ],
            ],
            [
                'slug' => 'creating-a-premium-home-beauty-experience',
                'title' => 'Creating a Premium Home Beauty Experience',
                'excerpt' => 'Your beauty corner at home can feel elegant, modern, and restful with a few thoughtful touches.',
                'category' => 'Lifestyle',
                'author' => 'Keshoriya Editorial',
                'date' => 'March 10, 2026',
                'read_time' => '6 min read',
                'image' => 'https://images.unsplash.com/photo-1521590832167-7bcbfaa6381f?auto=format&fit=crop&w=1200&q=80',
                'body' => [
                    'A premium beauty experience is not limited to salons or luxury spaces. You can create an elegant and calming routine right at home.',
                    'Start with a clean surface, soft textures, and products you genuinely enjoy using. Presentation can make your routine feel more intentional.',
                    'The goal is not perfection. It is creating an environment that feels beautiful, relaxed, and easy to return to every day.',
                    'When your space and products work together, self-care becomes something you look forward to instead of something you rush through.'
                ],
                'tips' => [
                    'Keep your beauty area uncluttered',
                    'Use soft lighting',
                    'Display only your daily essentials',
                    'Make your routine feel calm and enjoyable',
                ],
            ],
        ]);
    }
    public function blog()
    {
        $settings = $this->getSettings();
        $posts = $this->demoBlogPosts();

        return view('blog', compact('settings', 'posts'));
    }

    public function blogDetails($slug)
    {
        $settings = $this->getSettings();
        $posts = $this->demoBlogPosts();

        $post = $posts->firstWhere('slug', $slug);

        abort_if(!$post, 404);

        $relatedPosts = $posts
            ->where('slug', '!=', $slug)
            ->take(3)
            ->values();

        return view('blog-details', compact('settings', 'post', 'relatedPosts'));
    }


    public function contact()
    {
        $settings = $this->getSettings();
        return view('contact', compact('settings'));
    }
public function showFeaturedComboProducts()
{
    $settings = $this->getSettings();

    // Fetch the combo products marked as best sellers
    $comboProducts = ComboProduct::where('is_best_seller', true)
        ->orderBy('sort_order', 'asc')
        ->take(3) // Limit to 3 best sellers
        ->get();

    return view('home', compact('settings', 'comboProducts'));
}
    
}