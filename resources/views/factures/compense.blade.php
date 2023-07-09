<!DOCTYPE html>
<html>
<link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />

<head>
    <title>Facture Compense</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.5;
        }

        .invoice {
            margin: 20px auto;
            padding: 20px;
            max-width: 800px;
            background-color: #f8f8f8;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .invoice-header h1 {
            font-size: 24px;
            margin: 0;
        }

        .invoice-details {
            margin-bottom: 20px;
        }

        .invoice-details p {
            margin: 0;
        }

        .invoice-items {
            margin-bottom: 20px;
        }

        .invoice-items table {
            width: 100%;
            border-collapse: collapse;
        }

        .invoice-items th,
        .invoice-items td {
            padding: 8px;
            border: 1px solid #ddd;
        }

        .invoice-items th {
            background-color: #f5f5f5;
        }

        .invoice-total {
            text-align: right;
        }

        .invoice-total p {
            font-weight: bold;
            margin: 0;
        }

        .invoice-signature {
            display: flex;
            justify-content: space-between;
        }

        .invoice-signature p {
            margin: 0;
        }

        @media print {
            .navbar {
                display: none;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-light bg-dark justify-content-between">
        <div class="navbar-brand"></div>
        <form class="form-inline">
            <button type="button" id="generate_pdf" class="btn btn-outline-success my-2 my-sm-0">Télécharger</button>
            <button class="btn btn-outline-info my-2 my-sm-0 ml-2" onclick="printPage()">Imprimer</button>
        </form>
    </nav>
    <div id="fac">
        <div class="invoice" id="invoice">
            <div class="invoice-header">
                <h1>Facture Compense TMoney </h1>
            </div>

            <div class="invoice-details">
                <p> Date d'initiation: <strong>{{ $data['dateInitiation'] }} </strong></p>
                <p> Date d'approbation: <strong>{{ $data['dateApprobation'] }} </strong></p>
                <p>Numéro de facture: <strong>{{ $data['id'] }} </strong></p>
                <p>Agent initiateur : <strong>{{ $data['agent'] }} </strong></p>
            </div>

            <div class="invoice-items">
                <table>
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Montant</th>
                            <th>Mode de paiement</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $data['type'] }}</td>
                            <td>{{ $data['montant'] }}</td>
                            <td>{{ $data['modePaiement'] }}</td>

                        </tr>

                    </tbody>
                </table>
            </div>


            <div class="invoice-signature">
                <div>
                    <p>Signature du client: _____________________</p>
                    <p>Date: _____________________</p>
                </div>
                <div>
                    <p>Signature de l'agent: _____________________</p>
                    <p>Date: _____________________</p>
                </div>
            </div>
        </div>
        <hr>
        <div class="invoice" id="invoice">
            <div class="invoice-header">
                <h1>Facture Compense TMoney </h1>
            </div>

            <div class="invoice-details">
                <p> Date d'initiation: <strong>{{ $data['dateInitiation'] }} </strong></p>
                <p> Date d'approbation: <strong>{{ $data['dateApprobation'] }} </strong></p>
                <p>Numéro de facture: <strong>{{ $data['id'] }} </strong></p>
                <p>Agent initiateur : <strong>{{ $data['agent'] }} </strong></p>
            </div>

            <div class="invoice-items">
                <table>
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Montant</th>
                            <th>Mode de paiement</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $data['type'] }}</td>
                            <td>{{ $data['montant'] }}</td>
                            <td>{{ $data['modePaiement'] }}</td>

                        </tr>

                    </tbody>
                </table>
            </div>


            <div class="invoice-signature">
                <div>
                    <p>Signature du client: _____________________</p>
                    <p>Date: _____________________</p>
                </div>
                <div>
                    <p>Signature de l'agent: _____________________</p>
                    <p>Date: _____________________</p>
                </div>
            </div>
        </div>
    </div>
    <script>
        function printPage() {
            window.print();
        }
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
    <script>
        $(document).ready(function() {
            var facture = $('#fac'),
                cache_width = facture.width(),
                a4 = [595.28, 841.89]; // for a4 size paper width and height

            $('#generate_pdf').on('click', function() {
                $('body').scrollTop(0);
                generatePDF();
            });

            function generatePDF() {
                getCanvas().then(function(canvas) {
                    var img = canvas.toDataURL("image/png"),
                        doc = new jsPDF({
                            unit: 'px',
                            format: 'a4'
                        });
                    doc.addImage(img, 'JPEG', 20, 20);
                    // Générer un nombre aléatoire entre 100000 et 999999
                    var randomNumber = Math.floor(Math.random() * (999999 - 100000 + 1)) + 100000;

                    // Ajouter le nombre aléatoire au nom du fichier
                    var fileName = 'facture_compense' + randomNumber + '.pdf';

                    doc.save(fileName);
                    facture.width(cache_width);
                });
            }

            function getCanvas() {
                facture.width((a4[0] * 1.33333) - 80).css('max-width', 'none');
                return html2canvas(facture, {
                    imageTimeout: 2000,
                    removeContainer: true
                });
            }
        });
    </script>
</body>

</html>
