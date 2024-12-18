<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PointReedemRequest;
use App\Models\ReedemCode;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class CodeReedemController extends Controller
{
    private ReedemCode $reedemCode;

    public function __construct(ReedemCode $reedemCode)
    {
        $this->reedemCode = $reedemCode;
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        $reedemCodes = $this->reedemCode
            ->when($search, function ($query, $search) {
                return $query
                    ->where('points', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%");
            })
            ->with('user')
            ->paginate(10); // 10 items per page

        return view('pages.admin.code-reedem.index', compact('reedemCodes', 'search'));
    }


    public function store(PointReedemRequest $request)
    {
        $validated = $request->validated();

        $this->reedemCode->create([
            'code' => Uuid::uuid4(),
            'points' => $validated['points'],
        ]);

        return response()->json([
            'message' => 'Code reedem created',
            'status' => 'success',
        ]);
    }

    public function deleteCode($codeId)
    {
        $reedemCode = $this->reedemCode->find($codeId);
        $reedemCode->delete();

        return response()->json([
            'message' => 'Code reedem deleted',
            'status' => 'success',
        ]);
    }
}
