<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    protected  $category = null;
    public function __construct(Category $category)
    {
        $this->category  = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->category = $this->category->getAllCategories();
        return view('admin.pages.category')->with('category_data', $this->category);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->category = $this->category->getAllParents();
        return view('admin.pages.category-form')->with('parent_cats',$this->category);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = $this->category->getAddRules();
        $request->validate($rules);

        $data = $request->all();
        $data['slug'] = $this->category->getSlug($request->title);
        $data['added_by'] = $request->user()->id;
        $data['is_parent'] = $request->input('is_parent', 0);
        $this->category->fill($data);
        $success = $this->category->save();
        if($success){
            $request->session()->flash('success','Category added successfully.');
        } else {
            $request->session()->flash('error','Sorry! Category could not be added at this moment.');
        }
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $this->category = $this->category->getCategoryBySlug($slug);
        if(!$this->category){
            abort(404);
        }
        return view('front.category-list')
            ->with('all_products',$this->category->category_products)
            ->with('category',$this->category);
    }
    public function subCategoryShow($slug, $sub_slug){
        $this->category = $this->category->getSubCategoryBySlug($sub_slug);
        if(!$this->category){
            abort(404);
        }
        return view('front.category-list')
            ->with('all_products',$this->category->sub_category_products)
            ->with('category',$this->category);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->category = $this->category->find($id);
        if(!$this->category){
            request()->session()->flash('error','Category does not exists');
            return redirect()->route('category.index');
        }

        $parent_cats = $this->category->getAllParents();
        return view('admin.pages.category-form')
            ->with('category_data',$this->category)
            ->with('parent_cats',$parent_cats);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->category = $this->category->find($id);
        if(!$this->category){
            request()->session()->flash('error','Category does not exists');
            return redirect()->route('category.index');
        }

        $rules = $this->category->getAddRules('update');
        $request->validate($rules);

        $data = $request->all();
        $data['is_parent'] = $request->input('is_parent', 0);

        $data['parent_id'] = ($data['is_parent'] == 1) ? null : $request->parent_id;
        // dd($data);

        $this->category->fill($data);
        $success = $this->category->save();
        if($success){
            $request->session()->flash('success','Category updated successfully.');
        } else {
            $request->session()->flash('error','Sorry! Category could not be updated at this moment.');
        }
        return redirect()->route('category.index');
    }

    public function getChildCategory(Request $request){
        $child_cats = $this->category->where('parent_id',$request->id)->pluck('title','id');
        if($child_cats->count() > 0) {
            return response()->json(['status' => true, 'data' => $child_cats]);
        } else {
            return response()->json(['status' => false, 'data' => []]);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->category = $this->category->find($id);
        if(!$this->category){
            request()->session()->flash('error','Category does not exists');
            return redirect()->route('category.index');
        }
        $child_id = $this->category->where('parent_id',$id)->pluck('id');
        // dd($child_id);
        $success = $this->category->delete();
        if($success){
            $this->category->shiftChild($child_id);
            request()->session()->flash('success','Category deleted successfully.');
        } else {
            request()->session()->flash('error','Problem while deleting category.');
        }
        return redirect()->route('category.index');
    }
}
