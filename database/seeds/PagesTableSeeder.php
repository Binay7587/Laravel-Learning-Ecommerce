<?php

use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages =  array(
            array(
                'title' => 'About Us',
                'slug' => 'about-us',
                'summary' => 'This is about us',
            ),
            array(
                'title' => 'Terms And Conditions',
                'slug' => 'terms-and-conditions',
                'summary' => 'This is T. And. C.',
            ),
            array(
                'title' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'summary' => 'This is P. And. P.',
            ),
            array(
                'title' => 'Help And Faq',
                'slug' => 'help-and-faq',
                'summary' => 'This is H. And. F.',
            ),
            array(
                'title' => 'Return policy',
                'slug' => 'return-policy',
                'summary' => 'This is Return Policy',
            ),
            array(
                'title' => 'Delivery policy',
                'slug' => 'delivery-policy',
                'summary' => 'This is Delivery Policy',
            )
        );
        DB::table('pages')->insert($pages);
    }
}
