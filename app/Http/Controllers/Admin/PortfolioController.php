<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;

class PortfolioController extends Controller
{
    public function index(Request $request)
    {
        $data = Portfolio::orderBy('id', 'DESC')->get();
        return view('backEnd.portfolio.index', compact('data'));
    }
    public function create()
    {
        return view('backEnd.portfolio.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'image_one' => 'required',
            'image_two' => 'required',
            'status' => 'required',
        ]);
        // image with intervention
        $imageOne = $request->file('image_one');
        if ($imageOne) {
            $name =  time() . '-' . $imageOne->getClientOriginalName();
            $name = preg_replace('"\.(jpg|jpeg|png|webp)$"', '.webp', $name);
            $name = strtolower(preg_replace('/\s+/', '-', $name));
            $uploadpath = 'public/uploads/portfolio/';
            $imageOneUrl = $uploadpath . $name;
            $img = Image::make($imageOne->getRealPath());
            $img->encode('webp', 90);
            $width = "400";
            $height = "400";
            $img->height() > $img->width() ? $width = null : $height = null;
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($imageOneUrl);
        } else {
            $imageOneUrl = null;
        }
        // image two with intervention
        $imageTwo = $request->file('image_two');
        // image two as PDF upload
        $pdfFile = $request->file('image_two');
        if ($pdfFile) {
            $name = time() . '-' . $pdfFile->getClientOriginalName();
            $name = strtolower(preg_replace('/\s+/', '-', $name)); // Remove spaces
            $uploadpath = 'public/uploads/portfolio/';
            $pdfUrl = $uploadpath . $name;

            // Validate and move PDF file
            if ($pdfFile->getClientOriginalExtension() === 'pdf') {
                $pdfFile->move($uploadpath, $name);
            } else {
                Toastr::error('Error', 'Only PDF files are allowed');
                return redirect()->back();
            }
        } else {
            $pdfUrl = null;
        }

        $input = $request->all();
        $input['image_one'] = $imageOneUrl;
        $input['image_two'] = $pdfUrl;
        Portfolio::create($input);
        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('portfolios.index');
    }

    public function edit($id)
    {
        $edit_data = Portfolio::find($id);
        return view('backEnd.portfolio.edit', compact('edit_data'));
    }

    public function update(Request $request)
    {
        $update_data = Portfolio::find($request->id);
        $input = $request->all();
        $imageOne = $request->file('image_one');
        if ($imageOne) {
            // image with intervention
            $name =  time() . '-' . $imageOne->getClientOriginalName();
            $name = preg_replace('"\.(jpg|jpeg|png|webp)$"', '.webp', $name);
            $name = strtolower(preg_replace('/\s+/', '-', $name));
            $uploadpath = 'public/uploads/portfolio/';
            $imageOneUrl = $uploadpath . $name;
            $img = Image::make($imageOne->getRealPath());
            $img->encode('webp', 90);
            $width = "400";
            $height = "400";
            $img->height() > $img->width() ? $width = null : $height = null;
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
            File::delete($update_data->image_one);
            $img->save($imageOneUrl);
            $input['image_one'] = $imageOneUrl;
        } else {
            $input['image_one'] = $update_data->image_one;
        }
        $pdfFile = $request->file('image_two');
        if ($pdfFile) {
            // Handle PDF upload
            $name = time() . '-' . $pdfFile->getClientOriginalName();
            $name = strtolower(preg_replace('/\s+/', '-', $name)); // Remove spaces
            $uploadpath = 'public/uploads/portfolio/';
            $pdfUrl = $uploadpath . $name;

            // Validate and move PDF file
            if ($pdfFile->getClientOriginalExtension() === 'pdf') {
                File::delete($update_data->image_two); // Delete old file if exists
                $pdfFile->move($uploadpath, $name);
                $input['image_two'] = $pdfUrl;
            } else {
                Toastr::error('Error', 'Only PDF files are allowed');
                return redirect()->back();
            }
        } else {
            $input['image_two'] = $update_data->image_two;
        }

        $input['status'] = $request->status ? 1 : 0;
        $update_data->update($input);
        Toastr::success('Success', 'Data update successfully');
        return redirect()->route('portfolios.index');
    }

    public function inactive(Request $request)
    {
        $inactive = Portfolio::find($request->hidden_id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success', 'Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = Portfolio::find($request->hidden_id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success', 'Data active successfully');
        return redirect()->back();
    }
    public function destroy(Request $request)
    {
        $delete_data = Portfolio::find($request->hidden_id);
        File::delete($delete_data->image);
        $delete_data->delete();
        Toastr::success('Success', 'Data delete successfully');
        return redirect()->back();
    }
}
