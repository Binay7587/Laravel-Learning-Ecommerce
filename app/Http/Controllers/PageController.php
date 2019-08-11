<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    protected $page = null;
    public function __construct(Page $page)
    {
        $this->page = $page;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->page = $this->page->get();
        return view('admin.pages.pages')->with('page_data',$this->page);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->page = $this->page->find($id);
        if(!$this->page){
            request()->session()->flash('error','Page not found.');
            return redirect()->route('pages.index');
        }

        return view('admin.pages.page-form')->with('page_content',$this->page);
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
        $this->page = $this->page->find($id);
        if(!$this->page){
            $request->session()->flash('error','Page does not exists.');
            return redirect()->back();
        }
        $rules = array(
            'summary' => 'required|string|min:100',
            'description' => 'required|string',
            'image' => 'required|string'
        );

        $request->validate($rules);
        $data = $request->all();
        $this->page->fill($data);
        $status = $this->page->save();
        if($status){
            $request->session()->flash('success','Page updated successfully.');
        }else {
            $request->session()->flash('error','Sorry! There was problem while updating page content.');
        }
        return redirect()->route('pages.index');
    }

    public function getHelpAndFaq(){
        $this->page = $this->page->where('slug','help-and-faq')->first();
        return view('front.help-faq')->with('content',$this->page);
    }

    public function getAboutUs(){
        $this->page = $this->page->where('slug','about-us')->first();
        return view('front.help-faq')->with('content',$this->page);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
