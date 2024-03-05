<div>
    <div class="col-md-8 offset-md-2 mb-2">
        <div class="card">
            <div class="card-title text-center mt-3 mb-0">
                <h3 class="mb-0">Categorias</h3>
            </div>
            <div class="card-body">
                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session()->get('success') }}
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session()->get('error') }}
                    </div>
                @endif
                @if ($updateCategory)
                    @include('livewire.category.update')
                @else
                    @include('livewire.category.create')
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($categories) > 0)
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>
                                            {{ $category->name }}
                                        </td>
                                        <td>
                                            {{ $category->description }}
                                        </td>
                                        <td>
                                            <button wire:click="edit({{ $category->id }})"
                                                class="btn btn-primary btn-sm">Editar</button>
                                            <button onclick="deleteCategory({{ $category->id }})"
                                                class="btn btn-danger btn-sm">Deletar</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3" align="center">
                                        Nenhuma categoria encontrada.
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        function deleteCategory(id) {
            if (confirm("Tem certeza que deseja deletar a categoria?"))
                window.livewire.emit('deleteCategory', id);
        }
    </script>
</div>
