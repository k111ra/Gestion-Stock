<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bon de Livraison</title>

    <style>
        body {
            font-family: 'Times New Roman', serif;
            margin: 40px;
            background-color: #fff;
        }

        .header,
        .footer {
            text-align: center;
        }

        .header h4,
        .header h5,
        .header p {
            margin: 2px;
        }

        .title {
            text-align: center;
            margin: 30px 0;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 18px;
            text-decoration: underline;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th,
        td {
            padding: 8px;
            text-align: center;
        }

        .section {
            margin-top: 20px;
        }

        .visas {
            margin-top: 60px;
        }

        .visas-table {
            width: 100%;
            border-collapse: collapse;
        }

        .visas-table td {
            width: 25%;
            text-align: center;
            border: none;
            padding: 10px;
        }

        .visas-table p {
            margin-bottom: 60px;
            font-weight: bold;
        }

        .signature-line {
            border-top: 1px solid #000;
            width: 80%;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ public_path('assets/img/1200px-Cotê_d\'Ivoire_Coat_of_Arms.svg.png') }}"
            alt="Armoiries de Côte d'Ivoire" style="width: 100px;">
        <h4>RÉPUBLIQUE DE CÔTE D’IVOIRE</h4>
        <p><strong>Union - Discipline - Travail</strong></p>
        <h4>MINISTÈRE DE LA JUSTICE ET DES DROITS DE L’HOMME</h4>
        <h5>Direction des Affaires Financières</h5>
        <p>Située à Cocody-Riviera Bonoumin, non loin du centre commercial Abidjan Mall, carrefour DJEDJE Mady<br>
            Tél : 27 22 42 77 70</p>
    </div>

    <div class="title">Bon de livraison de vivres à {{ $mouvement->destination }}</div>

    <div class="section">
        <p><strong>Abidjan, le :</strong> {{ date('d/m/Y', strtotime($mouvement->date_mouvement)) }}</p>
        <p><strong>DATE DE RÉCEPTION :</strong> ...................................</p>
        <p><strong>HEURE :</strong> ...............................................</p>
    </div>

    <div class="section">
        <p><strong>Fournisseur :</strong> {{ $mouvement->fournisseur->nom ?? 'Non spécifié' }}</p>
        <p><strong>NB :</strong> Les denrées réceptionnées à la date du
            {{ date('d/m/Y', strtotime($mouvement->date_mouvement)) }}
            couvrent entièrement les besoins pour une période de trois mois.</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>N°</th>
                <th>DÉSIGNATION</th>
                <th>QUANTITÉ PRÉVUE</th>
                <th>QUANTITÉ REÇUE</th>
                <th>OBSERVATION</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mouvement->produits as $index => $produit)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $produit->nom }}</td>
                    <td>{{ number_format($produit->pivot->quantite, 0, ',', ' ') }}</td>
                    <td></td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="visas">
        <table class="visas-table">
            <tr>
                <td>
                    <p>Visa DAF</p>
                    <div class="signature-line"></div>
                </td>
                <td>
                    <p>Visa Responsable Patrimoine</p>
                    <div class="signature-line"></div>
                </td>
                <td>
                    <p>Visa du Chef d'Établissement</p>
                    <div class="signature-line"></div>
                </td>
                <td>
                    <p>Visa du Magasinier des Vivres</p>
                    <div class="signature-line"></div>
                </td>
            </tr>
        </table>
    </div>

</body>

</html>
