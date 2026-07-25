@extends('layouts.app')

@section('content')

<style>
    /* Real Ticket UI Styling */
    .ticket-card {
        border: none;
        border-radius: 20px;
        background: #ffffff;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .ticket-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 35px rgba(0, 0, 0, 0.12);
    }

    .ticket-header {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        padding: 1.5rem;
        position: relative;
    }

    /* Ticket Cutouts Effect (Dotted Tear Line) */
    .ticket-divider {
        position: relative;
        height: 1px;
        border-top: 2px dashed #cbd5e1;
        margin: 1.25rem 0;
    }

    .ticket-divider::before, .ticket-divider::after {
        content: '';
        position: absolute;
        top: 50%;
        width: 20px;
        height: 20px;
        background-color: var(--bg-body, #f8fafc);
        border-radius: 50%;
        transform: translateY(-50%);
    }

    .ticket-divider::before {
        left: -25px;
    }

    .ticket-divider::after {
        right: -25px;
    }

    .ticket-code-box {
        background: #f1f5f9;
        border: 1px dashed #94a3b8;
        border-radius: 12px;
        padding: 0.75rem 1rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .meta-label {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #64748b;
        font-weight: 600;
        margin-bottom: 0.2rem;
    }

    .meta-value {
        font-weight: 600;
        color: #1e293b;
        font-size: 0.95rem;
    }

    .empty-state {
        background: #ffffff;
        border-radius: 20px;
        padding: 4rem 2rem;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }

    .btn-explore {
        background: linear-gradient(135deg, #10b981, #059669);
        border: none;
        border-radius: 10px;
        padding: 0.75rem 1.75rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-explore:hover {
        background: linear-gradient(135deg, #059669, #047857);
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(16, 185, 129, 0.3);
    }
</style>

<div class="container-fluid py-3">

    <!-- Header Section -->
    <div class="mb-4">
        <h3 class="fw-bold text-dark mb-1">
            <i class="bi bi-ticket-perforated-fill text-success me-2"></i>Mes Billets
        </h3>
        <p class="text-muted small mb-0">Retrouvez ici tous vos pass et réservations pour les événements du BDE.</p>
    </div>

    @if($reservations->count())

    <div class="row g-4">
        @foreach($reservations as $reservation)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card ticket-card h-100">

                    <!-- Ticket Header -->
                    <div class="ticket-header">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-white bg-opacity-20 text-white rounded-pill px-3 py-1 small">
                                <i class="bi bi-pass me-1"></i> Pass Confirmé
                            </span>

                            @if($reservation->event->prix == 0)
                                <span class="badge bg-white text-success fw-bold px-2.5 py-1">
                                    Gratuit
                                </span>
                            @else
                                <span class="badge bg-dark text-white fw-bold px-2.5 py-1">
                                    {{ $reservation->event->prix }} DH
                                </span>
                            @endif
                        </div>

                        <h4 class="fw-bold text-white mb-0 text-truncate" title="{{ $reservation->event->titre }}">
                            {{ $reservation->event->titre }}
                        </h4>
                    </div>

                    <!-- Ticket Body -->
                    <div class="card-body p-4 d-flex flex-column justify-content-between">

                        <!-- Event Details Grid -->
                        <div class="row g-3 mb-2">
                            <div class="col-6">
                                <span class="meta-label">Date</span>
                                <div class="meta-value text-truncate">
                                    <i class="bi bi-calendar3 text-success me-1"></i>{{ $reservation->event->date }}
                                </div>
                            </div>

                            <div class="col-6">
                                <span class="meta-label">Heure</span>
                                <div class="meta-value text-truncate">
                                    <i class="bi bi-clock text-success me-1"></i>{{ $reservation->event->heure }}
                                </div>
                            </div>

                            <div class="col-12">
                                <span class="meta-label">Lieu / Emplacement</span>
                                <div class="meta-value text-truncate">
                                    <i class="bi bi-geo-alt text-danger me-1"></i>{{ $reservation->event->lieu }}
                                </div>
                            </div>
                        </div>

                        <!-- Ticket Dotted Divider with Cutouts -->
                        <div class="ticket-divider"></div>

                        <!-- Ticket Code Box -->
                        <div class="mb-3">
                            <span class="meta-label d-block mb-1">Code du Ticket</span>
                            <div class="ticket-code-box">
                                <span class="font-monospace fw-bold fs-6 text-dark tracking-wider">
                                    {{ $reservation->ticket->ticket_code }}
                                </span>
                                <i class="bi bi-qr-code-scan fs-4 text-muted"></i>
                            </div>
                        </div>

                        <!-- Reservation Date Footer -->
                        <div class="text-center">
                            <span class="text-muted small">
                                Réservé le : <strong class="text-dark">{{ $reservation->reserved_at }}</strong>
                            </span>
                        </div>

                    </div>

                </div>
            </div>
        @endforeach
    </div>

    @else

    <!-- Empty State -->
    <div class="empty-state">
        <div class="bg-light rounded-circle d-inline-flex p-3 mb-3">
            <i class="bi bi-ticket-detailed text-muted fs-1"></i>
        </div>
        <h4 class="fw-bold text-dark">Vous n'avez aucun billet</h4>
        <p class="text-muted mb-4">Vous n'avez encore réservé aucun événement pour le moment.</p>
        <a href="{{ route('events.index') }}" class="btn btn-success btn-explore text-white">
            <i class="bi bi-compass me-1"></i> Explorer les événements
        </a>
    </div>

    @endif

</div>

@endsection
