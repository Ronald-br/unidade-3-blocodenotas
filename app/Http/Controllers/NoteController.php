<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Models\Audit;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class NoteController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Note::class);

        $query = Note::where('user_id', auth()->id());

        // Busca por título
        if ($request->filled('busca')) {
            $query->where('titulo', 'like', '%' . $request->busca . '%');
        }

        // Filtro por data inicial
        if ($request->filled('data_inicio')) {
            $query->whereDate('created_at', '>=', $request->data_inicio);
        }

        // Filtro por data final
        if ($request->filled('data_fim')) {
            $query->whereDate('created_at', '<=', $request->data_fim);
        }

        // Paginação
        $notes = $query
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('notes.index', compact('notes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Note::class);

        return view('notes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NoteRequest $request)
    {
        $this->authorize('create', Note::class);

        $note = Note::create([
            'user_id' => auth()->id(),
            'titulo' => $request->titulo,
            'conteudo' => $request->conteudo,
        ]);

        Audit::create([
            'user_id' => auth()->id(),
            'note_id' => $note->id,
            'acao' => 'criação',
            'descricao' => 'Nota criada.',
        ]);

        return redirect()->route('notes.index')
            ->with('success', 'Nota criada com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        $this->authorize('view', $note);

        return view('notes.show', compact('note'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        $this->authorize('update', $note);

        return view('notes.edit', compact('note'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NoteRequest $request, Note $note)
    {
        $this->authorize('update', $note);

        $note->update([
            'titulo' => $request->titulo,
            'conteudo' => $request->conteudo,
        ]);

        Audit::create([
            'user_id' => auth()->id(),
            'note_id' => $note->id,
            'acao' => 'edição',
            'descricao' => 'Nota editada.',
        ]);

        return redirect()->route('notes.index')
            ->with('success', 'Nota atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        $this->authorize('delete', $note);

        $note->delete();

        Audit::create([
            'user_id' => auth()->id(),
            'note_id' => $note->id,
            'acao' => 'exclusão',
            'descricao' => 'Nota enviada para a lixeira.',
        ]);

        return redirect()->route('notes.index')
            ->with('success', 'Nota enviada para a lixeira.');
    }

    /**
     * Display the trashed notes.
     */
    public function trash()
    {
        $notes = Note::onlyTrashed()
            ->where('user_id', auth()->id())
            ->latest('deleted_at')
            ->get();

        return view('notes.trash', compact('notes'));
    }

    /**
     * Restore a trashed note.
     */
    public function restore($id)
    {
        $note = Note::onlyTrashed()
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        $this->authorize('restore', $note);

        $note->restore();

        Audit::create([
            'user_id' => auth()->id(),
            'note_id' => $note->id,
            'acao' => 'restauração',
            'descricao' => 'Nota restaurada da lixeira.',
        ]);

        return redirect()->route('notes.trash')
            ->with('success', 'Nota restaurada com sucesso.');
    }

    /**
     * Permanently delete a trashed note.
     */
    public function forceDelete($id)
    {
        $note = Note::onlyTrashed()
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        $this->authorize('forceDelete', $note);

        $noteId = $note->id;

        $note->forceDelete();

        Audit::create([
            'user_id' => auth()->id(),
            'note_id' => null,
            'acao' => 'exclusão permanente',
            'descricao' => "Nota ID {$noteId} excluída permanentemente.",
        ]);

        return redirect()->route('notes.trash')
            ->with('success', 'Nota excluída permanentemente.');
    }
}