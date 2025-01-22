        function printClients() {
            // Ambil elemen container
            var printContents = document.querySelector('.container').innerHTML;

            // Simpan isi awal halaman
            var originalContents = document.body.innerHTML;

            // Ganti isi halaman dengan elemen container
            document.body.innerHTML = printContents;

            // Cetak halaman
            window.print();

            // Kembalikan isi halaman awal
            document.body.innerHTML = originalContents;

            // Reload halaman untuk menghindari bug tampilan
            location.reload();
        }
    