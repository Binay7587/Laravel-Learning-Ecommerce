<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    protected $banner = null;

    public function  __construct(Banner $banner)
    {
        $this->banner = $banner;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->banner = $this->banner->orderBy('id', 'DESC')->get();

        return view('admin.pages.banner')->with('banner_data', $this->banner);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.banner-form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = $this->banner->getRules();
        $request->validate($rules);

        $data= $request->all();
        $data['added_by'] = $request->user()->id;
        $this->banner->fill($data);
        $success = $this->banner->save();
        if($success){
            $request->session()->flash('success','Banner added successfully.');
        } else {
            $request->session()->flash('error','Sorry! There was problem while adding banner.');
        }
        return redirect()->route('banner.index');
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

        $this->banner = $this->banner->find($id);
        if(!$this->banner){
            request()->session()->flash('error','Banner does not exists.');
            return redirect()->route('banner.index');
        }
        return view('admin.pages.banner-form')->with('banner_data', $this->banner);
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
        $this->banner = $this->banner->find($id);
        if(!$this->banner){
            request()->session()->flash('error','Banner does not exists.');
            return redirect()->route('banner.index');
        }

        $rules = $this->banner->getRules();
        $request->validate($rules);

        $data= $request->all();

        $this->banner->fill($data);

        $success = $this->banner->save();

        if($success){
            $request->session()->flash('success','Banner updated successfully.');
        } else {
            $request->session()->flash('error','Sorry! There was problem while updating banner.');
        }
        return redirect()->route('banner.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->banner = $this->banner->find($id);
        if(!$this->banner){
            request()->session()->flash('error','Banner does not exists.');
            return redirect()->route('banner.index');
        }

        $success = $this->banner->delete();
        if($success){
            request()->session()->flash('success','Banner deleted successfully.');
        } else {
            request()->session()->flash('error','Banner could not be deleted at this moment.');
        }
        return redirect()->route('banner.index');
    }
}
