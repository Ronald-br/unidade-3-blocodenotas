<x-app-layout>

```
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Lixeira
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg">

            <div class="p-6 text-gray-900 dark:text-gray-100">

                <a href="{{ route('notes.index') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded mb-4 inline-block">
                    ← Voltar para Minhas Notas
                </a>

                @forelse($notes as $note)

                    <div class="border dark:border-gray-600 rounded p-4 mb-4">

                        <h3 class="text-lg font-bold">
                            {{ $note->titulo }}
                        </h3>

                        <p class="text-sm text-gray-500 mt-2">
                            Excluída em:
                            {{ $note->deleted_at->format('d/m/Y H:i') }}
                        </p>

                        <div class="flex gap-2 mt-4">

                            <form action="{{ route('notes.restore', $note->id) }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <button
                                    type="submit"
                                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                                    Restaurar
                                </button>
                            </form>

                            <form action="{{ route('notes.forceDelete', $note->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                                    Excluir Permanentemente
                                </button>
                            </form>

                        </div>

                    </div>

                @empty

                    <p>Nenhuma nota na lixeira.</p>

                @endforelse

            </div>

        </div>

    </div>
</div>
```

</x-app-layout>
