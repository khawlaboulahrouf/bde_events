@extends('layouts.app')

@section('content')

<style>
    .participants-card {
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
        padding: 1rem 1.25rem;
        color: #334155;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.95rem;
    }

    .custom-table tbody tr:hover {
        background-color: #f8fafc;
        transition: background-color 0.2s ease;
    }

    .avatar-circle {
        width: 38px;
        height: 38px;
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.85rem;
    }

    .stat-card {
        border: none;
        border-radius: 12px;
        background: #ffffff;
        padding: 1.25rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
        border: 1px solid #f1f5f9;
    }

    .btn-back {
        border-radius: 10px;
        padding: 0.6rem 1.25rem;
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
            <div class="d-flex align-items-center gap-2 mb-1">
                <a href="{{ route('admin.events.index') }}" class="text-decoration-none text-muted fs-5">
                    <i class="bi bi-arrow-left-circle"></i>
                </a>
                <h3 class="fw-bold text-dark mb-0">
                    Participants
                </h3>
            </div>
            <p class="text-muted small mb-0">
                Événement : <span class="fw-bold text-success">{{ $event->titre }}</span>
            </p>
        </div>

        <a href="{{ route('admin.events.index') }}" class="btn btn-back">
            <i class="bi bi-arrow-left me-1"></i>
            Retour aux événements
        </a>
    </div>

    <!-- Stats Summary Row -->
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-md-4">
            <div class="stat-card d-flex align-items-center">
                <div class="bg-success-subtle text-success rounded-3 p-3 me-3">
                    <i class="bi bi-people-fill fs-4"></i>
                </div>
                <div>
                    <span class="text-muted small d-block">Inscrits</span>
                    <h4 class="fw-bold mb-0">{{ $reservations->count() }}</h4>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-4">
            <div class="stat-card d-flex align-items-center">
                <div class="bg-info-subtle text-info rounded-3 p-3 me-3">
                    <i class="bi bi-ticket-perforated-fill fs-4"></i>
                </div>
                <div>
                    <span class="text-muted small d-block">Places Restantes</span>
                    <h4 class="fw-bold mb-0">{{ $event->placesRestantes() }} / {{ $event->places }}</h4>
                </div>
            </div>
        </div>
    </div>

    @if($reservations->count())

    <!-- Data Table Card -->
    <div class="card participants-card">
        <div class="table-responsive">
            <table class="table custom-table align-middle">
                <thead>
                    <tr>
                        <th>Participant</th>
                        <th>Email</th>
                        <th>Date de réservation</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservations as $reservation)
                        <tr>
                            <!-- Avatar + Nom & Prénom -->
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-circle me-3">
                                        {{ strtoupper(substr($reservation->student->name ?? 'S', 0, 1)) }}{{ strtoupper(substr($reservation->student->lastname ?? '', 0, 1)) }}
                                    </div>
                                    <div>
                                        <span class="fw-bold text-dark d-block">
                                            {{ $reservation->student->name }} {{ $reservation->student->lastname }}
                                        </span>
                                        <span class="text-muted small">Étudiant</span>
                                    </div>
                                </div>
                            </td>

                            <!-- Email -->
                            <td>
                                <span class="text-secondary">
                                    <i class="bi bi-envelope me-1 text-muted"></i>{{ $reservation->student->email }}
                                </span>
                            </td>

                            <!-- Date de réservation -->
                            <td>
                                <span class="badge bg-light text-dark border px-2.5 py-1.5 font-monospace">
                                    <i class="bi bi-calendar-check me-1 text-success"></i>{{ $reservation->reserved_at }}
                                </span>
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
            <i class="bi bi-person-x text-muted fs-1"></i>
        </div>
        <h4 class="fw-bold text-dark">Aucune réservation</h4>
        <p class="text-muted mb-4">Aucun étudiant n'a encore réservé sa place pour cet événement.</p>
        <a href="{{ route('admin.events.index') }}" class="btn btn-back">
            <i class="bi bi-arrow-left me-1"></i> Retour à la liste
        </a>
    </div>

    @endif

</div>

@endsection
