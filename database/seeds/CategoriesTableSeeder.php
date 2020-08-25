<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = 
            [ 
                "五教科"=>["国語", "数学", "英語", "理科", "社会"],
                "プログラミング"=>["PHP", "Ruby", "HTML&CSS"],
                "習い事"=>["ピアノ", "バイオリン", "水泳", "習字", "空手"],
                "未設定"=>["片付け", "書類整理", "瞑想", "洗濯", "草むしり"],
            ];
        
        $created_at = '2020-07-08 00:00:00';
        $updated_at = $created_at;
        $category_id = 0;
        
        for($userNo = 1; $userNo <= 20; $userNo++) {
            
            $user_id = 'testkun' . $userNo;
            
            for($categoryIndex = 0; $categoryIndex < count($categories); $categoryIndex++){
                //カテゴリーを追加するかどうかの判定
                if (rand(1,3) <= 2) {
                    $category_name = array_keys($categories)[$categoryIndex];
                    
                    DB::table('categories')->insert([
                        'user_id' => $user_id,
                        'name' => $category_name,
                        'created_at' => $created_at,
                        'updated_at' => $updated_at,
                        'order' => $categoryIndex,
                    ]);
                    $category_id += 1;
                    
                    for($tagIndex = 0; $tagIndex < count($categories["$category_name"]); $tagIndex++){
                        //タグを追加するかどうかの判定
                        if (rand(1,3) <= 1) {
                            $tag_name = $categories[$category_name][$tagIndex];
                            DB::table('tags')->insert([
                                'category_id' => $category_id,
                                'name' => $tag_name,
                                'created_at' => $created_at,
                                'updated_at' => $updated_at,
                                'order' => $categoryIndex * 100 + $tagIndex,
                            ]);
                        }
                    }
                }
            }
        }
        
        foreach(Category::all() as $category) {
            if(count($category->tags)){
                continue;
            } else {
                $category->delete();
            }
        }
   }
}
