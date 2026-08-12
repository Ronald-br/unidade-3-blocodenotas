@extends('layouts.master')

@section('title', 'Visualizar Nota')

@section('content')

    <div class="max-w-4xl mx-auto">

        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg">

            <div class="p-6 text-gray-900 dark:text-gray-100">

                <h1 class="text-2xl font-bold mb-4">
                    {{ $note->titulo }}
                </h1>

                <div class="mb-6">
                    <p class="whitespace-pre-line">
                        {{ $note->conteudo }}
                    </p>
                </div>

                <div class="text-sm text-gray-500 dark:text-gray-400 mb-6 space-y-1">
                    <p>
                        Criada em:
                        {{ $note->created_at->format('d/m/Y H:i') }}
                    </p>

                    <p>
                        Atualizada em:
                        {{ $note->updated_at->format('d/m/Y H:i') }}
                    </p>
                </div>

                <div class="flex gap-3">

                    <a
                        href="{{ route('notes.edit', $note) }}"
                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                        Editar
                    </a>

                    <a
                        href="{{ route('notes.index') }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                        Voltar
                    </a>

                </div>

            </div>

        </div>

    </div>

@endsection