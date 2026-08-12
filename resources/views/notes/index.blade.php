@extends('layouts.master')

@section('title', 'Minhas Notas')

@section('content')

    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg">

        <div class="p-6 text-gray-900 dark:text-gray-100">

            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex gap-3 mb-6">

                <a href="{{ route('notes.create') }}"
                   class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    + Nova Nota
                </a>

                <a href="{{ route('notes.trash') }}"
                   class="inline-block bg-gray-700 hover:bg-gray-800 text-white font-bold py-2 px-4 rounded">
                    🗑️ Lixeira
                </a>

            </div>

            {{-- Busca e filtros --}}
            <form method="GET" action="{{ route('notes.index') }}" class="mb-8">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                    <div>
                        <label for="busca" class="block font-medium mb-1">
                            Buscar por título
                        </label>

                        <input
                            type="text"
                            id="busca"
                            name="busca"
                            value="{{ request('busca') }}"
                            placeholder="Digite o título..."
                            class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm"
                        >
                    </div>

                    <div>
                        <label for="data_inicio" class="block font-medium mb-1">
                            Data inicial
                        </label>

                        <input
                            type="date"
                            id="data_inicio"
                            name="data_inicio"
                            value="{{ request('data_inicio') }}"
                            class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm"
                        >
                    </div>

                    <div>
                        <label for="data_fim" class="block font-medium mb-1">
                            Data final
                        </label>

                        <input
                            type="date"
                            id="data_fim"
                            name="data_fim"
                            value="{{ request('data_fim') }}"
                            class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm"
                        >
                    </div>

                </div>

                <div class="flex gap-3 mt-4">

                    <button
                        type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Buscar / Filtrar
                    </button>

                    <a
                        href="{{ route('notes.index') }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                        Limpar
                    </a>

                </div>

            </form>

            {{-- Lista de notas --}}
            @if($notes->count() > 0)

                @foreach($notes as $note)

                    <div class="border dark:border-gray-600 p-4 mb-4 rounded">

                        <h3 class="text-lg font-bold">
                            {{ $note->titulo }}
                        </h3>

                        <p class="mt-2">
                            {{ $note->conteudo }}
                        </p>

                        <div class="text-sm mt-3 space-y-1">

                            <p>
                                Criada em:
                                {{ $note->created_at->format('d/m/Y H:i') }}
                            </p>

                            <p>
                                Atualizada em:
                                {{ $note->updated_at->format('d/m/Y H:i') }}
                            </p>

                        </div>

                        <div class="mt-4 flex gap-2">

                            <a href="{{ route('notes.show', $note) }}"
                               class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded">
                                Ver
                            </a>

                            <a href="{{ route('notes.edit', $note) }}"
                               class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded">
                                Editar
                            </a>

                            <form action="{{ route('notes.destroy', $note) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded">
                                    Excluir
                                </button>
                            </form>

                        </div>

                    </div>

                @endforeach

                <div class="mt-6">
                    {{ $notes->links() }}
                </div>

            @else

                <p>Nenhuma nota encontrada.</p>

            @endif

        </div>

    </div>

@endsection