@extends('layouts.master')

@section('title', 'Editar Nota')

@section('content')

    <div class="max-w-3xl mx-auto">

        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg">

            <div class="p-6 text-gray-900 dark:text-gray-100">

                <h2 class="text-2xl font-bold mb-6">
                    Editar Nota
                </h2>

                @if($errors->any())
                    <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('notes.update', $note) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="mb-4">

                        <label
                            for="titulo"
                            class="block font-medium mb-2">
                            Título
                        </label>

                        <input
                            type="text"
                            id="titulo"
                            name="titulo"
                            value="{{ old('titulo', $note->titulo) }}"
                            class="w-full border rounded p-2 text-black"
                            required
                        >

                    </div>

                    <div class="mb-4">

                        <label
                            for="conteudo"
                            class="block font-medium mb-2">
                            Conteúdo
                        </label>

                        <textarea
                            id="conteudo"
                            name="conteudo"
                            class="w-full border rounded p-2 text-black"
                            rows="5"
                            required
                        >{{ old('conteudo', $note->conteudo) }}</textarea>

                    </div>

                    <div class="flex gap-3">

                        <button
                            type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                            Salvar Alterações
                        </button>

                        <a
                            href="{{ route('notes.index') }}"
                            class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                            Cancelar
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection