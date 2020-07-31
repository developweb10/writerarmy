<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Skill;

class SkillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Skill::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        Skill::insert([
//              ['name' => 'UI Design', 'slug' => 'ui-design', 'field' => 'Design'],
//              ['name' => 'Graphics Design', 'slug' => 'graphics-design', 'field' => 'Design'],
//              ['name' => 'PHP', 'slug' => 'php', 'field' => 'Web Development'],
//              ['name' => 'Laravel', 'slug' => 'laravel', 'field' => 'Web Development'],
//              ['name' => 'HTML5', 'slug' => 'html5', 'field' => 'Web Development'],
//              ['name' => 'CSS3', 'slug' => 'css3', 'field' => 'Web Development'],
//              ['name' => 'JavaScript', 'slug' => 'javascript', 'field' => 'Web Development'],


                ['name' => 'Advertising', 'slug' => 'advertising', 'field' => 'Advertising'],
                ['name' => 'B2B', 'slug' => 'b2b', 'field' => 'B2B'],
                ['name' => 'Construction', 'slug' => 'construction', 'field' => 'Construction'],
                ['name' => 'Creative', 'slug' => 'creative', 'field' => 'Creative'],
                ['name' => 'Education', 'slug' => 'education', 'field' => 'Education'],
                ['name' => 'Electronics', 'slug' => 'electronics', 'field' => 'Electronics'],
                ['name' => 'Finance', 'slug' => 'finance', 'field' => 'Finance'],
                ['name' => 'Home and Garden', 'slug' => 'home-and-garden', 'field' => 'Home and Garden'],
                ['name' => 'Insurance', 'slug' => 'insurance', 'field' => 'Insurance'],
                ['name' => 'Legal', 'slug' => 'legal', 'field' => 'Legal'],
                ['name' => 'Manufacturing', 'slug' => 'manufacturing', 'field' => 'Manufacturing'],
                ['name' => 'Marketing', 'slug' => 'marketing', 'field' => 'Marketing'],
                ['name' => 'Medical', 'slug' => 'medical', 'field' => 'Medical'],
                ['name' => 'Real Estate', 'slug' => 'real-estate', 'field' => 'Real Estate'],
                ['name' => 'Retail', 'slug' => 'retail', 'field' => 'Retail'],
                ['name' => 'Scientific', 'slug' => 'scientific', 'field' => 'Scientific'],
                ['name' => 'Software', 'slug' => 'software', 'field' => 'Software'],
                ['name' => 'Telecommunications', 'slug' => 'telecommunications', 'field' => 'Telecommunications'],
                ['name' => 'Tourism', 'slug' => 'tourism', 'field' => 'Tourism'],
                ['name' => 'Vehicle', 'slug' => 'vehicle', 'field' => 'Vehicle'],
                ['name' => 'Other', 'slug' => 'other', 'field' => 'Other'],
        ]);
    }
}
