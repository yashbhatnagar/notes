<?php

namespace App\Http\Controllers\v1;

use App\Models\Note;
use App\Services\Interfaces\INoteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotesController extends Controller
{
    private INoteService $noteService;


    public function __construct(
        INoteService $noteService
    )
    {
        $this->noteService = $noteService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //TODO: authorize
        $userId = Auth::user()->id;
        $notes = $this->noteService->listNotes($userId);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //TODO: authorize
        $userId = Auth::user()->id;

        $request->validate([
            'title' => 'required|string|max:50',
            'note' => 'sometimes|string|max:1000|nullable'
        ]);

        $title = $request->input('title');
        $note = $request->input('note');

        return $this->noteService->createNote($userId, $title, $note);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $note = $this->noteService->getNote($id);
        if(is_null($note))
        {
            $error = [
                'message' => 'Note not found.'
            ];

            return response()->json($error, 400);
        }

        return response()->json($note, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //TODO: authorize
        $request->validate([
            'title' => 'required|string|max:50',
            'note' => 'sometimes|string|max:1000|nullable'
        ]);

        $title = $request->input('title');
        $note = $request->input('note');

        return $this->noteService->updateNote($id, $title, $note);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        //TODO: authorize
        $done = Note::destroy($id);
        $response = ['message' => 'There was an issue performing the request'];
        if ($done && $done == '1') {
            $response = [
                'message' => 'Success'
                ];
            return response()->json($response, 200);
        }
        return response()->json($response, 200);
    }

    /**
     * Search for a note by title
     *
     * @param  string  $title
     * @return \Illuminate\Http\Response
     */
    public function search($title)
    {
        //TODO: authorize
        return $this->noteService->searchNote($title);
    }
}
