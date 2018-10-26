<?php

namespace App\Http\Controllers;

use App\Content;
use App\Section;
use Illuminate\Http\Request;

class ContentController extends Controller
{

    public function edit(Section $section)
    {
        return view('contents.edit', compact('section'));
    }

    public function update(Request $request, Section $section)
    {
        $request->validate(['position'=>'required']);
        $result = self::prepare($request->all(), $section->id);
        Content::insert($result);
        return back()->withMessage('اطلاعات وارد شده ثبت شد.');
    }

    public function destroy(Section $section)
    {
        //
    }

    public static function prepare($data, $section_id)
    {
        $result = [];
        foreach ($data as $key => $array) {
            if (is_array($array)) {
                foreach ($array as $i => $value) {
                    $result[$i][$key] = $value;
                    $result[$i]['section_id'] = $section_id;
                }
            }
        }
        return $result;
    }
}
