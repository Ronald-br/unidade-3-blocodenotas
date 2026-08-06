<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Criar Nova Nota
        </h2>
    </x-slot>


    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900 dark:text-gray-100">


                    <form action="{{ route('notes.store') }}" method="POST">

                        @csrf


                        <div class="mb-4">

                            <label class="block mb-2">
                                Título
                            </label>

                            <input 
                                type="text"
                                name="titulo"
                                class="border rounded w-full p-2 text-black"
                                required
                            >

                        </div>



                        <div class="mb-4">

                            <label class="block mb-2">
                                Conteúdo
                            </label>

                            <textarea
                                name="conteudo"
                                class="border rounded w-full p-2 text-black"
                                rows="5"
                                required
                            ></textarea>

                        </div>



                        <button 
                            type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">

                            Salvar Nota

                        </button>


                    </form>


                </div>

            </div>

        </div>

    </div>


</x-app-layout>