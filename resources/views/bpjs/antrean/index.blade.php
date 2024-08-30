<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">

    <title>Hello, world!</title>

</head>

<body>
    <div class="container-fluid">
        <h1>Dashboard Status Antrean</h1>
        <!-- Content here -->
        <table class="table table-sm" id="scrollingTable">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Kode Booking</th>
                    <th scope="col">Nomor Antrean</th>
                    <th scope="col">No RM</th>
                    <th scope="col">Kode Poli</th>
                    <th scope="col">Sumber Data</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $row)
                    <tr>
                        <td>{{ $row->kodebooking }}</td>
                        <td>{{ $row->noantrean }}</td>
                        <td>{{ $row->norekammedis }}</td>
                        <td>{{ $row->kodepoli }}</td>
                        <td>{{ $row->sumberdata }}</td>
                        <td>{{ $row->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    <!-- Optional JavaScript; choose one of the two! -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var tableBody = document.querySelector("#scrollingTable tbody");
            var scrollSpeed = 50; // Kecepatan scroll dalam milidetik
            var scrollAmount = 1; // Jumlah pixel yang digerakkan setiap scroll

            // Clone rows to create the infinite loop effect
            tableBody.innerHTML += tableBody.innerHTML;

            function scrollTable() {
                tableBody.scrollTop += scrollAmount;

                // Ketika mencapai akhir tabel, kembali ke awal
                if (tableBody.scrollTop >= tableBody.scrollHeight / 2) {
                    tableBody.scrollTop = 0;
                }
            }

            setInterval(scrollTable, scrollSpeed);
        });
    </script>

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous">
    </script>
    -->
</body>

</html>
