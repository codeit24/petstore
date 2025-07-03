<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if(!empty($error))
            <div class="alert alert-danger">{{ $error }}</div>
        @endif

        <div class="container py-4 bg-dark text-light">
            <div class="row">
                <div class="col-md-6 mb-4 text-left">
                    <h1><strong>Lista zwierząt</strong></h1>
                </div>
                <div class="col-md-6 mb-4 d-grid justify-content-md-end">
                    <a href="{{ route('pet.form') }}" class="btn btn-primary mb-3">Dodaj zwierzaka</a>
                </div>
            </div>
            <table id="petsTable" class="display table table-striped" style="width:100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nazwa</th>
                    <th>Status</th>
                    <th>Akcje</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($pets as $pet)
                        <tr>
                            <td>{{ $pet['id'] }}</td>
                            <td>{{ $pet['name'] ?? '—' }}</td>
                            <td>{{ $pet['status'] ?? '—' }}</td>
                            <td class="d-grid justify-content-md-end">
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="{{ route('pet.update.form', $pet['id']) }}" class="btn btn-sm btn-warning">Edytuj</a>
                                    </div>
                                    <div class="col-md-6">
                                        <form action="{{ route('pet.destroy', $pet['id']) }}" method="POST" style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Na pewno usunąć?')">Usuń</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>