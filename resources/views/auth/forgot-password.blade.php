<!DOCTYPE html>
<html lang="fr" class="light-style customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('assets/') }}" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mot de passe oublié - Gestion de Stock</title>

    {{-- Inclure les mêmes assets que la page de login --}}
    @include('layouts.auth-assets')
</head>

<body>
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <div class="card">
                    <div class="card-body">
                        <div class="app-brand justify-content-center">
                            <a href="/" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    <img src="{{ asset('assets/img/1200px-Cotê_d\'Ivoire_Coat_of_Arms.svg.png') }}"
                                        alt="Logo" width="50">
                                </span>
                                <span class="app-brand-text demo text-body fw-bolder">Gestion Stock</span>
                            </a>
                        </div>

                        <h4 class="mb-2">Mot de passe oublié? 🔒</h4>
                        <p class="mb-4">Entrez votre email et nous vous enverrons les instructions pour réinitialiser
                            votre mot de passe</p>

                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form class="mb-3" action="{{ route('password.email') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email') }}"
                                    placeholder="Entrez votre email" autofocus />
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary d-grid w-100">
                                Envoyer le lien de réinitialisation
                            </button>
                        </form>
                        <div class="text-center">
                            <a href="{{ route('login') }}" class="d-flex align-items-center justify-content-center">
                                <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                                Retour à la connexion
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
