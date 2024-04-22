<?php

namespace App\Http\Services\Menu;

use Illuminate\Support\Str;
use App\Models\Menu;
use Illuminate\Support\Facades\Session;

// use Exception;

class MenuService
{
    public function getParent()
    {
        return Menu::where('parent_id', 0)->get();
    }

    public function show()
    {
        return Menu::select('name','id')
            ->where('parent_id', 0)
            ->orderbyDesc('id')
            ->get();
    }

    public function getAll()
    {
        return Menu::orderbyDesc('id')->paginate(20);
    }

    // public function get($parent_id = 1) //gộp 
    // {
    //     return Menu::
    //         when($parent_id == 0, function($query) use ($parent_id) {
    //           $query->where('parent_id', $parent_id);  
    //         })
    //         ->get();
    // }

    public function create($request)
    {
        try{ 
            // Check if the slug already exists in the database
            $slug = Str::slug($request->input('name'), '-');
            if (Menu::where('slug', $slug)->exists()) {
                throw new \Exception('Slug đã có rồi. Vui lòng chọn từ khác.');
            }

            // Create the menu record
            Menu::create([
                'name' => (string) $request->input('name'),
                'parent_id' => (int) $request->input('parent_id'),
                'description' => (string) $request->input('description'),
                'content' => (string) $request->input('content'),
                'active' => (string) $request->input('active'),
                'slug' => $slug,
            ]);

            Session::flash('success', 'Tạo danh mục thành công');

        }catch(\Exception $err){
            Session::flash('error', $err->getMessage());
            return false;
        }

        return true;
    }

    public function update($request, $menu) : bool
    {
        // $menu->fill($request->input());

        if ($request->input('parent_id') != $menu->id) {
            $menu->parent_id = (int)$request->input('parent_id');
        }

        $menu->name = (string) $request->input('name');
        $menu->description = (string) $request->input('description');
        $menu->content = (string) $request->input('content');
        $menu->active = (string) $request->input('active');
        $menu->slug = Str::slug($request->input('name'), '-');
        $menu->save();

        Session::flash('success','Cập nhật thành công danh mục');
        return true;
    }

    public function destroy($request)
    {
        $id = (int)$request->input('id');
        $menu = Menu::where('id', $id)->first();
        if ($menu) {
            return Menu::where('id', $id)->orWhere('parent_id', $id)->delete();
        }

        return false;
    }

    public function getId($id)
    {
        return Menu::where('id', $id)->where('active', 1)->firstOrFail();
    }

    public function getProduct($menu, $request)
    {
        $query = $menu->products()
            ->select('id', 'name', 'price', 'price_sale', 'thumb')
            ->where('active', 1);

        if ($request->input('price')) {
            $query->orderBy('price_sale', $request->input('price'));
        }

        return $query
            ->orderByDesc('id')
            ->paginate(12)
            ->withQueryString();
    }
}