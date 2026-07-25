@extends('layouts.app')

@section('content')

<style>
    /* Custom Styling for Dashboard Table */
    .table-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        background: #ffffff;
        overflow: hidden;
    }

    .custom-table {
        margin-bottom: 0;
    }

    .custom-table thead th {
        background-color: #f8fafc;
        color: #475569;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 1rem 1.25rem;
        border-bottom: 2px solid #e2e8f0;
    }

    .custom-table tbody td {
        padding: 1.1rem 1.25rem;
        color: #334155;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.95rem;
    }

    .custom-table tbody tr:hover {
        background-color: #f8fafc;
        transition: background-color 0.2s ease;
    }

    .btn-action {
        width: 34px;
        height: 34px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        transition: all 0.2s ease;
        border: none;
    }

    .btn-action:hover {
        transform: translateY(-2px);
    }

    .btn-create-event {
        background: linear-gradient(135deg, #10b981, #059669);
        border: none;
        border-radius: 10px;
        padding: 0.6rem 1.25rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-create-event:hover {
        background: linear-gradient(135deg, #059669, #047857);
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(16, 185, 129, 0.3);
    }

    .badge-price {
        font-weight: 600;
        padding: 0.45em 0.75em;
        border-radius: 8px;
    }

    .empty-state {
        background: #ffffff;
        border-radius: 16px;
        padding: 4rem 2rem;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }
</style>

<div class="container-fluid py-3">

    <!-- Header Section -->
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-4 gap-3">
        <div>
            <h3 class="fw-bold text-dark mb-1">
                <i class="bi bi-calendar-event text-success me-2"></i>Gestion des événements
            </h3>
            <p class="text-muted small mb-0">Consultez, modifiez et gérez tous vos événements en un seul endroit.</p>
        </div>

        <a href="{{ route('admin.events.create') }}" class="btn btn-success btn-create-event text-white">
            <i class="bi bi-plus-lg me-1"></i>
            Ajouter un événement
        </a>
    </div>

    @if($events->count())

    <!-- Data Table Card -->
    <div class="card table-card">
        <div class="table-responsive">
            <table class="table custom-table align-middle">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Date & Heure</th>
                        <th>Lieu</th>
                        <th>Prix</th>
                        <th>Places Totales</th>
                        <th>Restantes</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                        <tr>
                            <!-- Titre -->
                            <td>
                                <span class="fw-bold text-dark">{{ $event->titre }}</span>
                            </td>

                            <!-- Date & Heure -->
                            <td>
                                <div class="d-flex flex-column">
                                    <span class="fw-medium text-dark">
                                        <i class="bi bi-calendar3 me-1 text-muted small"></i>{{ $event->date }}
                                    </span>
                                    <span class="text-muted small">
                                        <i class="bi bi-clock me-1 small"></i>{{ $event->heure }}
                                    </span>
                                </div>
                            </td>

                            <!-- Lieu -->
                            <td>
                                <span class="text-secondary">
                                    <i class="bi bi-geo-alt me-1 text-danger opacity-75"></i>{{ $event->lieu }}
                                </span>
                            </td>

                            <!-- Prix -->
                            <td>
                                @if($event->prix == 0)
                                    <span class="badge bg-success-subtle text-success badge-price">
                                        <i class="bi bi-tag-fill me-1"></i>Gratuit
                                    </span>
                                @else
                                    <span class="badge bg-light text-dark border badge-price">
                                        {{ $event->prix }} DH
                                    </span>
                                @endif
                            </td>

                            <!-- Places Totales -->
                            <td>
                                <span class="badge bg-secondary-subtle text-secondary px-2 py-1">
                                    {{ $event->places }} places
                                </span>
                            </td>

                            <!-- Places Restantes -->
                            <td>
                                @php $restantes = $event->placesRestantes(); @endphp
                                @if($restantes > 0)
                                    <span class="badge bg-info-subtle text-info fw-bold px-2.5 py-1">
                                        {{ $restantes }} libres
                                    </span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger fw-bold px-2.5 py-1">
                                        Épuisé
                                    </span>
                                @endif
                            </td>

                            <!-- Actions Buttons -->
                            <td class="text-end">
                                <div class="d-inline-flex gap-1">

                                    <!-- Edit -->
                                    <a href="{{ route('admin.events.edit', $event) }}"
                                       class="btn btn-action btn-warning text-white"
                                       title="Modifier">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <!-- Reservations List -->
                                    <a href="{{ route('admin.reservations.for-event', $event) }}"
                                       class="btn btn-action btn-info text-white"
                                       title="Voir les réservations">
                                        <i class="bi bi-people-fill"></i>
                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('admin.events.destroy', $event) }}"
                                          method="POST"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-action btn-danger"
                                                title="Supprimer"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet événement ?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @else

    <!-- Empty State -->
    <div class="empty-state">
        <div class="bg-light rounded-circle d-inline-flex p-3 mb-3">
            <i class="bi bi-calendar-x text-muted fs-1"></i>
        </div>
        <h4 class="fw-bold text-dark">Aucun événement disponible</h4>
        <p class="text-muted mb-4">Vous n'avez créé aucun événement pour le moment.</p>
        <a href="{{ route('admin.events.create') }}" class="btn btn-success btn-create-event text-white">
            <i class="bi bi-plus-lg me-1"></i> Créer un événement
        </a>
    </div>

    @endif

</div>

@endsection
