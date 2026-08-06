<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Editar Nota
        </h2>
    </x-slot>


    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900 dark:text-gray-100">


                    <form action="{{ route('notes.update', $note) }}" method="POST">

                        @csrf
                        @method('PUT')


                        <div class="mb-4">

                            <label class="block mb-2">
                                Título
                            </label>

                            <input type="text"
                                   name="titulo"
                                   value="{{ $note->titulo }}"
                                   class="w-full border rounded p-2 text-black">

                        </div>


                        <div class="mb-4">

                            <label class="block mb-2">
                                Conteúdo
                            </label>

                            <textarea name="conteudo"
                                      class="w-full border rounded p-2 text-black"
                                      rows="5">{{ $note->conteudo }}</textarea>

                        </div>


                        <button type="submit"
                                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">

                            Salvar Alterações

                        </button>


                    </form>


                </div>

            </div>

        </div>

    </div>

</x-app-layout>