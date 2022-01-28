public function getcategory(){
            $province =  DB::table('category')
            ->select('name')
            ->get();

            return response()->json(['Category' => $category]);
      }

      public function getsubcategory($category){
            $subcategory =  DB::table('sub_category')
            ->leftJoin('category','category.id','=','id')
            ->where('category.id',$category)
            ->select('name')
            ->get();

            return response()->json(['Sub Category' => $subcategory]);
      }
