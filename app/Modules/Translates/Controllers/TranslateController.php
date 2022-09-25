<?php

namespace Translates\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Translates\Models\Translate;

class TranslateController extends Controller
{
    public $path;

    public function __construct()
    {
        $this->middleware('auth');
        $this->path = 'Translates::';
    }

    public function index()
    {
        $title = transWord('Languages');
        $lang = \Lang::getLocale();
        $pages = [
            [transWord('Languages'),'langs'],
            [$lang,'langs'],
        ];
        $langs = Translate::where('key',$lang)->get();
        return view($this->path.'index',compact('langs','pages','title'));
    }

    public function save(Request $request)
    {
        $lang = \Lang::getLocale();
        if (isset($request->trans)) {
            for ($i=0; $i < count($request->trans); $i++) {
                $trans = Translate::where('id',$request->ids[$i])->where('key',$lang)->get()->first();
                $trans->translation = $request->trans[$i];
                $trans->save();
            }
        }
        return back()->with('success','');
    }

    public function addNew(Request $request)
    {
        $lang = \Lang::getLocale();
        $trans = new Translate();
        $trans->key = $lang;
        $trans->word = $request->word;
        $trans->translation = $request->translation;
        $trans->save();
        return back()->with('success','');
    }
}
