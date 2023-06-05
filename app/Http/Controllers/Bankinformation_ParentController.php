<?php

namespace App\Http\Controllers;

use App\Models\Bankinformation_Parent;
use Illuminate\Http\Request;

class Bankinformation_ParentController extends Controller
{
    public function index()
    {
        $bankinfoParent = Bankinformation_Parent::with('parent')->get();
        return response()->json($bankinfoParent);
    }
    public function getBankInfoByParentId($parentId)
    {
        $bankinfoParent = Bankinformation_Parent::where('parent_id', $parentId)->first();

        if ($bankinfoParent) {
            return response()->json($bankinfoParent->id);
        } else {
            return response()->json(['message' => 'Bank information not found'], 404);
        }
    }
    

}
