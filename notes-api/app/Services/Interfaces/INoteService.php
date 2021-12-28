<?php

namespace App\Services\Interfaces;

use App\Models\Note;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;


interface INoteService
{
    public function getNote($id): Note|null;

    public function createNote($userId, $title, $note): Note|Model;

    public function listNotesByUser($userId): Collection|null;

    public function updateNote($noteId, $title, $note): Note|Model;

    public function searchNote($title):Collection|null;
}
