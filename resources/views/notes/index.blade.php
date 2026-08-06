<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Minhas Notas
        </h2>
    </x-slot>


    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900 dark:text-gray-100">


                    <a href="{{ route('notes.create') }}"
                       class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">

                        + Nova Nota

                    </a>


                    @if($notes->count() > 0)


                        @foreach($notes as $note)

                            <div class="border dark:border-gray-600 p-4 mb-4 rounded">


                                <h3 class="text-lg font-bold">
                                    {{ $note->titulo }}
                                </h3>


                                <p class="mt-2">
                                    {{ $note->conteudo }}
                                </p>


                                <p class="text-sm mt-2">
                                    Criada em:
                                    {{ $note->created_at->format('d/m/Y H:i') }}
                                </p>


                                <div class="mt-4 flex gap-2">


                                    <a href="{{ route('notes.show', $note) }}"
                                       class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded">

                                        Ver

                                    </a>


                                    <a href="{{ route('notes.edit', $note) }}"
                                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded">

                                        Editar

                                    </a>


                                    <form action="{{ route('notes.destroy', $note) }}"
                                          method="POST">

                                        @csrf
                                        @method('DELETE')


                                        <button type="submit"
                                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded">

                                            Excluir

                                        </button>


                                    </form>


                                </div>


                            </div>


                        @endforeach


                    @else


                        <p>
                            Nenhuma nota cadastrada.
                        </p>


                    @endif


                </div>

            </div>

        </div>

    </div>


</x-app-layout>