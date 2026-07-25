@extends('layouts.app')

@section('content')

<style>
    .create-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        background: #ffffff;
    }

    .create-card-header {
        background: linear-gradient(135deg, #10b981, #059669);
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
        border-color: #10b981;
        box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.12);
    }

    .btn-submit {
        background: linear-gradient(135deg, #10b981, #059669);
        border: none;
        border-radius: 10px;
        padding: 0.65rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-submit:hover {
        background: linear-gradient(135deg, #059669, #047857);
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(16, 185, 129, 0.3);
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

        <div class="card create-card">

            <!-- Card Header -->
            <div class="create-card-header text-white d-flex align-items-center">
                <div class="bg-white bg-opacity-20 rounded-circle p-2 me-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                    <i class="bi bi-calendar-plus fs-4 text-white"></i>
                </div>
                <div>
                    <h4 class="fw-bold mb-0">Ajouter un événement</h4>
                    <p class="mb-0 text-white-50 small">Remplissez le formulaire ci-dessous pour publier un nouvel événement</p>
                </div>
            </div>

            <!-- Card Body -->
            <div class="card-body p-4 p-md-5">

                <form action="{{ route('admin.events.store') }}" method="POST">
                    @csrf

                    <!-- Titre -->
                    <div class="mb-4">
                        <label class="form-label">Titre de l'événement</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-type"></i></span>
                            <input type="text"
                                   name="titre"
                                   class="form-control @error('titre') is-invalid @enderror"
                                   placeholder="Ex: Soirée d'intégration 2026"
                                   value="{{ old('titre') }}">
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
                            placeholder="Décrivez les détails de l'événement..."
                            class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
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
                                       value="{{ old('date') }}">
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
                                       value="{{ old('heure') }}">
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
                                   placeholder="Ex: Grand Amphithéâtre, Salle 12..."
                                   value="{{ old('lieu') }}">
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
                                       value="{{ old('prix', 0) }}">
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
                                       value="{{ old('places') }}">
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

                        <button type="submit" class="btn btn-success btn-submit text-white">
                            <i class="bi bi-check2-circle me-1"></i>
                            Enregistrer l'événement
                        </button>
                    </div>

                </form>

            </div>

        </div>

    </div>
</div>

@endsection
