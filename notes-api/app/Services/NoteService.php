<?php

namespace App\Services;

use App\Models\Note;
use App\Services\Interfaces\INoteService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class NoteService implements INoteService
{
    public function getNote($id): Note|null
    {
        return Note::query()->find($id);
    }
    // Not being used currently.
    public function listNotesByUser($userId): Collection|null
    {
        return Note::whereUserId($userId)->get();
    }

    public function searchNote($title): Collection|null
    {
        $userId = Auth::user()->id;
        return Note::where([
                ['title', 'like', '%' . $title . '%'],
                ['user_id', '=', $userId]
            ]
        )
            ->get();
    }

    public function createNote($userId, $title, $note): Note|Model
    {
        return Note::create([
            'user_id' => $userId,
            'note' => $note,
            'title' => $title
        ]);
    }

    public function updateNote($noteId, $title, $note): Note|Model
    {
        Note::findOrFail($noteId);
        $userId = Auth::user()->id;
        Note::whereId($noteId)->update(['title' => $title, 'note' => $note, 'user_id' => $userId]);
        $note = Note::find($noteId);
        return $note;
    }
}
