<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edycja zwierzaka
        </h2>
    </x-slot>

    <div class="container py-12">
        @if(!empty($error))
        <div class="row">
            <div class="col-6">
                <h3 class="text-danger">Błąd</h3>
                <div class="alert alert-danger">{{ $error }}</div>
            </div>
        </div>
        @endif
        <form action="{{ route('pet.update', $pet['id']) }}" method="POST">
            @csrf 
            <div class="row">
                <h1><strong>Formularz edycji zwierzaka</strong></h1><hr>
                <div class="col-md-6 mb-4">
                    <input type="hidden" name="id" value="{{ $pet['id'] }}">
                    <div class="mb-3" style="padding-top: 1.5rem;">
                        <label for="nameUpdate" class="form-label">Imię zwierzaka</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="nameUpdate" name="name" value="{{ old('name', $pet['name'] ?? '') }}" required>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="mb-3">
                        <label for="statusUpdate" class="form-label">Status</label>
                        <select class="form-select @error('status') is-invalid @enderror" id="statusUpdate" name="status" required>
                            <option value="">-- wybierz --</option>
                            <option value="available" {{ old('status', $pet['status'] ?? '')==='available' ? 'selected' : '' }}>
                                dostępny
                            </option>
                            <option value="pending" {{ old('status', $pet['status'] ?? '')==='pending' ? 'selected' : '' }}>
                                w toku
                            </option>
                            <option value="sold" {{ old('status', $pet['status'] ?? '')==='sold' ? 'selected' : '' }}>
                                sprzedany
                            </option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Zaktualizuj zwierzaka</button>
        </form>
    </div>
</x-app-layout>