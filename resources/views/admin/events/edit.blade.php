@extends('layouts.app')

@section('content')

<style>
    .edit-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        background: #ffffff;
    }

    .edit-card-header {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        padding: 1.5rem 2rem;
        border: none;
    }

    .form-label {
        font-weight: 600;
        font-size: 0.875rem;
        color: #334155;
        margin-bottom: 0.4rem;
    }

    .input-group-text {
        background-color: #f8fafc;
        border-color: #e2e8f0;
        color: #64748b;
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
    }

    .form-control {
        border-color: #e2e8f0;
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
        padding: 0.65rem 0.9rem;
        font-size: 0.95rem;
        transition: all 0.2s ease;
    }

    /* Standard inputs without group icons */
    textarea.form-control {
        border-radius: 10px;
    }

    .form-control:focus {
        border-color: #f59e0b;
        box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.15);
    }

    .btn-update {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        border: none;
        border-radius: 10px;
        padding: 0.65rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-update:hover {
        background: linear-gradient(135deg, #d97706, #b45309);
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(217, 119, 6, 0.3);
    }

    .btn-back {
        border-radius: 10px;
        padding: 0.65rem 1.25rem;
        font-weight: 500;
        background-color: #f1f5f9;
        color: #475569;
        border: 1px solid #e2e8f0;
        transition: all 0.2s ease;
    }

    .btn-back:hover {
        background-color: #e2e8f0;
        color: #1e293b;
    }
</style>

<div class="row justify-content-center py-4">
    <div class="col-lg-9 col-md-10">

        <div class="card edit-card">

            <!-- Card Header -->
            <div class="edit-card-header text-white d-flex align-items-center">
                <div class="bg-white bg-opacity-20 rounded-circle p-2 me-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                    <i class="bi bi-pencil-square fs-4 text-white"></i>
                </div>
                <div>
                    <h4 class="fw-bold mb-0">Modifier l'événement</h4>
                    <p class="mb-0 text-white-50 small">Mettez à jour les informations de cet événement</p>
                </div>
            </div>

            <!-- Card Body -->
            <div class="card-body p-4 p-md-5">

                <form action="{{ route('admin.events.update', $event) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Titre -->
                    <div class="mb-4">
                        <label class="form-label">Titre de l'événement</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-type"></i></span>
                            <input type="text"
                                   name="titre"
                                   class="form-control @error('titre') is-invalid @enderror"
                                   placeholder="Titre de l'événement"
                                   value="{{ old('titre', $event->titre) }}">
                            @error('titre')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label class="form-label">Description détaillée</label>
                        <textarea
                            name="description"
                            rows="4"
                            placeholder="Description de l'événement..."
                            class="form-control @error('description') is-invalid @enderror">{{ old('description', $event->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback d-block mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Date & Heure Row -->
                    <div class="row">
                        <!-- Date -->
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Date</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-calendar3"></i></span>
                                <input type="date"
                                       name="date"
                                       class="form-control @error('date') is-invalid @enderror"
                                       value="{{ old('date', $event->date) }}">
                                @error('date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Heure -->
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Heure de début</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-clock"></i></span>
                                <input type="time"
                                       name="heure"
                                       class="form-control @error('heure') is-invalid @enderror"
                                       value="{{ old('heure', $event->heure) }}">
                                @error('heure')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Lieu -->
                    <div class="mb-4">
                        <label class="form-label">Lieu / Emplacement</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                            <input type="text"
                                   name="lieu"
                                   class="form-control @error('lieu') is-invalid @enderror"
                                   placeholder="Lieu de l'événement"
                                   value="{{ old('lieu', $event->lieu) }}">
                            @error('lieu')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Prix & Places Row -->
                    <div class="row">
                        <!-- Prix -->
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Prix du ticket</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-cash-stack"></i></span>
                                <input type="number"
                                       step="0.01"
                                       name="prix"
                                       class="form-control @error('prix') is-invalid @enderror"
                                       placeholder="0.00"
                                       value="{{ old('prix', $event->prix) }}">
                                <span class="input-group-text bg-light text-muted fw-bold">DH</span>
                                @error('prix')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Places -->
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Nombre de places disponibles</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-people"></i></span>
                                <input type="number"
                                       name="places"
                                       class="form-control @error('places') is-invalid @enderror"
                                       placeholder="Ex: 150"
                                       value="{{ old('places', $event->places) }}">
                                @error('places')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <hr class="my-4 text-muted opacity-25">

                    <!-- Actions -->
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('admin.events.index') }}" class="btn btn-back">
                            <i class="bi bi-arrow-left me-1"></i>
                            Retour à la liste
                        </a>

                        <button type="submit" class="btn btn-warning btn-update text-white">
                            <i class="bi bi-check2-circle me-1"></i>
                            Mettre à jour
                        </button>
                    </div>

                </form>

            </div>

        </div>

    </div>
</div>

@endsection
